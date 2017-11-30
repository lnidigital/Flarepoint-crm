<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'contact_id',
        'amount',
        'report_date',
        'group_id',
        'referral_id',
        'description'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'contact_id', 'id');
    }
}
