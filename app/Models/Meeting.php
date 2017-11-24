<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'meeting_date',
        'meeting_notes',
        'group_id'
    ];}
