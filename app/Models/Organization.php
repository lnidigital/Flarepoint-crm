<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function groups()
    {
        return $this->hasMany(Group::class, 'organization_id', 'id');
    }
}
