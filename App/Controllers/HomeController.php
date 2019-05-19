<?php 

class HomeController extends BaseController
{

	public function index(){
		return $this->view('template1/index');
	}

	
}