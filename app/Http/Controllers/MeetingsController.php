<?php
namespace App\Http\Controllers;

use Auth;
use Config;
use Dinero;
use Datatables;
use Carbon;
use App\Models\Meeting;
use App\Models\Attendance;
use App\Http\Requests;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Meeting\StoreMeetingRequest;
use App\Http\Requests\Meeting\UpdateMeetingRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;

class MeetingsController extends Controller
{

    protected $settings;
    protected $meetings;
    protected $attendance;
    protected $contacts;
    protected $referrals;
    protected $onetoones;
    protected $revenues;

    public function __construct(
        ContactRepositoryContract $contacts,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings,
        ReferralRepositoryContract $referrals,
        OnetoOneRepositoryContract $onetoones,
        RevenueRepositoryContract $revenues

    )
    {
        $this->contacts = $contacts;
        $this->settings = $settings;
        $this->meetings = $meetings;
        $this->onetoones = $onetoones;
        $this->revenues = $revenues;
        $this->referrals = $referrals;
        $this->middleware('meeting.create', ['only' => ['create']]);
        $this->middleware('meeting.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('meetings.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

        $meetings = Meeting::select(['id', 'meeting_date', 'meeting_notes', 'group_id'])
                    ->where('group_id',$groupId);

        return Datatables::of($meetings)
            ->addColumn('namelink', function ($meetings) {
                $date = Carbon::parse($meetings->meeting_date);
                return '<a href="meetings/' . $meetings->id . '" ">' . $date->format('F d, Y') . '</a>';
            })
            ->addColumn('meeting_notes_short', function ($meetings) {
                return substr($meetings->meeting_notes, 0, 200) . "...";
            })
            ->add_column('edit', '
                <a href="{{ route(\'meetings.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'meetings.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
    	$groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

        return view('meetings.create')
            ->withMembers($this->contacts->getAllMembers($groupId))
            ->withGuests($this->contacts->getAllGuests($groupId));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreMeetingRequest $request)
    {
        $this->meetings->create($request->all());
        return redirect()->route('meetings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

        $attendedMembers = array();
        $groupMembers = $this->contacts->getAllMembers($groupId);

        foreach ($groupMembers as $groupMember) {
            $attendance = Attendance::where('meeting_id',$id)->where('contact_id',$groupMember->id)->first();
            if ($attendance !=null) {
                $attendedMembers[] = $groupMember;
            }
        }

        $attendedGuests = array();
        $groupGuests = $this->contacts->getAllGuests($groupId);

        foreach ($groupGuests as $groupGuest) {
            $attendance = Attendance::where('meeting_id',$id)->where('contact_id',$groupGuest->id)->first();
            if ($attendance !=null) {
                $attendedGuests[] = $groupGuest;
            }
        }

        $referralsMade = array();
        $meetingReferrals = $this->referrals->getReferralsByMeeting($id);

        $onetoonesCompleted = array();
        $onetoones = $this->onetoones->getOnetoOnesByMeeting($id);


        return view('meetings.show')
            ->withMeeting($this->meetings->find($id))
            ->with('attendedMembers', $attendedMembers)
            ->with('attendedGuests', $attendedGuests)
            ->with('onetoones', $onetoones)
            ->with('meetingReferrals', $meetingReferrals);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('meetings.edit')
            ->withMeeting($this->meetings->find($id));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateMeetingRequest $request)
    {
        $this->meetings->update($id, $request);
        Session()->flash('flash_message', 'Meeting successfully updated');
        return redirect()->route('meetings.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->meetings->destroy($id);

        return redirect()->route('meetings.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->meetings->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }

}
