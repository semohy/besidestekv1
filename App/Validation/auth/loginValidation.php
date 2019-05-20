<?php 

require 'App/Validation/BaseValidation.php';

class loginValidation extends BaseValidation
{
	protected $rules = array();

	public function __construct($posts = array())
	{	
		
		parent::__construct($posts);

		$rules = [
			
		];

		$field_name = [
			
		];

		$errors = $this->make($posts,$rules,$field_name);
		
		if (  $errors != null && count($errors) > 0 ) {
			$_SESSION["errors"]["validation"] = $errors;
			header('location: login');
			exit();
		}

	
	}

	
}