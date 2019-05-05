<?php 
namespace App\Libraries\Foundation\User;

trait HasRoles{
	public function roles(){
		return $this->belongsToMany('\App\Libraries\Service\Role', 'users_roles', 'user_id', 'role_id')->withTimestamps();
	}
	
	public function hasRole($key){
		return $this->roles()->where('id',$key)->first()? true : false;
	}
	
	public function hasRoleContext($key){
		return $this->roles()->where('context',$key)->first()? true : false;
	}
	
	public function grantRole($key){
		$data = \Auth::user()? ['creator'=>\Auth::user()->id] : [];
		$this->roles()->attach($key, $data);
	}
	
	public function revokeRole($key){
		$this->roles()->detach($key);
	}
}