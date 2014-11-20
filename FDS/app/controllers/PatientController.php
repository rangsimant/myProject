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
		$getpatient = new Patient();
		$patient = $getpatient->getPatient();
		return View::make('site/patient/index',compact('patient','title'));
	}

	public function create()
	{
		  //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }
 
        //.....
        //validate data
        //and then store it in DB
        //.....
 
        $patient = Input::all();
 
        return Response::json( $patient );
	}
}