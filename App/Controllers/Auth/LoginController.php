<?php

require  'App/Validation/auth/loginValidation.php';

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/ClearInputs.php';
require  'App/Helpers/Authenticate.php';

class LoginController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		

	}

	public function index(){
		return $this->view('template1/pages/auth/login',$this->view_data);
	}

	public function login(){
		
		$posts = $_POST;
		$model = $this->model('auth/UsersModel');

		//validation geçerse temizle kaydet...
		new loginValidation($posts);

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;
		
		//Authenticate class;
		$authenticate = new Authenticate();
		$authenticate->Auth($posts,$model); 
		
		
	}


}