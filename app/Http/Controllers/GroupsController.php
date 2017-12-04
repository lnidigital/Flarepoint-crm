<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use Datatables;
use App\Models\Group;
use App\Http\Requests;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Repositories\Group\GroupRepositoryContract;
use App\Repositories\Organization\OrganizationRepositoryContract;
use App\Repositories\User\UserRepositoryContract;

class GroupsController extends Controller
{

    protected $groups;
    protected $organizations;
    protected $users;

    /**
     * GroupsController constructor.
     * @param DepartmentRepositoryContract $Groups
     */
    public function __construct(
        GroupRepositoryContract $groups,
        OrganizationRepositoryContract $organizations,
        UserRepositoryContract $users
    )
    {
        $this->groups = $groups;
        $this->organizations = $organizations;
        $this->users = $users;

        //$this->middleware('user.is.super', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('groups.index')
            ->withGroups($this->groups->getAllGroups());
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        // if (auth()->user()->hasRole('super')) {
        //     $groups = Group::select(['groups.id', 'groups.name', 'organizations.name as organization'])
        //                 ->join('organizations','organizations.id','groups.organization_id');
        // } elseif (auth()->user()->hasRole('administrator')) {
        //     $groups = Group::select(['groups.id', 'groups.name', 'organizations.name as organization'])
        //                 ->join('organizations','organizations.id','groups.organization_id')
        //                 ->where('organizations.user_id',Auth::id());
        //             }
        // else {
        //     $groups = Group::select(['groups.id', 'groups.name', 'organizations.name as organization'])
        //                 ->join('group_user','group_id','id')
        //                 ->where('group_user.user_id',Auth::id());
        // }

        $groups = Group::select(['groups.id', 'groups.name', 'organizations.name as organization'])
                        ->join('organizations','organizations.id','organization_id')
                         ->join('group_user','group_id','groups.id')
                         ->where('group_user.user_id',Auth::id());
                    
        return Datatables::of($groups)
            ->addColumn('namelink', function ($groups) {
                return '<a href="/groups/'.$groups->id.'">'.$groups->name.'</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'groups.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'groups.destroy\', $id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')"">

            {{csrf_field()}}
            </form>')
            ->make(true);
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('groups.create')
                ->withOrganizations($this->organizations->getOrganizationsByUserSelect(Auth::id()))
                ->withUsers($this->users->getAllUsersSelect());
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return mixed
     */
    public function store(StoreGroupRequest $request)
    {
        $this->groups->create($request);
        Session::flash('flash_message', 'Successfully created new group');
        return redirect()->route('groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('groups.edit')
            ->withGroup($this->groups->find($id))
            ->withOrganizations($this->organizations->getOrganizationsByUserSelect(Auth::id()))
            ->withUsers($this->users->getAllUsersSelect());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $this->groups->update($id, $request);
        Session()->flash('flash_message', 'Group successfully updated');
        return redirect()->route('groups.index');
        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->groups->destroy($id);
        return redirect()->route('groups.index');
    }
}
