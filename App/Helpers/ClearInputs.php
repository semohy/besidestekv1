<?php
/**
* 
*/
class ClearInputs
{
	public $clearData = array();
	
	public function __construct($posts = array())
	{
		$this->make($posts);
	}

	private function make($posts = array()){

		foreach ($posts as $k => $v) 
		{
			$posts[$k] = htmlspecialchars(trim($v));
		}
		return $this->clearData = $posts;
	}
}