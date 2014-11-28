<?php

class Profile extends Eloquent {
	protected $table = 'users_profile';

	public function getCountProfileByUserId( $user_id )
	{
		return $this->where('user_id','=',$user_id)->count();
	}

	public function getProfileByUserId( $user_id )
	{
		return $this->where('user_id','=',$user_id)->first();
	}

	public function updateProfile($user_id,$first_name,$last_name,$address,$mobilephone)
	{
		$update_profile = Profile::where('user_id',$user_id)->update(array(
					            'first_name' => $first_name,
					            'last_name' =>  $last_name,
					            'address'   => $address,
					            'mobilephone'   =>  $mobilephone
					        ));
        return $update_profile;
	}
}