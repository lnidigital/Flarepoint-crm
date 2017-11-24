<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Guest;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Guest\StoreGuestRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Guest\GuestRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class GuestController extends Controller
{

    protected $users;
    protected $clients;
    protected $members;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        MemberRepositoryContract $members,
        GuestRepositoryContract $guests,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
        $this->members = $members;
        $this->guests = $guests;
        $this->settings = $settings;
        $this->middleware('guest.create', ['only' => ['create']]);
        $this->middleware('guest.update', ['only' => ['edit']]);
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
        $guests = Guest::select(['id', 'name', 'company_name', 'email', 'primary_number']);
        return Datatables::of($guests)
            ->addColumn('namelink', function ($guests) {
                return '<a href="guests/' . $guests->id . '" ">' . $guests->name . '</a>';
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
        $group_id = 1;

        return view('guests.create')
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withMembers($this->members->getMembersSelect($group_id))
            ->withIndustries($this->members->listAllIndustries());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreGuestRequest $request)
    {
        $this->guests->create($request->all());
        return redirect()->route('guests.index');
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
        return view('guests.show')
            ->with('guest', $this->guests->find($id))
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
        return view('guests.edit')
            ->withGuest($this->guests->find($id))
            ->withMembers($this->members->listAllMembers())
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->guests->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateGuestRequest $request)
    {
        $this->guests->update($id, $request);
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
