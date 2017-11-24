<?php
namespace App\Repositories\Referral;

use App\Models\Referral;
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
class ReferralRepository implements ReferralRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Referral::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return Referral::pluck('name', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = Referral::findOrFail($id)->invoices()->with('invoiceLines')->get();

        return $invoice;
    }

    public function getAllMembers() 
    {   
        return Referral::all()
        ->pluck('name', 'id');
    }

    /**
     * @return int
     */
    public function getAllMembersCount()
    {
        return Referral::all()->count();
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
        Log::info('requestData:'.json_encode($requestData));
        $referral = Referral::create($requestData);
        Session()->flash('flash_message', 'Referral successfully added');
        event(new \App\Events\ReferralAction($referral, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Referral::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Referral::findorFail($id);
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
        $member = Referral::with('user')->findOrFail($id);
        $member->user_id = $requestData->get('user_assigned_id');
        $member->save();

        event(new \App\Events\ClientAction($member, self::UPDATED_ASSIGN));
    }


    /**
     * @return mixed
     */
    public function referralsMadeThisMonth()
    {
        return DB::table('referrals')
            ->select(DB::raw('count(*) as total, updated_at'))
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }
}
