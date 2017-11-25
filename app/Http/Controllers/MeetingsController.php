<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use Carbon;
use App\Models\Meeting;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Meeting\StoreMeetingRequest;
use App\Http\Requests\Meeting\UpdateMeetingRequest;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use App\Repositories\Guest\GuestRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class MeetingsController extends Controller
{

    protected $settings;
    protected $guests;
    protected $members;
    protected $meetings;

    public function __construct(
        MemberRepositoryContract $members,
        GuestRepositoryContract $guests,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings
    )
    {
        $this->members = $members;
        $this->guests = $guests;
        $this->settings = $settings;
        $this->meetings = $meetings;
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
        $meetings = Meeting::select(['id', 'meeting_date', 'meeting_notes', 'group_id']);
        return Datatables::of($meetings)
            ->addColumn('namelink', function ($meetings) {
                $date = Carbon::parse($meetings->meeting_date);
                return '<a href="meetings/' . $meetings->id . '" ">' . $date->format('F d, Y') . '</a>';
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
    	$group_id = 1;

        return view('meetings.create')
            ->withMembers($this->members->getAllMembers($group_id))
            ->withGuests($this->guests->listAllGuests($group_id));
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
        return view('meetings.show')
            ->withMeeting($this->meetings->find($id));
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
