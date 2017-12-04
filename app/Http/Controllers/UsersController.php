<?php
namespace App\Http\Controllers;

use Auth;
use Gate;
use Carbon;
use Datatables;
use App\Helpers\Helper;
use App\Models\User;
use App\Models\Task;
use App\Http\Requests;
use App\Models\Client;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use App\Repositories\Group\GroupRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Organization\OrganizationRepositoryContract;

class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $groups;
    protected $settings;
    protected $organizations;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        GroupRepositoryContract $groups,
        OrganizationRepositoryContract $organizations,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->groups = $groups;
        $this->settings = $settings;
        $this->organizations = $organizations;

        //$this->middleware('user.create', ['only' => ['create']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('users.index')->withUsers($this->users);
    }

    public function users()
    {
        return User::all();
    }

    public function anyData()
    {
        $canUpdateUser = auth()->user()->can('update-user');
        $organizationId = Helper::getOrganizationId();

        if (auth()->user()->hasRole('super')) {
            $users = User::select(['users.id', 'users.name', 'users.email', 'organizations.name as organization_name'])
                        ->join('organization_user','user_id','users.id')
                        ->join('organizations','organizations.id','organization_user.organization_id');
        } else {
            $users = User::select(['users.id', 'users.name', 'users.email', 'organizations.name as organization_name'])
                        ->join('organization_user','user_id','users.id')
                        ->join('organizations','organizations.id','organization_user.organization_id')
                        ->join('role_user','role_user.user_id','users.id')
                        ->where('role_user.role_id','!=',1)
                        ->whereIn('organization_id', Helper::getUserOrganizationIds());
        }
        
        return Datatables::of($users)
            ->addColumn('namelink', function ($users) {
                return '<a href="/users/' . $users->id . '" ">' . $users->name . '</a>';
            })
            ->addColumn('edit', function ($user) {
                return '<a href="' . route("users.edit", $user->id) . '" class="btn btn-success"> Edit</a>';
            })
            ->add_column('delete', '<form action="{{ route(\'users.destroy\', $id) }}" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" name="submit" value="Delete" class="btn btn-danger" onClick="return confirm(\'Are you sure?\')" id="myBtn">
    {{csrf_field()}}
</form>')
            ->make(true);
    }

    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    /*public function taskData($id)
    {
        $tasks = Task::select(
            ['id', 'title', 'created_at', 'deadline', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($tasks)
            ->addColumn('titlelink', function ($tasks) {
                return '<a href="' . route('tasks.show', $tasks->id) . '">' . $tasks->title . '</a>';
            })
            ->editColumn('created_at', function ($tasks) {
                return $tasks->created_at ? with(new Carbon($tasks->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('deadline', function ($tasks) {
                return $tasks->deadline ? with(new Carbon($tasks->deadline))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($tasks) {
                return $tasks->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->make(true);
    }*/

        /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    /*public function leadData($id)
    {
        $leads = Lead::select(
            ['id', 'title', 'created_at', 'contact_date', 'user_assigned_id', 'client_id', 'status']
        )
            ->where('user_assigned_id', $id);
        return Datatables::of($leads)
            ->addColumn('titlelink', function ($leads) {
                return '<a href="' . route('leads.show', $leads->id) . '">' . $leads->title . '</a>';
            })
            ->editColumn('created_at', function ($leads) {
                return $leads->created_at ? with(new Carbon($leads->created_at))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('contact_date', function ($leads) {
                return $leads->contact_date ? with(new Carbon($leads->contact_date))
                    ->format('d/m/Y') : '';
            })
            ->editColumn('status', function ($leads) {
                return $leads->status == 1 ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>';
            })
            ->editColumn('client_id', function ($tasks) {
                return $tasks->client->name;
            })
            ->make(true);
    }*/

    /**
     * Json for Data tables
     * @param $id
     * @return mixed
     */
    /*public function clientData($id)
    {
        $clients = Client::select(['id', 'name', 'company_name', 'primary_number', 'email'])->where('user_id', $id);
        return Datatables::of($clients)
            ->addColumn('clientlink', function ($clients) {
                return '<a href="' . route('clients.show', $clients->id) . '">' . $clients->name . '</a>';
            })
            ->editColumn('created_at', function ($clients) {
                return $clients->created_at ? with(new Carbon($clients->created_at))
                    ->format('d/m/Y') : '';
            })
            ->make(true);


      
    }*/


    /**
     * @return mixed
     */
    public function create()
    {
        $userId = Auth::id();

        $organizations = Helper::getUserOrganizations();
        $organizationIds = array();
        foreach ($organizations as $organization)
            $organizationIds[] = $organization->id;

        return view('users.create')
            ->withRoles($this->roles->listAllRoles())
            ->withGroups($this->groups->getAllGroupsByOrganization($organizationIds))
            ->withOrganizations($this->organizations->getOrganizationsByUserSelect($userId));
    }

    /**
     * @param StoreUserRequest $userRequest
     * @return mixed
     */
    public function store(StoreUserRequest $userRequest)
    {
        $getInsertedId = $this->users->create($userRequest);
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return view('users.show')
            ->withUser($this->users->find($id));
            //->withCompanyname($this->settings->getCompanyName());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $userId = Auth::id();

        $organizations = Helper::getUserOrganizations();
        $organizationIds = array();
        foreach ($organizations as $organization)
            $organizationIds[] = $organization->id;

        return view('users.edit')
            ->withUser($this->users->find($id))
            ->withRoles($this->roles->listAllRoles())
            ->withGroups($this->groups->getAllGroupsByOrganization($organizationIds))
            ->withOrganizations($this->organizations->getOrganizationsByUserSelect($userId));
    }

    /**
     * @param $id
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->users->update($id, $request);
        Session()->flash('flash_message', 'User successfully updated');
        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy(Request $request, $id)
    {
        $this->users->destroy($request, $id);

        return redirect()->route('users.index');
    }
}
