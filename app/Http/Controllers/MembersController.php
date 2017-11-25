<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Member;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Member\StoreMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class MembersController extends Controller
{

    protected $users;
    protected $clients;
    protected $members;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        MemberRepositoryContract $members,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->members = $members;
        $this->settings = $settings;
        $this->middleware('member.create', ['only' => ['create']]);
        $this->middleware('member.update', ['only' => ['edit']]);
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
        $members = Member::select(['id', 'name', 'company_name', 'email', 'primary_number']);
        return Datatables::of($members)
            ->addColumn('namelink', function ($members) {
                return $members->name;
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
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->members->listAllIndustries());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreMemberRequest $request)
    {
        $this->members->create($request->all());
        return redirect()->route('members.index');
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
        return view('members.show')
            ->withMember($this->members->find($id))
            ->withCompanyname($this->settings->getCompanyName())
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
        return view('members.edit')
            ->withMember($this->members->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->members->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateMemberRequest $request)
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
        $this->clients->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }

}
