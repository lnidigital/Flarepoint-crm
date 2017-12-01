<?php
namespace App\Repositories\Attendance;

interface AttendanceRepositoryContract
{
    public function find($id);

    public function create($requestData);

    public function update($id, $requestData);

    public function destroy($id);
}
