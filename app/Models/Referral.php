<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'from_contact_id',
        'to_contact_id',
        'referral_date',
        'group_id',
        'meeting_id',
        'description'
    ];

    public function member()
    {
        return $this->belongsTo(Contact::class, 'from_contact_id', 'id');
    }
}
