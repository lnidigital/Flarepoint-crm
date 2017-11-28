<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnetoOne extends Model
{
    protected $fillable = [
        'first_contact_id',
        'second_contact_id',
        'onetoone_date',
        'group_id',
        'meeting_id',
        'description'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
