<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class SatimController extends BaseController
{
	public $view_data = array();

	protected $gelirKategoriModel;
	protected $stokModel;

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		
		$this->gelirKategoriModel = $this->model("user/GelirKategoriModel");
		$this->stokModel = $this->model("user/StokModel");

		$this->view_data["gelir_kategori"] = $this->gelirKategoriModel->getAll();
		$this->view_data["stoklar"] = $this->stokModel->getAll();
		
	}

	public function index(){
		
		return $this->view('template1/pages/user/digerSatim',$this->view_data);
	}

	public function save(){
		
		$posts = $_POST;
		
		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		//yoksa yeni gider kategori...
		$gelirKategori_id = $this->gelirKategoriModel->get(["id" => $posts["gelir_kategori"]]);
		$gelirKategori_name = $this->gelirKategoriModel->get(["adi" => $posts["gelir_kategori"]]);
		
		if( !isset($gelirKategori_id->id) && !isset($gelirKategori_name->id) ){
			
			$eklenen_kategori = $this->gelirKategoriModel->save($posts["gelir_kategori"]);
			$posts["gelir_kategori"] = $eklenen_kategori;
		}

		$ilgili_urun = $this->stokModel->get(["stok_kodu" => $posts["stok_kodu"]]);
		//toplam fiyat için...
		$posts["toplam_fiyat"] = ($ilgili_urun->birim_satis_fiyat * $posts["miktar"])-$posts["iskonto"];
	
		//stogu güncelle...
		if (isset($posts["stok_dus"])) {

			
			$set_data = [
				"miktar" => $ilgili_urun->miktar - $posts["miktar"],	
			];
			$where_data = ["stok_kodu" => $ilgili_urun->stok_kodu];
			$this->stokModel->update($set_data,$where_data);
		}

		$satim_data = [
			"gelir_kategorisi" => $posts["gelir_kategori"],
			"stok_kodu" => $posts["stok_kodu"],
			"miktar" => $posts["miktar"],
			"toplam_fiyat" => $posts["toplam_fiyat"],
			"iskonto" => $posts["iskonto"],
		];

		if ( !isset($posts["stok_dus"])) {

			$satim_data["tarih"] = $posts["tarih"];
		}

		$save = $this->model("user/SatimModel")->save($satim_data);

		if($save){
			$_SESSION["success"] = "Kayıt Başarılı";
			header('location:'.APP_URL.'satim');
			exit();
		}

	}

	public function destroy(){
		
	}
	

}