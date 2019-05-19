<?php 

/**
* Base Validation class for validations...
*/
class BaseValidation 
{
	protected $posts;
	public $validation_errors =[]

	public function __construct($posts)
	{
		$this->posts = $posts;	
	}

	public function min($key,$min){
		
		if ( strlen($this->posts[$key]) < $min) {
			$validation_errors[$key] = $key.' '.$min.' den kısa olamaz!'; 
		}
	}

	public function confirm($key,$min){
		echo "dsadsdconfirm";
	}

}