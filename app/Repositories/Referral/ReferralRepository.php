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

    
    public function getReferralsByGroup($groupId) 
    {   
        return Referral::where('group_id', $groupId)->get();
    }

    public function getReferralsByGroupSelect($groupId) 
    {   
        return Referral::where('group_id', $groupId)
                ->pluck('from_contact_id', 'to_contact_id', 'referral_date');
    }

    public function getReferralsByMeeting($meetingId) 
    {   
        return Referral::where('meeting_id', $meetingId)->get();
    }

    public function getReferralsByGiver($contactId) 
    {   
        return Referral::where('from_contact_id', $contactId)->get();
    }

    public function getReferralsByReceiverSelect($contactId) 
    {   
        return Referral::where('to_contact_id', $contactId)
                ->pluck('from_contact_id', 'to_contact_id', 'referral_date');
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
    public function numReferralsGivenByContact($groupId, $contactId)
    {
        return DB::table('referrals')
            ->select(DB::raw('count(*) as total'))
            ->where('group_id', $groupId)
            ->where('from_contact_id', $contactId)
            ->value('total');
    }

    /**
     * @return mixed
     */
    public function numReferralsReceivedByContact($groupId, $contactId)
    {
        return DB::table('referrals')
            ->select(DB::raw('count(*) as total'))
            ->where('group_id', $groupId)
            ->where('to_contact_id', $contactId)
            ->value('total');
    }

    /**
     * @return mixed
     */
    public function referralsMadeThisMonth($groupId)
    {
        return DB::table('referrals')
            ->select(DB::raw('count(*) as total, referral_date'))
            ->where('group_id', $groupId)
            ->whereBetween('referral_date', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @return mixed
     */
    public function createdReferralsMothly($groupId)
    {
        return DB::table('referrals')
            ->select(DB::raw('count(*) as month, referral_date'))
            ->where('group_id', $groupId)
            ->groupBy(DB::raw('YEAR(referral_date), MONTH(referral_date)'))
            ->get();
    }
}
