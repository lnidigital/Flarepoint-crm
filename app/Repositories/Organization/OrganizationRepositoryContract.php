<?php
namespace App\Repositories\Organization;

interface OrganizationRepositoryContract
{
    public function getAllOrganizationsSelect();
    
    public function create($requestData);

    public function destroy($id);
}
