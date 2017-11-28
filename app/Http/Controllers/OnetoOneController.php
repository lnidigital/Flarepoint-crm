<?php
namespace App\Http\Controllers;

use Carbon;
use Config;
use Dinero;
use Datatables;
use App\Models\OnetoOne;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Onetoone\StoreOnetoOneRequest;
use App\Http\Requests\Onetoone\UpdateOnetoOneRequest;
use App\Http\Requests\Referral\UpdateReferralRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\Meeting\MeetingRepositoryContract;

class OnetoOneController extends Controller
{

    protected $settings;
    protected $onetoones;
    protected $members;

    public function __construct(
        ContactRepositoryContract $members,
        OnetoOneRepositoryContract $onetoones,
        SettingRepositoryContract $settings,
        MeetingRepositoryContract $meetings
    )
    {
        $this->members = $members;
        $this->onetoones = $onetoones;
        $this->settings = $settings;
        $this->meetings = $meetings;
        $this->middleware('onetoone.create', ['only' => ['create']]);
        $this->middleware('onetoone.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('onetoones.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $onetoones = OnetoOne::select(['oneto_ones.id', 'first_contact_id', 'second_contact_id', 'onetoone_date', 'description'])->join('contacts', 'oneto_ones.first_contact_id', '=', 'contacts.id');
        return Datatables::of($onetoones)
            ->addColumn('first_contact_name', function ($onetoones) {
                return $this->members->find($onetoones->first_contact_id)->name;
            })
            ->addColumn('second_contact_name', function ($onetoones) {
                return $this->members->find($onetoones->second_contact_id)->name;
            })
            ->addColumn('onetoone_date_formatted', function ($onetoones) {
                $date = Carbon::parse($onetoones->onetoone_date);
                return $date->format('F d, Y');
            })
            ->add_column('edit', '
                <a href="{{ route(\'onetoones.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'onetoones.destroy\', $id) }}" method="POST">
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

        return view('onetoones.create')
            ->withMembers($this->members->getAllMembersSelect($group_id))
            ->withMeetings($this->meetings->getAllMeetingsSelect($group_id));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreOnetoOneRequest $request)
    {
        $this->onetoones->create($request->all());
        return redirect()->route('onetoones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('onetoones.show')
            ->withOnetoOne($this->onetoones->find($id));
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

        return view('onetoones.edit')
            ->with('onetoone', $this->onetoones->find($id))
            ->withMembers($this->members->getAllMembersSelect($group_id))
            ->withMeetings($this->meetings->getAllMeetingsSelect($group_id));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateOnetoOneRequest $request)
    {
        $this->onetoones->update($id, $request);
        Session()->flash('flash_message', 'One-to-One successfully updated');
        return redirect()->route('onetoones.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->onetoones->destroy($id);

        return redirect()->route('onetoones.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAssign($id, Request $request)
    {
        $this->onetoones->updateAssign($id, $request);
        Session()->flash('flash_message', 'New user is assigned');
        return redirect()->back();
    }

}
