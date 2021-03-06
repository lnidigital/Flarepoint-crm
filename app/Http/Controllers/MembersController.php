<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Contact;
use App\Http\Requests;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Group\GroupRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use Illuminate\Support\Facades\Log;

class MembersController extends Controller
{

    protected $users;
    protected $members;
    protected $settings;
    protected $referrals;
    protected $onetoones;
    protected $revenues;
    protected $contacts;
    protected $guests;
    protected $meetings;

    public function __construct(
        UserRepositoryContract $users,
        ContactRepositoryContract $members,
        SettingRepositoryContract $settings,
        ReferralRepositoryContract $referrals,
        OnetoOneRepositoryContract $onetoones,
        ContactRepositoryContract $contacts,
        MeetingRepositoryContract $meetings,
        RevenueRepositoryContract $revenues
    )
    {
        $this->users = $users;
        $this->members = $members;
        $this->settings = $settings;
        $this->referrals = $referrals;
        $this->onetoones = $onetoones;
        $this->revenues = $revenues;
        $this->contacts = $contacts;
        $this->meetings = $meetings;

        $this->middleware('contact.create', ['only' => ['create']]);
        $this->middleware('contact.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('members.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $groupId = Helper::getGroupId();

        $members = Contact::select(['id', 'name', 'company_name', 'email', 'primary_number'])
                    ->where('group_id', $groupId)
                    ->where('status', '1');
                    
        return Datatables::of($members)
            ->addColumn('namelink', function ($members) {
                return '<a href="/members/'.$members->id.'">'.$members->name.'</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'members.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'members.destroy\', $id) }}" method="POST">
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
        return view('members.create')
            ->withIndustries($this->members->listAllIndustries());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreContactRequest $request, String $route = '')
    {
        $this->members->create($request->all());
        return redirect()->route('members.index');
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
        $activity['oneonones'] = $this->onetoones->numOnetoOnesByContact($groupId, $id);
        $activity['guests'] = $this->contacts->numGuestsByContact($groupId, $id);
        $activity['revenues'] = $this->revenues->numRevenuesByContact($groupId, $id);
        $activity['meetings'] = $this->meetings->numMeetingsByContact($groupId, $id);

        return view('members.show')
            ->withContact($this->members->find($id))
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
        return view('members.edit')
            ->with('contact', $this->members->find($id))
            ->withIndustries($this->members->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateContactRequest $request)
    {
        $this->members->update($id, $request);
        Session()->flash('flash_message', 'Member successfully updated');
        return redirect()->route('members.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->members->destroy($id);

        return redirect()->route('members.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->contacts->updateAssign($id, $request);
        Session()->flash('flash_message', 'New contact is assigned');
        return redirect()->back();
    }

}
