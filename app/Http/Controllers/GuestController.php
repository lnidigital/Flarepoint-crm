<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Guest;
use App\Helpers\Helper;
use App\Models\Contact;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Guest\StoreGuestRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Group\GroupRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;

class GuestController extends Controller
{

    protected $contacts;
    protected $settings;
    protected $meetings;
    protected $attendance;
    protected $referrals;
    protected $onetoones;
    protected $revenues;

    public function __construct(
        ContactRepositoryContract $contacts,
        SettingRepositoryContract $settings,
        ReferralRepositoryContract $referrals,
        OnetoOneRepositoryContract $onetoones,
        MeetingRepositoryContract $meetings,
        RevenueRepositoryContract $revenues
    )
    {
        $this->contacts = $contacts;
        $this->settings = $settings;
        $this->referrals = $referrals;
        $this->onetoones = $onetoones;
        $this->revenues = $revenues;
        $this->meetings = $meetings;

        $this->middleware('contact.create', ['only' => ['create']]);
        $this->middleware('contact.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guests.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $groupId = Helper::getGroupId();

        $guests = Contact::select(['id', 'name', 'company_name', 'email', 'primary_number'])
                    ->where('group_id', $groupId)
                    ->where('status', '2');

        return Datatables::of($guests)
            ->addColumn('namelink', function ($guests) {
                return '<a href="/guests/' . $guests->id . '" ">' . $guests->name . '</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'guests.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'guests.destroy\', $id) }}" method="POST">
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
    public function contactData($contactId)
    {
        $groupId = Helper::getGroupId();

        $guests = Contact::select(['id', 'name', 'company_name', 'email', 'primary_number'])
                    ->where('group_id', $groupId)
                    ->where('status', '2')
                    ->where('referrer_id', $contactId);

        return Datatables::of($guests)
            ->addColumn('namelink', function ($guests) {
                return '<a href="/guests/' . $guests->id . '" ">' . $guests->name . '</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'guests.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'guests.destroy\', $id) }}" method="POST">
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
        $groupId = Helper::getGroupId();

        return view('guests.create')
            ->withMembers($this->contacts->getAllMembersSelect($groupId))
            ->withIndustries($this->contacts->listAllIndustries());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreGuestRequest $request)
    {
        $this->contacts->create($request->all());
        return redirect()->route('guests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        $groupId = Helper::getGroupId();

        $activity['referralsgiven'] = $this->referrals->numReferralsGivenByContact($groupId, $id);
        $activity['referralsreceived'] = $this->referrals->numReferralsReceivedByContact($groupId, $id);
        $activity['onetoones'] = $this->onetoones->numOnetoOnesByContact($groupId, $id);
        $activity['guests'] = $this->contacts->numGuestsByContact($groupId, $id);
        $activity['revenues'] = $this->revenues->numRevenuesByContact($groupId, $id);
        $activity['meetings'] = $this->meetings->numMeetingsByContact($groupId, $id);

        return view('guests.show')
            ->with('guest', $this->contacts->find($id))
            ->withActivity($activity);
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

        return view('guests.edit')
            ->withGuest($this->contacts->find($id))
            ->withMembers($this->contacts->getAllMembersSelect($groupId))
            ->withIndustries($this->contacts->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateGuestRequest $request)
    {
        $this->contacts->update($id, $request);
        Session()->flash('flash_message', 'Guest successfully updated');
        return redirect()->route('guests.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->guests->destroy($id);

        return redirect()->route('guests.index');
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
