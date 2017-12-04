<?php
namespace App\Repositories\Group;

interface GroupRepositoryContract
{
    public function getAllGroupsByUser($userId);
    
    public function listAllGroups($organizationId);

    public function create($requestData);

    public function destroy($id);
}
