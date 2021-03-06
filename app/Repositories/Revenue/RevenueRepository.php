<?php
namespace App\Repositories\Revenue;

use App\Models\Revenue;
use App\Models\Industry;
use App\Models\Invoice;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Log;
use Carbon;

/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class RevenueRepository implements RevenueRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Revenue::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return Revenue::pluck('name', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = Revenue::findOrFail($id)->invoices()->with('invoiceLines')->get();

        return $invoice;
    }

    public function getAllMembers() 
    {   
        return Revenue::all()
        ->pluck('name', 'id');
    }

    /**
     * @return int
     */
    public function getAllMembersCount()
    {
        return Revenue::all()->count();
    }

    /**
     * @return mixed
     */
    public function listAllIndustries()
    {
        return Industry::pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        //Log::info('requestData:'.json_encode($requestData));
        $Revenue = Revenue::create($requestData);
        Session()->flash('flash_message', 'Revenue successfully added');
        event(new \App\Events\RevenueAction($Revenue, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Revenue::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Revenue::findorFail($id);
            $client->delete();
            Session()->flash('flash_message', 'Member successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'Member can NOT be deleted');
        }
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateAssign($id, $requestData)
    {
        $member = Revenue::with('user')->findOrFail($id);
        $member->user_id = $requestData->get('user_assigned_id');
        $member->save();

        event(new \App\Events\ClientAction($member, self::UPDATED_ASSIGN));
    }

    /**
     * @return mixed
     */
    public function numRevenuesByContact($groupId, $contactId)
    {
        return DB::table('revenues')
            ->select(DB::raw('count(*) as total'))
            ->where('group_id', $groupId)
            ->where('contact_id', $contactId)
            ->value('total');
    }

    /**
     * @return mixed
     */
    public function revenuesMadeThisMonth($groupId)
    {
        return DB::table('revenues')
            ->select(DB::raw('sum(amount) as total, updated_at'))
            ->where('group_id',$groupId)
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @return mixed
     */
    public function createdRevenuesMothly($groupId)
    {
        return DB::table('revenues')
            ->select(DB::raw('sum(amount) as month, report_date'))
            ->where('group_id',$groupId)
            ->groupBy(DB::raw('YEAR(report_date), MONTH(report_date)'))
            ->get();
    }
}
