<?php
/**
* 
*/
class SessionErrorHandler
{
	public $errors = array(
		"errors" => array(),
	);

	public $success = array(
		"success" => "",
	);
	
	public function __construct()
	{
		
		session_start();


		$this->make();

	}

	private function make(){

		if(isset($_SESSION['errors'])){
			
			if (isset($_SESSION['errors']['validation'])) {
				$this->errors["returned_Inputs_message"] = $_SESSION['errors']['validation'];
				$this->errors['returned_Inputs'] = array_keys($_SESSION['errors']['validation']);
			}
			array_push($this->errors["errors"], $_SESSION["errors"]);
			$_SESSION['errors'] = null;
		}

		if(isset($_SESSION['success'])){
			$this->success = $_SESSION["success"];
			$_SESSION["success"] = null;
			
		}
	}

}