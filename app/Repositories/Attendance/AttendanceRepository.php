<?php
namespace App\Repositories\Attendance;

use App\Models\Attendance;
use DB;

/**
 * Class DepartmentRepository
 * @package App\Repositories\Group
 */
class AttendanceRepository implements AttendanceRepositoryContract
{
    
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Contact::findOrFail($id);
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
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $member = Contact::findOrFail($id);
        $member->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Group::findorFail($id)->delete();
    }

    /**
     * @return mixed
     */
    public function attendanceMonthly($groupId)
    {
        return DB::table('attendances')
            ->select(DB::raw('count(*) as month, meetings.meeting_date'))
            ->join('meetings','id','meeting_id')
            ->where('group_id',$groupId)
            ->groupBy(DB::raw('YEAR(meetings.meeting_date), MONTH(meetings.meeting_date)'))
            ->get();
    }
}
