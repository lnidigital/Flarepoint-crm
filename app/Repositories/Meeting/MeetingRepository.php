<?php
namespace App\Repositories\Meeting;

use App\Models\Meeting;
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
class MeetingRepository implements MeetingRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Meeting::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return Meeting::pluck('name', 'id');
    }

    public function getAllMeetingsSelect($groupId) 
    {   
        return Meeting::where('group_id',$groupId)
        ->orderBy('meeting_date','desc')
        ->pluck('meeting_date', 'id');
    }

    /**
     * @return int
     */
    public function getAllMembersCount()
    {
        return Meeting::all()->count();
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
        $meeting = Meeting::create($requestData);
        Session()->flash('flash_message', 'Meeting successfully added');
        event(new \App\Events\MeetingAction($meeting, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Meeting::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $meeting = Meeting::findorFail($id);
            $meeting->delete();
            Session()->flash('flash_message', 'Meeting successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'Meeting can NOT be deleted');
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
    public function numMeetingsByContact($groupId, $contactId)
    {
        return DB::table('meetings')
            ->select(DB::raw('count(*) as total'))
            ->join('attendances', 'meeting_id', 'id')
            ->where('attendances.contact_id', $contactId)
            ->where('meetings.group_id', $groupId)
            ->value('total');

        return DB::table('contacts')
            ->select(DB::raw('count(*) as total, attendances.updated_at'))
            ->join('attendances', 'contact_id', 'id')
            ->where('status', 2)
            ->where('group_id',$groupId)
            ->whereBetween('attendances.updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    
}
