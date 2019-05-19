<?php

require  'App/Validation/auth/registerValidation.php';

class RegisterController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{
		session_start();

		if(isset($_SESSION['errors'])){
			
			if (isset($_SESSION['errors']['validation'])) {
				$this->view_data["returned_Inputs_message"] = $_SESSION['errors']['validation'];
				$this->view_data['returned_Inputs'] = array_keys($_SESSION['errors']['validation']);
			}
			$this->view_data["errors"] = $_SESSION["errors"];
			$_SESSION['errors'] = null;
		}


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
		foreach ($posts as $k => $v) {
			$posts[$k] = htmlspecialchars(trim($v));
		}

		
		$posts['role_id']  = $model->getRole("User")->id;
		$posts['password'] = password_hash($posts["password"], PASSWORD_DEFAULT);
		
		//$model->insert($posts);
		
		if( $model->insert($posts) ){
			header('location: '.APP_URL);
		}

		

		//return $this->view('template1/pages/auth/register');
	}


}