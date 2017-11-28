<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Guest;
use App\Models\Contact;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Guest\StoreGuestRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Member\MemberRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class GuestController extends Controller
{

    protected $contacts;
    protected $settings;

    public function __construct(
        ContactRepositoryContract $contacts,
        SettingRepositoryContract $settings
    )
    {
        $this->contacts = $contacts;
        $this->settings = $settings;
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
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

        $guests = Contact::select(['id', 'name', 'company_name', 'email', 'primary_number'])
                    ->where('group_id', $groupId)
                    ->where('is_guest', '1');

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
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

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
        return view('guests.show')
            ->with('guest', $this->contacts->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

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
