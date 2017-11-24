<?php
namespace App\Repositories\Meeting;

interface MeetingRepositoryContract
{
    public function find($id);

    public function listAllMembers();

    public function getInvoices($id);

    public function getAllMembersCount();

    public function listAllIndustries();

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}
