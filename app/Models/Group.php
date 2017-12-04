<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = [
        'name',
        'user_id',
        'organization_id'
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function users() 
    {
    	return $this->belongsToMany(User::class, 'group_user');
    }
}
