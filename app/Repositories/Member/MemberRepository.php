<?php
namespace App\Repositories\Member;

use App\Models\Member;
use App\Models\Industry;
use App\Models\Invoice;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Log;

/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class MemberRepository implements MemberRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Member::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllMembers()
    {
        return Member::pluck('name', 'id');
    }

    /**
     * @return mixed
     */
    public function getMembers($group_id)
    {
        return Member::where('group_id',$group_id)->get();
    }

    /**
     * @return mixed
     */
    public function getMembersSelect($group_id)
    {
        Log::info('getMembersSelect group_id: '.$group_id);
        
        return Member::where('group_id',$group_id)->pluck('name','id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = Member::findOrFail($id)->invoices()->with('invoiceLines')->get();

        return $invoice;
    }

    public function getAllMembers() 
    {
        return Member::all()
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
        $member = User::create($requestData);
        Session()->flash('flash_message', 'Member successfully added');
        event(new \App\Events\MemberAction($member, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Member::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Member::findorFail($id);
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
        $member = Member::with('user')->findOrFail($id);
        $member->user_id = $requestData->get('user_assigned_id');
        $member->save();

        event(new \App\Events\ClientAction($member, self::UPDATED_ASSIGN));
    }
}
