<?php
/**
* 
*/
class SessionErrorHandler
{
	public $errors = array();
	
	public function __construct()
	{
		
		session_start();

		$this->make();

	}

	private function make($posts = array()){

		if(isset($_SESSION['errors'])){
			
			if (isset($_SESSION['errors']['validation'])) {
				$this->errors["returned_Inputs_message"] = $_SESSION['errors']['validation'];
				$this->errors['returned_Inputs'] = array_keys($_SESSION['errors']['validation']);
			}
			array_push($this->errors, $_SESSION["errors"]);
			$_SESSION['errors'] = null;
		}
	}

}