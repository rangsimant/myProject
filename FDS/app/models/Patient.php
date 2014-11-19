<?php

class Patient extends Eloquent
{
	public function getPatient()
	{
		$patient = DB::table('users_profile')
					->join('users','users_profile.user_id','=','users.id')
					->join('assigned_roles','users.id','=','assigned_roles.user_id')
					->join('roles','assigned_roles.role_id','=','roles.id')
					->select('users_profile.first_name',
							'users_profile.last_name',
							'users_profile.address',
							'users_profile.tel',
							'users.username',
							'users.id',
							'users.email',
							'assigned_roles.role_id',
							'roles.name as role_name'
							)
					->get();
		return $patient;
	}
}