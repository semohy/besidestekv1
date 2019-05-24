<?php
error_reporting(0);
require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require  'App/Helpers/Datatable.php';

require 'App/Helpers/ClearInputs.php';

class AjaxSatinAlimController extends BaseController
{
	public $view_data = array();

	private $user_id;

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;

		$auth->user();
		$this->user_id = $auth->user_id;
		

	}

	public function index(){

		$post = $_POST;
		
		$dt_Data = [
			"select" => "stok_kodu,adi,miktar,birim,birim_alis_fiyat,birim_satis_fiyat,alis_satis_birim,stok_takip,kritik_stok_miktar,updated_at",
			"from" => "stoklar",
		    "relations" => '',
			"where" => "user_id = ".$this->user_id,
			"searchColumns" => ["adi"],
			"printColumns" => ["stok_kodu","adi","miktar","birim","birim_alis_fiyat","birim_satis_fiyat","alis_satis_birim","stok_takip","kritik_stok_miktar","updated_at"]
		];

		$datatable = new Datatable($post,$dt_Data);
		$gelen = $datatable->make();

		foreach ($gelen["data"] as $key => $value) {
			$item_id = $gelen["data"][$key]["stok_kodu"];
		    $form = '
		    	<button data-toggle="modal" data-type1="itemDelete" data-itemId="'.$item_id.'" data-target="#userModal" class=" btn btn-danger" role="button" aria-pressed="true">Sil</button>
				<button  data-toggle="modal" data-type1="itemEdit" data-itemId="'.$item_id.'" data-target="#userModal" class=" btn btn-primary" role="button" aria-pressed="true">Düzenle</button>
		    ';

			$gelen["data"][$key]["actions"] = $form;

			$stok_takip = $gelen["data"][$key]["stok_takip"];

			if ($stok_takip) {
				$gelen["data"][$key]["stok_takip"]= '
					<div class="custom-control custom-checkbox">
  						<input type="checkbox" class="custom-control-input" id="customCheck1" checked disabled >
  						<label class="custom-control-label" for="customCheck1"></label>
					</div>';
			}
		}

		echo json_encode($gelen);
	}

	public function getStok(){

		$post = $_POST;

		$stok_model = $this->model('user/StokModel');

		$urun = $stok_model->get(["stok_kodu" => $post["stok_kodu"]]);

		if (count($urun->stok_kodu) > 0) {
			echo json_encode(['urun' => $urun,"status" => 200]);
		}else{
			echo json_encode(["status" => 400]);
		}
		
	}

	

}