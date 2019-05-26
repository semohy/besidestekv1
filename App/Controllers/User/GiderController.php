<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class GiderController extends BaseController
{
	public $view_data = array();

	protected $giderKategoriModel;
	protected $stokModel;

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		
		$this->giderKategoriModel = $this->model("user/GiderKategoriModel");

		$this->view_data["gider_kategori"] = $this->giderKategoriModel->getAll();
		
	}

	public function index(){
		
		return $this->view('template1/pages/user/gider',$this->view_data);
	}

	public function store(){
		
		$posts = $_POST;
		
		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		//yoksa yeni gider kategori...
		$giderKategori_id = $this->giderKategoriModel->get(["id" => $posts["giderKategori_id"]]);
		$giderKategori_name = $this->giderKategoriModel->get(["name" => $posts["giderKategori_id"]]);
		
		if( !isset($giderKategori_id->id) && !isset($giderKategori_name->id) ){
			
			$eklenen_kategori = $this->giderKategoriModel->save($posts["giderKategori_id"]);
			$posts["giderKategori_id"] = $eklenen_kategori;
		}

		$posts["toplam_fiyat"] = $posts["birim_alis_fiyat"] * $posts["miktar"];
		
		$save = $this->model("user/GiderModel")->save($posts);

		if($save){
			$_SESSION["success"] = "Kayıt Başarılı";
			header('location: gider');
			exit();
		}

	}

	public function destroy(){
		
	}
	

}