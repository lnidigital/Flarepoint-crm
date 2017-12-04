<?php
namespace App\Repositories\Organization;

use App\Models\Organization;
use Illuminate\Support\Facades\Log;

/**
 * Class DepartmentRepository
 * @package App\Repositories\Group
 */
class OrganizationRepository implements OrganizationRepositoryContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllOrganizationsSelect()
    {
        return Organization::select('id', 'name', 'user_id')
                ->pluck('name', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOrganizationsByUserSelect($userId)
    {
        return Organization::select('organizations.id', 'organizations.name', 'organizations.user_id')
                 ->join('organization_user','organization_user.organization_id','organizations.id')
                ->where('organization_user.user_id',$userId)
                ->pluck('name', 'id');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Organization::findOrFail($id);
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        Log::info('OrganizationRepository->create: entering');
        $organization = Organization::create($requestData->all());
        $organization->users()->attach($requestData->user_id);
        Log::info('OrganizationRepository->create: leaving');
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $organization = Organization::findOrFail($id);
        $organization->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Organization::findorFail($id)->delete();
    }
}
