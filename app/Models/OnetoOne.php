<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnetoOne extends Model
{
    protected $fillable = [
        'first_member_id',
        'second_member_id',
        'onetoone_date',
        'group_id',
        'description'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
