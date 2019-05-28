<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class YemRasyoController extends BaseController
{
	public $view_data = array();

	
	protected $stokModel;

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		
		$this->stokModel = $this->model("user/YemRasyoModel");

		$this->view_data["gelir_kategori"] = $this->gelirKategoriModel->getAll();
		
	}

	public function index(){
		
		return $this->view('template1/pages/user/gelir',$this->view_data);
	}

	public function store(){
		
		$posts = $_POST;
		
		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		//yoksa yeni gider kategori...
		$gelirKategori_id = $this->gelirKategoriModel->get(["id" => $posts["gelirKategori_id"]]);
		$gelirKategori_name = $this->gelirKategoriModel->get(["adi" => $posts["gelirKategori_id"]]);
		
		if( !isset($gelirKategori_id->id) && !isset($gelirKategori_name->id) ){
			
			$eklenen_kategori = $this->gelirKategoriModel->save($posts["gelirKategori_id"]);
			$posts["gelirKategori_id"] = $eklenen_kategori;
		}

		$posts["toplam_fiyat"] = $posts["birim_satis_fiyat"] * $posts["miktar"];
		
		$save = $this->model("user/GelirModel")->save($posts);

		if($save){
			$_SESSION["success"] = "Kayıt Başarılı";
			header('location: gelir');
			exit();
		}

	}

	public function destroy(){
		
	}
	

}