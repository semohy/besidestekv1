<?php

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require  'App/Helpers/Datatable.php';

require 'App/Helpers/ClearInputs.php';

class AjaxKategoriController extends BaseController
{
	public $view_data = array();

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;
		

	}

	public function index(){

		$post = $_POST;
		
		$dt_Data = [
			"select" => "users.id as user_id, users.name as user_name, users.email as user_email, roles.name as role_name",
			"from" => "users",
		    "relations" => '
		     	inner join roles on users.role_id = roles.id
		    ',
			"where" => "role_id = 2",
			"searchColumns" => ["users.name","users.email","roles.name"],
			"printColumns" => ["user_id","user_name","user_email","role_name"]
		];

		$datatable = new Datatable($post,$dt_Data);
		$gelen = $datatable->make();

		foreach ($gelen["data"] as $key => $value) {
			$item_id = $gelen["data"][$key]["user_id"];
		    $form = '
		    	<button data-toggle="modal" data-type1="itemDelete" data-itemId="'.$item_id.'" data-target="#userModal" class="openModal_button btn btn-danger" role="button" aria-pressed="true">Sil</button>
				<button  data-toggle="modal" data-type1="itemEdit" data-itemId="'.$item_id.'" data-target="#userModal" class="openModal_button btn btn-primary" role="button" aria-pressed="true">Düzenle</button>
		    ';

			$gelen["data"][$key]["actions"] = $form;
			unset($gelen["data"][$key]["user_id"]);
		}

		

		echo json_encode($gelen);


		
	}

	

}