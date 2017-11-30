<?php
namespace App\Http\Controllers;

use Carbon;
use Config;
use Dinero;
use Datatables;
use App\Models\Revenue;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\Revenue\StoreRevenueRequest;
use App\Http\Requests\Revenue\UpdateRevenueRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;
use App\Repositories\Referral\ReferralRepositoryContract;
use Illuminate\Support\Facades\Log;

class RevenueController extends Controller
{

    protected $settings;
    protected $revenues;
    protected $members;
    protected $referrals;

    public function __construct(
        ContactRepositoryContract $members,
        RevenueRepositoryContract $revenues,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings,
        ReferralRepositoryContract $referrals
    )
    {
        $this->members = $members;
        $this->revenues = $revenues;
        $this->settings = $settings;
        $this->meetings = $meetings;
        $this->referrals = $referrals;

        $this->middleware('revenue.create', ['only' => ['create']]);
        $this->middleware('revenue.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('revenues.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $groupId = Helper::getGroupId();

        $revenue = Revenue::select(['id', 'contact_id', 'amount', 'report_date', 'group_id', 'description'])
                ->where('group_id', $groupId);
        return Datatables::of($revenue)
            ->addColumn('name', function ($revenue) {
                return $this->members->find($revenue->contact_id)->name;
            })
            ->addColumn('amount_formatted', function ($revenue) {
                return Helper::formatRevenue($revenue->amount);
            })
            ->addColumn('report_date_formatted', function ($revenue) {
                $date = Carbon::parse($revenue->report_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'revenues.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'revenues.destroy\', $id) }}" method="POST">
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

        $revenue = Revenue::select(['id', 'contact_id', 'amount', 'report_date', 'group_id', 'description'])
                ->where('group_id', $groupId)
                ->where('contact_id', $contactId);
                
        return Datatables::of($revenue)
            ->addColumn('name', function ($revenue) {
                return $this->members->find($revenue->contact_id)->name;
            })
            ->addColumn('amount_formatted', function ($revenue) {
                return Helper::formatRevenue($revenue->amount);
            })
            ->addColumn('report_date_formatted', function ($revenue) {
                $date = Carbon::parse($revenue->report_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'revenues.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'revenues.destroy\', $id) }}" method="POST">
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
        
        $formattedReferrals = array();
        $groupReferrals = $this->referrals->getReferralsByGroup($groupId);

        foreach ($groupReferrals as $referral) {
            $name = Helper::getContactName($referral->from_contact_id) .' &rarr; ' . 
                    Helper::getContactName($referral->to_contact_id) . " (". 
                    Helper::formatDate($referral->referral_date).")";

            $formmatedReferrals[$referral->id] = $name;
        }

        Log::info('RevenueController->create->formattedReferrals: '.json_encode($formmatedReferrals));

        return view('revenues.create')
            ->withMembers($this->members->getAllMembersSelect($groupId))
            ->withReferrals($formmatedReferrals)
            ->withMeetings($this->meetings->getAllMeetingsSelect($groupId));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreRevenueRequest $request)
    {
        $this->revenues->create($request->all());
        return redirect()->route('revenues.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('revenues.show')
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

        $formattedReferrals = array();
        $groupReferrals = $this->referrals->getReferralsByGroup($groupId);

        foreach ($groupReferrals as $referral) {
            $name = Helper::getContactName($referral->from_contact_id) .' &rarr; ' . 
                    Helper::getContactName($referral->to_contact_id) . " (". 
                    Helper::formatDate($referral->referral_date).")";
                    
            $formmatedReferrals[$referral->id] = $name;
        }

        return view('revenues.edit')
            ->withRevenue($this->revenues->find($id))
            ->withMembers($this->members->getAllMembersSelect($groupId))
            ->withReferrals($formmatedReferrals)
            ->withMeetings($this->meetings->getAllMeetingsSelect($groupId));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateRevenueRequest $request)
    {
        $this->revenues->update($id, $request);
        Session()->flash('flash_message', 'Revenue successfully updated');
        return redirect()->route('revenues.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->revenues->destroy($id);

        return redirect()->route('revenues.index');
    }

}
