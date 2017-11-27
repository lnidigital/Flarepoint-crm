<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   protected $fillable =
        [
            'meeting_id',
            'contact_id'
        ];
}
