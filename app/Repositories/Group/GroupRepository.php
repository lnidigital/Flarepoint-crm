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
    public function getAllGroupsByUser($userId)
    {
        return Group::select('groups.name', 'groups.id')
                ->join('group_user', 'groups.id', 'group_user.group_id')
                ->where('group_user.user_id',$userId)
                ->pluck('groups.name', 'groups.id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllGroupsByOrganization($organizationIds)
    {
        return Group::select('groups.name', 'groups.id')
                ->join('organizations', 'organizations.id', 'groups.organization_id')
                ->whereIn('organizations.id',$organizationIds)
                ->pluck('groups.name', 'groups.id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllGroups()
    {
        return Group::select('groups.name', 'groups.id','organizations.name')
                ->join('organizations', 'organizations.id', 'groups.organization_id')
                ->pluck('groups.name', 'groups.id','organizations.name');
    }

    /**
     * @return mixed
     */
    public function listAllGroups($organizationId)
    {
        return Group::where('organization_id',$organizationId)->pluck('name', 'id');
    }

    /**
     * @return mixed
     */
    public function listAllGroupsByUser($userId)
    {
        $groups = Group::select('groups.name','groups.id')
                    ->join('organizations','.organizations.id','groups.organization_id')
                    ->pluck('groups.name', 'groups.id');

        // if (auth()->user()->hasRole('super'))
        //     $groups = Group::all()->pluck('name', 'id');
        // elseif (auth()->user()->hasRole('administrator'))
        // {
        //     $organizationIds = Organization::select(['id'])
        //                         ->join('organization_users','organization_id','id')
        //                         ->where('organization_users.user_id',auth()->user()->id);

        //     $groups = Group::where('organization_id', auth()->user()->organization()->id)
        //                 ->pluck('name', 'id');
        // }

        return $groups;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Group::findOrFail($id);
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $group = Group::findOrFail($id);
        $group->fill($requestData->all())->save();
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        $group = Group::create($requestData->all());
        $group->users()->attach($requestData->user_id);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Group::findorFail($id)->delete();
    }
}
