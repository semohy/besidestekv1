<?php

require  'App/Validation/auth/registerValidation.php';

class RegisterController extends BaseController
{
	
	function __construct()
	{
		# check login session if true redirect dashboard...
	}

	public function index(){
		return $this->view('template1/pages/auth/register');
	}

	public function store(){
		new registerValidation($_POST);
		//return $this->view('template1/pages/auth/register');
	}


}