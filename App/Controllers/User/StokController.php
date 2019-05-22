<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class StokController extends BaseController
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

		return $this->view('template1/pages/user/stoklar',$this->view_data);
	}

	public function store(){
		
		$posts = $_POST;

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		array_pop($posts);

		$model = $this->model('user/StokModel');
		$save = $model->save($posts);

		if($save){
			echo json_encode(['message' => "Kayıt Başarılı" ,"status" => 200]);
		}else{
			echo json_encode(['message' => "Kayıt Başarısız!" ,"status" => 400]);
		}

	}

	public function destroy(){
		$posts = $_POST;

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		$model = $this->model('user/StokModel');
		$save = $model->destroy($posts);

		if($save){
			echo json_encode(['message' => "Silindi" ,"status" => 200]);
		}else{
			echo json_encode(['message' => "Silinemedi!" ,"status" => 400]);
		}

	}
	

}