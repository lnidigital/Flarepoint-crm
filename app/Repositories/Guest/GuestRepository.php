<?php
namespace App\Repositories\Guest;

use App\Models\Guest;
use App\Models\Industry;
use App\Models\Invoice;
use App\Models\User;
use DB;
use Carbon;

/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class GuestRepository implements GuestRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Guest::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllGuests()
    {
        return Guest::pluck('name', 'id');
    }

    
    // public function getAllGuests() 
    // {   
    //     return Guest::all()
    //     ->pluck('name', 'id');
    // }

    /**
     * @return mixed
     */
    public function guestsMadeThisMonth()
    {
        return DB::table('guests')
            ->select(DB::raw('count(*) as total, updated_at'))
            ->whereBetween('updated_at', [Carbon::now()->startOfMonth(), Carbon::now()])->get();
    }

    /**
     * @return int
     */
    public function getAllGuestsCount()
    {
        return Guest::all()->count();
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
        $guest = Guest::create($requestData);
        Session()->flash('flash_message', 'Guest successfully added');
        event(new \App\Events\GuestAction($guest, self::CREATED));
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $guest = Guest::findOrFail($id);
        $guest->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $guest = Guest::findorFail($id);
            $guest->delete();
            Session()->flash('flash_message', 'Guest successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'Guest can NOT be deleted');
        }
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateAssign($id, $requestData)
    {
        $guest = Guest::with('user')->findOrFail($id);
        $guest->user_id = $requestData->get('user_assigned_id');
        $guest->save();

        event(new \App\Events\GuestAction($guest, self::UPDATED_ASSIGN));
    }
}
