<?php
namespace App\Repositories\Group;

use App\Models\Group;

/**
 * Class DepartmentRepository
 * @package App\Repositories\Group
 */
class GroupRepository implements GroupRepositoryContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllGroups()
    {
        return Group::all();
    }

    /**
     * @return mixed
     */
    public function listAllGroups($organizationId)
    {
        return Group::where('organization_id',$organizationId)->pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        Group::create($requestData->all());
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Group::findorFail($id)->delete();
    }
}
