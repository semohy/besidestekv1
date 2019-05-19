<?php 

require 'App/Validation/BaseValidation.php';

class registerValidation extends BaseValidation
{
	protected $rules = array();

	public function __construct($posts = array())
	{	
		
		parent::__construct($posts);

		$rules = [
			'email' => 'unique:users-email',
			'password' => 'min:6|confirm:password_confirmation',
		];

		$field_name = [
			'password' 				=> "Parola",
			'password_confirmation' => 'Parola Tekrar',
		];

		$errors = $this->make($posts,$rules,$field_name);
		
		if (  $errors != null && count($errors) > 0 ) {
			$_SESSION["errors"]["validation"] = $errors;
			header('location: register');
			exit();
		}

	
	}

	
}