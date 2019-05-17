<?php 

class HomeController extends BaseController
{

	public function index(){
		return $this->view('404');
	}

	public function deneme_post(){
		echo "denemepost";
	}
}