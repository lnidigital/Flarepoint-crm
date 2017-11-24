<?php
namespace App\Repositories\Onetoone;

use App\Models\OnetoOne;
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
class OnetoOneRepository implements OnetoOneRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return OnetoOne::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return OnetoOne::pluck('name', 'id');
    }

    public function onetoonesMadeThisMonth()
    {
        return DB::table('oneto_ones')
            ->select(DB::raw('count(*) as total, updated_at'))
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = OnetoOne::findOrFail($id)->invoices()->with('invoiceLines')->get();

        return $invoice;
    }

    public function getAllMembers() 
    {   
        return OnetoOne::all()
        ->pluck('name', 'id');
    }

    /**
     * @return int
     */
    public function getAllMembersCount()
    {
        return OnetoOne::all()->count();
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
        $referral = OnetoOne::create($requestData);
        Session()->flash('flash_message', '1-to-1 successfully added');
        event(new \App\Events\OnetoOneAction($referral, self::CREATED));
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
