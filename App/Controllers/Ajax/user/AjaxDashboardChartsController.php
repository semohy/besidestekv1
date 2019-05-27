<?php

error_reporting(0);

require  'App/Helpers/SessionErrorHandler.php';
require  'App/Helpers/Authenticate.php';

require  'App/Helpers/Datatable.php';

require 'App/Helpers/ClearInputs.php';

class AjaxDashboardChartsController extends BaseController
{
	public $view_data = array();

	private $user_id;

	protected $stokModel;
	protected $dashboardModel;

	public function __construct()
	{	
		
		$session_errors = new SessionErrorHandler();
		$this->view_data = $session_errors->errors;

		$auth =  new Authenticate();
		$auth->isLogin();
		$this->view_data["Auth"]  = $auth;

		$auth->user();
		$this->user_id = $auth->user_id;
		
		$this->stokModel = $this->model('user/StokModel');

		$this->dashboardModel = $this->model('user/DashboardModel');

	}

	public function stoklogs(){

		$lga_select = "stoklar.adi,min(stok_log.miktar) as miktar,stok_log.updated_at as time";
		$where = "stok_log.stok_kodu = ".$_POST["stok"]." and stok_log.updated_at > ".$_POST["updated_at"];
		$order = "Group by time order by time asc ";
		$stok_logs = $this->stokModel->getLogs($lga_select,$where,$order);

		$seriler = [];
		$x_label = [];
		foreach ($stok_logs as $r) {

			$p_data = ["name"=> $r->adi, "data" => array() ];

			if (!in_array( $r->adi, array_keys($seriler)) ){
			 	$seriler[$r->adi] = $p_data;
			 	array_push($seriler[$r->adi]["data"], $r->miktar);
			 }else{	
			 	array_push($seriler[$r->adi]["data"], $r->miktar);
			 }
			 //if (!in_array($r->time, $x_label)) {
			 	array_push($x_label, $r->time);
			 //}
		}

		$data = array(
				"seriler" => $seriler,
				"x" => $x_label
			);
		echo json_encode($data);//json_encode($chart_datas);
		
	}

	public function chartsgelirgider(){
			
		$result = $this->dashboardModel->gelirgider($_POST["tarih"]);
			
		$dataset = array();

		$dataset["seriler"] = [$result->gelir, $result->gider];
		$dataset["labels"] = ["Gelir","Gider"];

		echo json_encode($dataset);
	}

	

}