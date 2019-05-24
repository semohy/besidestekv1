<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require 'App/Helpers/ClearInputs.php';

class SatinAlimController extends BaseController
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
		$this->stokModel = $this->model("user/StokModel");

		$this->view_data["gider_kategori"] = $this->giderKategoriModel->getAll();
		$this->view_data["stoklar"] = $this->stokModel->getAll();
		
	}

	public function index(){
		
		return $this->view('template1/pages/user/satinalim',$this->view_data);
	}

	public function store(){
		
		$posts = $_POST;

		//temzilik vakti...
		$posts = new ClearInputs($posts);
		$posts = $posts->clearData;

		//yoksa yeni kategori...
		if( is_string($posts["gider_kategori"]) ){
			$posts["gider_kategori"] = $this->giderKategoriModel->save($posts["gider_kategori"]);
		}

		//toplam fiyat için...
		if ($posts["birim"] == $posts["alis_satis_birim"]) {
			$posts["toplam_fiyat"] = $posts["birim_alis_fiyat"] * $posts["miktar"];
		}

		//yoksa yeni stok girişi...
		if( is_string($posts["adi"]) ){
			$stok_data = [
				"adi" => $posts["adi"],
			  	'miktar' => $posts["miktar"],
			  	'birim' => $posts["birim"],
			  	'birim_alis_fiyat' => $posts["birim_alis_fiyat"],
			  	'birim_satis_fiyat' => $posts["birim_satis_fiyat"],
			  	'alis_satis_birim' => $posts["alis_satis_birim"],
			  	'stok_takip' => isset($posts["stok_takip"]) ? "1" :  "0"  ,
			  	'kritik_stok_miktar' => $posts["kritik_stok_miktar"],
			];
			$posts["stok_kodu"] = $this->stokModel->save($stok_data);
		}else{
			//stogu güncelle...
			$posts["stok_kodu"] = $posts["adi"];

			$ilgili_urun = $this->stokModel->get(["stok_kodu" => $posts["stok_kodu"]]);

			$set_data = [
				"miktar" => $ilgili_urun->miktar + $posts["miktar"],
				"birim_alis_fiyat" => $posts["birim_alis_fiyat"],
				"birim_satis_fiyat" => $posts["birim_satis_fiyat"],
			];

			$where_data = ["stok_kodu" => $ilgili_urun->stok_kodu];

			$this->stokModel->update($set_data,$where_data);
		}

		$satinalim_data = [
			"gider_kategorisi" => $posts["gider_kategori"],
			"stok_kodu" => $posts["stok_kodu"],
			"miktar" => $posts["miktar"],
			"toplam_fiyat" => $posts["toplam_fiyat"],
		];

		$save = $this->model("user/SatinAlimModel")->save($satinalim_data);

		if($save){
			$_SESSION["success"] = "Kayıt Başarılı";
			header('location: satinalim');
			exit();
		}

	}

	public function destroy(){
		
	}
	

}