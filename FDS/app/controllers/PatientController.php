<?php
class PatientController extends BaseController 
{
	    /**
     * Initializer.
     *
     * @return \AdminController
     */
    public function __construct()
    {
        parent::__construct();
    }
    
	public function getIndex()
	{
		$title = Lang::get('patient/patient.title');
		$patient = Patient::getPatient();
        foreach ($patient as $idx => $value) {
            $patient[$idx]->countnote = Patient::getCountNote($value->user_id);
        }
		return View::make('site/patient/index',compact('patient','title'));
	}

    public function showProfile()
    {
        $user_id = $_GET['user_id'];
        $profile = Patient::getProfile($user_id);
        $note =  Note::getNote($user_id);
        return Response::json( array('profile'=>$profile,'note'=>$note) );
    }

	public function create()
	{
		$this->checkOurForm();
 
        $input = Input::all();
        Note::saveNote($input['user_id'],$input['author_id'],$input['note']);
 
        return Response::json( $input );
	}

    public function deleteNote()
    {
        $note_id = $_POST['note_id'];
        Note::deleteNote($note_id);
    }

    public function updateProfile()
    {
        $this->checkOurForm();

        $profile = new Profile();
        $user_id = Input::get( 'user_id' );
        $first_name = Input::get( 'first_name' );
        $last_name = Input::get( 'last_name' );
        $address = Input::get( 'address' );
        $tel = Input::get( 'tel' );
        
        // Update Profile
        $profile->updateProfile($user_id,$first_name,$last_name,$address,$tel);
    }

    private function checkOurForm()
    {
        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }
    }
}