<?php 

/**
* Register Model...
*/


class SatimModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='satislar';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d');

	}

	public  function save($posts){

		$bind_array = [];
		$fields1  = array_keys($posts);

		if(!in_array("tarih", array_keys($posts))){
			array_push($fields1, "tarih");
			$bind_array[":tarih"] = $this->timestamp;
		}
		
		$fields = implode(', ', $fields1);
		$fields_bind = implode(',:', $fields1);

		$sql = 'INSERT INTO '.$this->table.' ('.$fields.',user_id) VALUES (:'.$fields_bind.', :user_id)'; 

		$q = $this->db->prepare($sql);

		
		
		foreach ($posts as $key => $value) {
			if ($value == null) {
				$bind_array[":".$key] = null;
			}else{
				$bind_array[":".$key] = $value;
			}
		}

		$bind_array[":user_id"] = $this->Auth->user_id;
		
		try {
			
			if ($q->execute($bind_array)) {
					return $this->db->lastInsertId();
				}	
		} catch (Exception $e) {
			var_dump($e);exit();
		}
		
	}

	public function destroy($posts){
		$sql = 'DELETE FROM '.$this->table.' WHERE stok_kodu = :id AND user_id = :user_id';
		$q = $this->db->prepare($sql);
		$bind_array = [
			":id"     => $posts['id'],
			":user_id" => $this->Auth->user_id
		];

		try {
			
			if ($q->execute($bind_array)) {
					return true;
				}	
		} catch (Exception $e) {
			var_dump($e);exit();
		}
	}



}