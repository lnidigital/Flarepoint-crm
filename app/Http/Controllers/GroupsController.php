<?php
namespace App\Http\Controllers;

use Session;
use App\Http\Requests;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Repositories\Group\GroupRepositoryContract;

class GroupsController extends Controller
{

    protected $groups;

    /**
     * GroupsController constructor.
     * @param DepartmentRepositoryContract $Groups
     */
    public function __construct(GroupRepositoryContract $groups)
    {
        $this->groups = $groups;
        $this->middleware('user.is.admin', ['only' => ['create', 'destroy']]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('groups.index')
            ->withDepartment($this->groups->getAllGroups());
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return mixed
     */
    public function store(StoreDepartmentRequest $request)
    {
        $this->groups->create($request);
        Session::flash('flash_message', 'Successfully created new group');
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
