<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class Helper
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

    public static function checkMeetingAttended($meetingId, $memberId)
    {
        $attendance = Attendance::where('meeting_id',$meetingId)->where('contact_id',$memberId)->first();

        if ($attendance != null)
            return 'checked';
        else
            return '';
    }

    public static function getFeatureName($id) 
    {
        //$features 
    }

    public static function formatTime($d, $t)
    {
        return date("g:ia", strtotime($d . " " . $t . ":00"));
    }

    public static function formatDate($d, $format=null) 
    {
        $date=date_create($d);

        if ($format != null)
            return date_format($date,$format);
        else
            return date_format($date,"M d, Y");
    }

    public static function formatRevenue($revenue)
    {
        if ($revenue == null || $revenue == "")
            return "$0";
        else
            return '$'.number_format($revenue);
    }

    public static function isLoggedinUser($id) 
    {
        return Auth::id() == $id;
    }

    public static function getContactName($id)
    {
        $contact = Contact::find($id);
        return $contact->name;
    }

    public static function getGroupId() 
    {
        $groupId = session('user_group_id');

        if ($groupId == null) {
            $groupId = Auth::user()->default_group;
        }

        return $groupId;
    }
}




?>