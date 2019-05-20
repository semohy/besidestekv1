<?php

require  'App/Validation/auth/registerValidation.php';
require  'App/Helpers/SessionErrorHandler.php';
require 'App/Helpers/ClearInputs.php';

require  'App/Helpers/Authenticate.php';

class RegisterController extends BaseController
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
		return $this->view('template1/pages/auth/register',$this->view_data);
	}

	public function store(){
		$posts = $_POST;
		$model = $this->model('auth/UsersModel');
		
		//validation geçerse temizle kaydet...
		new registerValidation($posts);

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;
		
		//deger ata
		$posts['role_id']  = $model->getRole("User")->id;
		$posts['password'] = password_hash($posts["password"], PASSWORD_DEFAULT);
		
		if( $model->insert($posts) ){
			header('location: '.APP_URL);
		}
	}


}