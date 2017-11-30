<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Contact;
use App\Models\Attendance;
use App\Models\Meeting;
use App\Http\Requests;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use Illuminate\Http\Request;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{

    protected $settings;
    protected $contacts;

    public function __construct(
        ContactRepositoryContract $contacts,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings
    )
    {
        $this->contacts = $contacts;
        $this->settings = $settings;
        $this->meetings = $meetings;
        $this->middleware('attendance.create', ['only' => ['create']]);
        $this->middleware('attendance.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('attendance.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        // $clients = Client::select(['id', 'name', 'company_name', 'email', 'primary_number']);
        // return Datatables::of($clients)
        //     ->addColumn('namelink', function ($clients) {
        //         return '<a href="clients/' . $clients->id . '" ">' . $clients->name . '</a>';
        //     })
        //     ->add_column('edit', '
        //         <a href="{{ route(\'clients.edit\', $id) }}" class="btn btn-success" >Edit</a>')
        //     ->add_column('delete', '
        //         <form action="{{ route(\'clients.destroy\', $id) }}" method="POST">
        //     <input type="hidden" name="_method" value="DELETE">
        //     <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

        //     {{csrf_field()}}
        //     </form>')
        //     ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $groupId = Helper::getGroupId();

        return view('attendance.create')
            ->withMembers($this->members->getAllMembers($groupId))
            ->withGuests($this->guests->listAllGuests($groupId));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreAttendanceRequest $request)
    {
        $attendedPersons = array();
        $attendedMembers =  $request->input('member');
        $attendedGuests =  $request->input('guest');

        if (is_array($attendedMembers))
            $attendedPersons = array_merge($attendedPersons, $attendedMembers);

        if (is_array($attendedGuests))
            $attendedPersons = array_merge($attendedPersons, $attendedGuests);

        $meetingId = $request->input('meeting_id');
        $meeting = Meeting::find($meetingId);

        Log::info('attendance='.json_encode($attendedPersons));

        $attendedArray = array();
        foreach ($attendedPersons as $attendedPerson) {
            $attendance = Attendance::firstOrNew(array('meeting_id' => $meetingId, 'contact_id'=>$attendedPerson));
            $attendance->save();
            $attendedArray[] = $attendedPerson;
        } 

        Attendance::where('meeting_id',$meetingId)->whereNotIn('contact_id', $attendedArray)->delete();

        return redirect()->route('meetings.show', $request->meeting_id);
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
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }
        
        return view('attendance.edit')
            ->withMembers($this->contacts->getAllMembers($groupId))
            ->withGuests($this->contacts->getAllGuests($groupId))
            ->withMeeting($this->meetings->find($id));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateClientRequest $request)
    {
        $this->clients->update($id, $request);
        Session()->flash('flash_message', 'Client successfully updated');
        return redirect()->route('clients.index');
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
