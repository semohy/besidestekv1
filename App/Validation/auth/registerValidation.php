<?php 

require 'App/Validation/BaseValidation.php';

class registerValidation
{
	protected $rules = array();

	public function __construct($posts = array())
	{	

		$rules = [
			'password' => 'min:6|confirm:password-confirmation'
		];

		$this->make($posts,$rules);
	}

	protected function make($posts,$rules){

		foreach ($rules as $ruleKey => $ruleValue) {

			$ruleValue = explode('|', $ruleValue);

			foreach ($ruleValue as $v) {
				$v = explode(':', $v);
				call_user_func_array([new BaseValidation($posts), $v[0]], [$ruleKey,$v[1] ] );
			}
			
		}
	}
}