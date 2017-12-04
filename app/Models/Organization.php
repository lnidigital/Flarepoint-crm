<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
	protected $fillable = [
        'name',
        'user_id'
    ];

    public function users() 
    {
    	return $this->belongsToMany(User::class, 'organization_user');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'organization_id', 'id');
    }
}
