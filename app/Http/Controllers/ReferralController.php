<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Referral;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Referral\StoreReferralRequest;
use App\Http\Requests\Referral\UpdateReferralRequest;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Referral\ReferralRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class ReferralController extends Controller
{

    protected $settings;
    protected $referrals;
    protected $members;

    public function __construct(
        MemberRepositoryContract $members,
        ReferralRepositoryContract $referrals,
        SettingRepositoryContract $settings
    )
    {
        $this->members = $members;
        $this->referrals = $referrals;
        $this->settings = $settings;
        // $this->middleware('attendance.create', ['only' => ['create']]);
        // $this->middleware('attendance.update', ['only' => ['edit']]);
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
        $referrals = Referral::select(['id', 'from_member_id', 'to_member_id', 'referral_date', 'description']);
        return Datatables::of($referrals)
            ->addColumn('from_name', function ($referrals) {
                return $this->members->find($referrals->from_member_id)->name;
            })
            ->addColumn('to_name', function ($referrals) {
                return $this->members->find($referrals->to_member_id)->name;
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
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
    	$group_id = 1;

        return view('referrals.create')
            ->withMembers($this->members->getAllMembers($group_id));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreReferralRequest $request)
    {
        $this->referrals->create($request->all());
        return redirect()->route('referrals.index');
    }

    /**
     * @param Request $vatRequest
     * @return mixed
     */
    public function cvrapiStart(Request $vatRequest)
    {
        return redirect()->back()
            ->with('data', $this->clients->vat($vatRequest));
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
        $group_id = 1;

        return view('referrals.edit')
            ->withReferral($this->referrals->find($id))
            ->withMembers($this->members->getAllMembers($group_id));
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
