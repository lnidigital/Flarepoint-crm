<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'meeting_date',
        'meeting_notes',
        'group_id'
    ];


    public function getMeetingDateAttribute($value)
    {
    	$date = Carbon::parse($value);
        return $date->format('F d, Y');
    }

    
}
