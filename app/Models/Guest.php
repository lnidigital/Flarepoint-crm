<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'address',
        'zipcode',
        'city',
        'primary_number',
        'secondary_number',
        'industry_id',
        'user_id',
        'contact_id',
        'group_id'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'contact_id', 'id');
    }


}
