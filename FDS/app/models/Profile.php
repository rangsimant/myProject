<?php

class Profile extends Eloquent {
	protected $table = 'users_profile';

	public function getProfileByUserId( $user_id )
	{
		return $this->where('user_id','=',$user_id)->count();
	}
}