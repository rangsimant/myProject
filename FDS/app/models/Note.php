<?php


class Note extends Eloquent 
{
    protected $table = "notes";
    protected $guarded = array('*');

    public static function saveNote($user_id,$author_id,$txtnote)
    {
        $note = new Note;
        $note->author_id = $author_id;
        $note->user_id = $user_id;
        $note->notes = $txtnote;
        $note->save();
    }

    public static function getNote($user_id)
    {
    	$note = DB::table('notes')
    			->join('users_profile as user','notes.user_id','=','user.user_id')
    			->join('users_profile as author','notes.user_id','=','author.user_id')
                ->join('assigned_roles','notes.user_id','=','assigned_roles.user_id')
                ->join('roles','assigned_roles.role_id','=','roles.id')
    			->select('user.first_name as user_first_name',
    					'user.last_name as user_last_name',
    					'author.first_name as author_first_name',
    					'author.last_name as author_last_name',
    					'notes.id',
    					'notes.notes',
                        'notes.created_at',
    					'notes.updated_at',
                        'roles.name as role_name')
    			->where('notes.user_id','=',$user_id)
                ->orderBy('notes.updated_at', 'desc')
    			->get();
		return $note;
    }

    public static function deleteNote($note_id)
    {
        $note = Note::find($note_id);
        $note->delete();

        return $note;
    }
}