<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require  'App/Helpers/Datatable.php';

require 'App/Helpers/ClearInputs.php';

class AjaxKategoriController extends BaseController
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
			"select" => "kategori_id,ust_kategori_id,kategori_adi",
			"from" => "kategoriler",
		    "relations" => '',
			"where" => "user_id = ".$this->user_id,
			"searchColumns" => ["kategori_id","ust_kategori_id","kategori_adi"],
			"printColumns" => ["kategori_id","ust_kategori_id","kategori_adi",]
		];

		$datatable = new Datatable($post,$dt_Data);
		$gelen = $datatable->make();

		foreach ($gelen["data"] as $key => $value) {
			$item_id = $gelen["data"][$key]["kategori_id"];
		    $form = '
		    	<button data-toggle="modal" data-type1="itemDelete" data-itemId="'.$item_id.'" data-target="#userModal" class="openModal_button btn btn-danger" role="button" aria-pressed="true">Sil</button>
				<button  data-toggle="modal" data-type1="itemEdit" data-itemId="'.$item_id.'" data-target="#userModal" class="openModal_button btn btn-primary" role="button" aria-pressed="true">Düzenle</button>
		    ';

			$gelen["data"][$key]["actions"] = $form;
			unset($gelen["data"][$key]["user_id"]);
		}

		echo json_encode($gelen);
	}

	public function all(){

		$model = $this->model('user/KategoriModel');
		$kategoriler = $model->getAll();

		echo json_encode(['add_data' => $kategoriler],200);
	}

	

}