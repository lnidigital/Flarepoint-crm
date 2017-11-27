<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'address',
        'zipcode',
        'city',
        'state',
        'primary_number',
        'secondary_number',
        'image_path',
        'industry_id',
        'user_id',
        'group_id',
        'is_guest'
    ];

}
