<?php
namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Models\Industry;
use App\Models\Invoice;
use App\Models\User;
use DB;
use Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class ContactRepository implements ContactRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Contact::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return Contact::pluck('name', 'id');
    }

    /**
     * @return mixed
     */
    public function getAllMembers($group_id)
    {
        return Contact::where('group_id',$group_id)
                ->where('status',1)
                ->orderBy('name', 'asc')
                ->get();
    }

    /**
     * @return mixed
     */
    public function getAllGuests($group_id)
    {
        return Contact::where('group_id',$group_id)
                ->where('status',2)
                ->orderBy('name', 'asc')
                ->get();
    }

    /**
     * @return mixed
     */
    public function getAllMembersSelect($group_id)
    {
        //Log::info('getMembersSelect group_id: '.$group_id);
        
        return Contact::where('group_id',$group_id)
                ->where('status',1)
                ->orderBy('name', 'asc')
                ->pluck('name','id');
    }

    /**
     * @return mixed
     */
    public function getAllContacts($group_id)
    {
        //Log::info('getMembersSelect group_id: '.$group_id);
        
        return Contact::where('group_id',$group_id)
                        ->orderBy('status')
                        ->orderBy('name', 'asc')
                        ->get();
    }

    public function getAllMembersNameId() 
    {
        return Contact::all()   
        ->pluck('name', 'id');
    }

    /**
     * @return int
     */
    public function getAllMembersCount()
    {
        return Member::all()->count();
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
        $contact = Contact::create($requestData);
        Session()->flash('flash_message', 'Contact successfully added');
        event(new \App\Events\ContactAction($contact, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Contact::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Contact::findorFail($id);
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
        $member = Contact::with('user')->findOrFail($id);
        $member->user_id = $requestData->get('user_assigned_id');
        $member->save();

        event(new \App\Events\ClientAction($member, self::UPDATED_ASSIGN));
    }

    /**
     * @return mixed
     */
    public function numGuestsByContact($groupId, $contactId)
    {
        return DB::table('contacts')
            ->select(DB::raw('count(*) as total'))
            ->where('group_id', $groupId)
            ->where('referrer_id', $contactId)
            ->value('total');
    }

    /**
     * @return mixed
     */
    public function guestsMadeThisMonth($groupId)
    {
        return DB::table('contacts')
            ->select(DB::raw('count(*) as total, attendances.updated_at'))
            ->join('attendances', 'contact_id', 'id')
            ->where('status', 2)
            ->where('group_id',$groupId)
            ->whereBetween('attendances.updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }
}
