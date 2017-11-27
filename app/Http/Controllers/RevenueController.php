<?php
namespace App\Http\Controllers;

use Config;
use Dinero;
use Datatables;
use App\Models\Revenue;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Revenue\StoreRevenueRequest;
use App\Http\Requests\Revenue\UpdateRevenueRequest;
use App\Repositories\Contact\ContactRepositoryContract;
use App\Repositories\Revenue\RevenueRepositoryContract;
use App\Repositories\Setting\SettingRepositoryContract;
use Illuminate\Support\Facades\Log;

class RevenueController extends Controller
{

    protected $settings;
    protected $revenues;
    protected $members;

    public function __construct(
        ContactRepositoryContract $members,
        RevenueRepositoryContract $revenues,
        SettingRepositoryContract $settings
    )
    {
        $this->members = $members;
        $this->revenues = $revenues;
        $this->settings = $settings;
        $this->middleware('revenue.create', ['only' => ['create']]);
        $this->middleware('revenue.update', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('revenues.index');
    }

    /**
     * Make json respnse for datatables
     * @return mixed
     */
    public function anyData()
    {
        $revenue = Revenue::select(['id', 'contact_id', 'amount', 'report_date', 'group_id', 'description']);
        return Datatables::of($revenue)
            ->addColumn('name', function ($revenue) {
                return $this->members->find($revenue->member_id)->name;
            })
            ->add_column('edit', '
                <a href="{{ route(\'revenues.edit\', $id) }}" class="btn btn-success" >Edit</a>')
            ->add_column('delete', '
                <form action="{{ route(\'revenues.destroy\', $id) }}" method="POST">
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

        return view('revenues.create')
            ->withMembers($this->members->getAllMembers($group_id));
    }

    /**
     * @param StoreClientRequest $request
     * @return mixed
     */
    public function store(StoreRevenueRequest $request)
    {
        Log::info('revenue request:'.json_encode($request->all()));
        $this->revenues->create($request->all());
        return redirect()->route('revenues.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return view('revenues.show')
            ->withClient($this->clients->find($id))
            ->withCompanyname($this->settings->getCompanyName())
            ->withInvoices($this->clients->getInvoices($id))
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
        $group_id = 1;

        return view('revenues.edit')
            ->withRevenue($this->revenues->find($id))
            ->withMembers($this->members->getAllMembers($group_id));
    }

    /**
     * @param $id
     * @param UpdateClientRequest $request
     * @return mixed
     */
    public function update($id, UpdateRevenueRequest $request)
    {
        $this->revenues->update($id, $request);
        Session()->flash('flash_message', 'Revenue successfully updated');
        return redirect()->route('revenues.index');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->revenues->destroy($id);

        return redirect()->route('revenues.index');
    }

}
