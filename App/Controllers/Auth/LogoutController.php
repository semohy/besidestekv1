<?php

require  'App/Validation/auth/loginValidation.php';

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/ClearInputs.php';
require  'App/Helpers/Authenticate.php';

class LogoutController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		

	}

	public function logout(){
		session_destroy();
		header('location: '.APP_URL.'login');
	}


}