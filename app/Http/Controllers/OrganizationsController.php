<?php
namespace App\Http\Controllers;

use Session;
use Datatables;
use App\Models\Organization;
use App\Http\Requests;
use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Repositories\Organization\OrganizationRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Support\Facades\Log;

class OrganizationsController extends Controller
{

    protected $organizations;
    protected $users;

    /**
     * GroupsController constructor.
     * @param DepartmentRepositoryContract $Groups
     */
    public function __construct(
        OrganizationRepositoryContract $organizations,
        UserRepositoryContract $users
    )
    {
        $this->organizations = $organizations;
        $this->users = $users;

        //$this->middleware('user.is.super', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('organizations.index')
            ->withOrganizations($this->organizations->getAllOrganizationsSelect());
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $organizations = Organization::select(['organizations.id', 'organizations.name', 'organizations.user_id','users.name as contact_name'])
                        ->join('users','users.id','organizations.user_id');
                    
        return Datatables::of($organizations)
            ->addColumn('namelink', function ($organizations) {
                return '<a href="/members/'.$organizations->id.'">'.$organizations->name.'</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'organizations.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'organizations.destroy\', $id) }}" method="POST">
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
    public function userData($userId)
    {
        $organizations = Organization::select(['organizations.id', 'organizations.name', 'organizations.user_id'])
                        ->join('organization_user','organization_id','organizations.id')
                        ->where('organization_user.user_id',$userId);
                    
        return Datatables::of($organizations)
            ->addColumn('namelink', function ($organizations) {
                return '<a href="/members/'.$organizations->id.'">'.$organizations->name.'</a>';
            })
            ->add_column('edit', '
                <a href="{{ route(\'organizations.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'organizations.destroy\', $id) }}" method="POST">
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
        return view('organizations.create')
                ->withUsers($this->users->getAllUsersSelect());
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return mixed
     */
    public function store(StoreOrganizationRequest $request)
    {   
        Log::info('OrganizationController->store: entering');
        $this->organizations->create($request);
        Log::info('OrganizationController->store: entering');
        Session::flash('flash_message', 'Successfully created new organization');
        return redirect()->route('organizations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('organizations.edit')
            ->withOrganization($this->organizations->find($id))
            ->withUsers($this->users->getAllUsersSelect());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateOrganizationRequest $request)
    {
        $this->organizations->update($id, $request);
        Session()->flash('flash_message', 'Organization successfully updated');
        return redirect()->route('organizations.index');
        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->organizations->destroy($id);
        return redirect()->route('organizations.index');
    }
}
