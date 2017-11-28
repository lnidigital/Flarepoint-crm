<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Contact;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class ContactsController extends Controller
{

    protected $users;
    protected $contacts;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        ContactRepositoryContract $contacts,
        SettingRepositoryContract $settings
    )
    {
        $this->users = $users;
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
        return view('contacts.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function getMembersData()
    {
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->group_id;
        }

        $members = Contact::select(['id', 'name', 'company_name', 'email', 'primary_number'])
                    ->where('group_id', $groupId)
                    ->where('is_guest', '0');

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
        return view('contacts.create')
            ->withIndustries($this->contacts->listAllIndustries());
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreContactRequest $request, String $route = '')
    {
        $this->contacts->create($request->all());
        return redirect()->route('contacts.index');
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
            ->withMember($this->members->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function edit($id)
    {
        return view('contacts.edit')
            ->withMember($this->contacts->find($id))
            ->withUsers($this->users->getAllUsersWithDepartments())
            ->withIndustries($this->contacts->listAllIndustries());
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateContactRequest $request)
    {
        $this->contacts->update($id, $request);
        Session()->flash('flash_message', 'Member successfully updated');
        return redirect()->route('contacts.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->contacts->destroy($id);

        return redirect()->route('contacts.index');
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
