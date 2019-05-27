<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

class DashboardController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		
		$this->stokModel = $this->model("user/StokModel");
		$this->view_data["stoklar"] = $this->stokModel->getAll();

		
	}

	public function index(){

		return $this->view('template1/pages/user/dashboard',$this->view_data);
	}

	

}