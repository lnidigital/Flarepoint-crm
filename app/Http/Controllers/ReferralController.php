<?php
namespace App\Http\Controllers;

use Carbon;
use Config;
use Dinero;
use Datatables;
use App\Models\Referral;
use App\Http\Requests;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\Referral\StoreReferralRequest;
use App\Http\Requests\Referral\UpdateReferralRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use Illuminate\Support\Facades\Log;

class ReferralController extends Controller
{

    protected $settings;
    protected $referrals;
    protected $members;
    protected $meetings;

    public function __construct(
        ContactRepositoryContract $members,
        ReferralRepositoryContract $referrals,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings
    )
    {
        $this->members = $members;
        $this->referrals = $referrals;
        $this->settings = $settings;
        $this->meetings = $meetings;
        $this->middleware('referral.create', ['only' => ['create']]);
        $this->middleware('referral.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('referrals.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $groupId = Helper::getGroupId();

        $referrals = Referral::select(['id', 'from_contact_id', 'to_contact_id', 'referral_date', 'description'])
            ->where('group_id', $groupId);

        return Datatables::of($referrals)
            ->addColumn('from_name', function ($referrals) {
                if ($this->members->find($referrals->from_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                }
            })
            ->addColumn('to_name', function ($referrals) {
                if ($this->members->find($referrals->to_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                }
            })
            ->addColumn('referral_date_formatted', function ($referrals) {
                $date = Carbon::parse($referrals->referral_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'referrals.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'referrals.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }


    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function referralsGivenData($contactId)
    {
        Log::info('ReferralController->referralsGivenData: entering');

        $groupId = Helper::getGroupId();

        $referrals = Referral::select(['id', 'from_contact_id', 'to_contact_id', 'referral_date', 'description'])
                ->where('group_id', $groupId)
                ->where('from_contact_id', $contactId);

        return Datatables::of($referrals)
            ->addColumn('from_name', function ($referrals) {
                if ($this->members->find($referrals->from_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                }
            })
            ->addColumn('to_name', function ($referrals) {
                if ($this->members->find($referrals->to_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                }
            })
            ->addColumn('referral_date_formatted', function ($referrals) {
                $date = Carbon::parse($referrals->referral_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'referrals.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'referrals.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);

            Log::info('ReferralController->referralsGivenData: leaving');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function referralsReceivedData($contactId)
    {
        Log::info('ReferralController->referralsReceivedData: entering');

        $groupId = Helper::getGroupId();

        $referrals = Referral::select(['id', 'from_contact_id', 'to_contact_id', 'referral_date', 'description'])
                ->where('group_id', $groupId)
                ->where('to_contact_id', $contactId);

        return Datatables::of($referrals)
            ->addColumn('from_name', function ($referrals) {
                if ($this->members->find($referrals->from_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                }
            })
            ->addColumn('to_name', function ($referrals) {
                if ($this->members->find($referrals->to_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                }
            })
            ->addColumn('referral_date_formatted', function ($referrals) {
                $date = Carbon::parse($referrals->referral_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'referrals.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'referrals.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);

            Log::info('ReferralController->referralsReceivedData: leaving');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function meetingData($meetingId)
    {
        Log::info('ReferralController->meetingData: entering');

        $groupId = Helper::getGroupId();

        $referrals = Referral::select(['id',  'from_contact_id', 'to_contact_id', 'referral_date', 'description'])
                ->where('meeting_id', $meetingId);

        return Datatables::of($referrals)
            ->addColumn('from_name', function ($referrals) {
                if ($this->members->find($referrals->from_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->from_contact_id) . '">'.$this->members->find($referrals->from_contact_id)->name.'</a>';
                }
            })
            ->addColumn('to_name', function ($referrals) {
                if ($this->members->find($referrals->to_contact_id)->status == 2) {
                    return '<a href="' . route('guests.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                } else {
                    return '<a href="' . route('members.show', $referrals->to_contact_id) . '">'.$this->members->find($referrals->to_contact_id)->name.'</a>';
                }
            })
            ->addColumn('referral_date_formatted', function ($referrals) {
                $date = Carbon::parse($referrals->referral_date);
                return $date->format('F d, Y');
            })
            ->make(true);

            Log::info('ReferralController->meetingData: leaving');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
    	$groupId = Helper::getGroupId();

        $groupContacts = $this->members->getAllContacts($groupId);
        $contacts = array();

        foreach ($groupContacts as $contact) {
            $name = $contact->name;

            if ($contact->status == 2)
                $name = $name . " (guest)";

            $contacts[$contact->id] = $name;
        }

        $referrer = $request->get('referrer');
        $meetingId = "";

        if (preg_match('/\/(.*)\/(.*)/', $referrer, $matches))
            $meetingId = $matches[2];

        Log::info('ReferralController->create->meetingId: '.$meetingId);

        return view('referrals.create')
            ->withContacts($contacts)
            ->with('meetingId', $meetingId)
            ->withMeetings($this->meetings->getAllMeetingsSelect($groupId));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreReferralRequest $request)
    {
        $this->referrals->create($request->all());
        $referrer = $request->input('referrer');

        if ($referrer != null)
            return redirect()->to($referrer);
        else 
            return redirect()->route('referrals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('clients.show')
            ->withClient($this->clients->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->withInvoices($this->clients->getInvoices($id))
            ->withUsers($this->users->getAllUsersWithDepartments());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        $groupId = Helper::getGroupId();

        return view('referrals.edit')
            ->withReferral($this->referrals->find($id))
            ->withMembers($this->members->getAllMembersSelect($groupId))
            ->withMeetings($this->meetings->getAllMeetingsSelect($groupId));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateReferralRequest $request)
    {
        $this->referrals->update($id, $request);
        Session()->flash('flash_message', 'Referral successfully updated');
        return redirect()->route('referrals.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->clients->destroy($id);

        return redirect()->route('clients.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->clients->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }

}
