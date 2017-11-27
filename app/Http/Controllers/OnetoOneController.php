<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\OnetoOne;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Onetoone\StoreOnetoOneRequest;
use App\Http\Requests\Referral\UpdateReferralRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Onetoone\OnetoOneRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;

class OnetoOneController extends Controller
{

    protected $settings;
    protected $onetoones;
    protected $members;

    public function __construct(
        ContactRepositoryContract $members,
        OnetoOneRepositoryContract $onetoones,
        SettingRepositoryContract $settings
    )
    {
        $this->members = $members;
        $this->onetoones = $onetoones;
        $this->settings = $settings;
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
        $onetoones = OnetoOne::select(['id', 'first_contact_id', 'second_contact_id', 'onetoone_date', 'description']);
        return Datatables::of($onetoones)
            ->addColumn('first_member_name', function ($onetoones) {
                return $this->members->find($onetoones->first_member_id)->name;
            })
            ->addColumn('second_member_name', function ($onetoones) {
                return $this->members->find($onetoones->second_member_id)->name;
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

        return view('onetoones.create')
            ->withMembers($this->members->getAllMembers($group_id));
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
            ->withOnetoOne($this->onetoones->find($id))
            ->withMembers($this->members->getAllMembers($group_id));
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
