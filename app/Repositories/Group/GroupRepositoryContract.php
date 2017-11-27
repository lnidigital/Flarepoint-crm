<?php
namespace App\Repositories\Group;

interface GroupRepositoryContract
{
    public function getAllGroups();
    
    public function listAllGroups($organizationId);

    public function create($requestData);

    public function destroy($id);
}
