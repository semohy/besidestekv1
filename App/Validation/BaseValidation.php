<?php 

/**
* Base Validation class for validations...
*/
//require 'App/Database.php';

class BaseValidation extends Database
{
	protected $posts;
	protected $validation_errors = [];

	private $messages = array(
		'min'      => "enaz :min karakter olmalıdır.",
		"confirm"  => ":key1 ile :key2 aynı olmalıdır.",
		'required' => " alanı gereklidir.",
		'unique'   => "daha önce kaydedilmiş"
	);

	public function __construct($posts)
	{	
		parent::__construct();
		$this->posts = $posts;
		return $this->validation_errors;	
	}

	private function unique($key,$param){	
		$param = explode('-', $param);
		$table = $param[0];
		$field = $param[1];

		$sql = 'SELECT '.$field.' FROM '.$table.' WHERE '.$field.' = :'.$field;
		$q = $this->db->prepare($sql);
		$q->execute( [':'.$field => $this->posts[$key]] );
		if($q->rowCount() > 0){
			//error
			$this->validation_errors[$key]["min"] = "#".$key." ".$this->posts[$key]." ".$this->messages["unique"];
		}
		
	}

	private function min($key,$min){
		
		if ( strlen($this->posts[$key]) < $min) {
			$this->validation_errors[$key]["min"] = "#".$key." ".$this->messages["min"];
			$this->validation_errors[$key]["min"] = str_replace(' :min ', ' '.$min.' ', $this->validation_errors[$key]["min"]); 
		}
	}

	private function confirm($key,$key2){
		if($this->posts[$key] != $this->posts[$key2]){
			$this->validation_errors[$key]['confirm'] = str_replace(':key1 ', "#".$key.' ', $this->messages["confirm"]);
			$this->validation_errors[$key]['confirm'] = str_replace(' :key2 ', " #".$key2.' ', $this->validation_errors[$key]['confirm'] );
		}
	}

	private function required($key){
		if (empty($this->posts[$key]) || !$this->posts[$key]) {
			$this->validation_errors[$key]["required"] = "#".$key." ".$this->messages["required"];
		}
	}

	private function string($key){
		if (is_string($this->posts[$key])) {
			$this->validation_errors[$key]["string"] = false;
		}
	}

	private function integer($key){
		if(is_int($this->posts[$key])){
			$this->validation_errors[$key]["integer"] = false;
		}
	}

	private function float($key){
		if(is_float($this->posts[$key])){
			$this->validation_errors[$key]["float"] = false;
		}
	}







	protected function make($posts,$rules,$field_names){
		
		foreach ($rules as $ruleKey => $ruleValue) {
			$ruleValue = explode('|', $ruleValue);
			foreach ($ruleValue as $v) {
				$v = explode(':', $v);
				$func_name = $v[0];
				$this->$func_name($ruleKey,$v[1]);
			}	
		}
		
		if (count($this->validation_errors) > 0) {
			$this->remake_errors($field_names);
			return $this->validation_errors;
		}
	}

	private function remake_errors($field_names){
		
		$new_field_names = array();
		foreach ($field_names as $key => $value) {
			$new_field_names['#'.$key] = $value;  
		}

		foreach ($this->validation_errors as $key => $value) {
			foreach ($value as  $k=> $v) {
				preg_match_all('/#\w+/',$v,$matches);
				if( count($matches) > 0 ){
					foreach ($matches as  $matches) {
						foreach ($matches as $m) {
							$this->validation_errors[$key][$k] = str_replace($m." ", " ".$new_field_names[$m]." ", $this->validation_errors[$key][$k] );
						}
					}
				}
			}
		}
	}

}