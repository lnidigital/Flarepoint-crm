<?php
namespace App\Repositories\Contact;

interface ContactRepositoryContract
{
    public function find($id);

    public function listAllMembers();

    public function getAllMembersCount();

    public function listAllIndustries();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}
