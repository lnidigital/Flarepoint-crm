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

    public function getOnetoOnesByMeeting($meetingId) 
    {   
        return OnetoOne::where('meeting_id', $meetingId)->get();
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
        $member = OnetoOne::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $onetoone = OnetoOne::findorFail($id);
            $onetoone->delete();
            Session()->flash('flash_message', 'One-to-one successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'One-to-one can NOT be deleted');
        }
    }

    /**
     * @return mixed
     */
    public function onetoOnesMadeThisMonth($groupId)
    {
        return DB::table('oneto_ones')
            ->select(DB::raw('count(*) as total, updated_at'))
            ->where('group_id',$groupId)
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @return mixed
     */
    public function createdOnetoOnesMothly($groupId)
    {
        return DB::table('oneto_ones')
            ->select(DB::raw('count(*) as month, created_at'))
            ->where('group_id',$groupId)
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();
    }

}
