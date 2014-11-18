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
}