<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class KategoriController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		

	}

	public function index(){

		return $this->view('template1/pages/user/kategoriler',$this->view_data);
	}

	public function store(){
		
		$posts = $_POST;

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		if(empty($posts["ust_cat"])){
			$posts["ust_cat"] = 0;
		}

		$model = $this->model('user/KategoriModel');
		$save = $model->save($posts);

		if($save){
			echo json_encode(['message' => "Kayıt Başarılı" ,"status" => 200]);
		}else{
			echo json_encode(['message' => "Kayıt Başarısız!" ,"status" => 400]);
		}

	}
	

}