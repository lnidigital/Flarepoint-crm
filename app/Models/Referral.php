<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'from_member_id',
        'to_member_id',
        'referral_date',
        'group_id',
        'description'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
