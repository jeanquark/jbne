<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description'
    ];

	// public function users()
	// {
	// 	return $this->belongsToMany('App\User', 'role_user');
	// }

	public function members()
	{
		return $this->belongsToMany('App\Member', 'role_member');
	}

	public function permissions()
	{
		return $this->belongsToMany('App\Permission', 'permission_role');
	}
}