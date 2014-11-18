<?php


class Note extends Eloquent 
{
    public function getProfile()
    {
        $user = DB::table('notes')
        				->join('users','notes.user_id','=','users.id')
        				->join('users_profile','notes.user_id','=','users_profile.user_id')
        				->join('users as author','notes.author_id','=','author.id')
        				->select('users.id',
                        	'users.username',
                        	'users.email',
                        	'users_profile.first_name as first_name',
                        	'users_profile.last_name as last_name',
                        	'users_profile.tel as tel',
                        	'notes.notes as note',
                        	'notes.created_at as created',
                        	'author.username as author'
                        	)->get();

        return $user;
    }
}