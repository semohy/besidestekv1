<?php 

/**
* Register Model...
*/


class SatinAlimModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='satin_alinanlar';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d');

	}

	public  function save($posts){
		
		$fields1  = array_keys($posts);
		$fields = implode(', ', $fields1);
		$fields_bind = implode(',:', $fields1);

		$sql = 'INSERT INTO '.$this->table.' ('.$fields.',user_id,tarih) VALUES (:'.$fields_bind.', :user_id, :tarih)'; 

		$q = $this->db->prepare($sql);

		$bind_array = [];
		
		foreach ($posts as $key => $value) {
			if ($value == null) {
				$bind_array[":".$key] = null;
			}else{
				$bind_array[":".$key] = $value;
			}
		}

		$bind_array[":user_id"] = $this->Auth->user_id;
		$bind_array[":tarih"] = $this->timestamp;

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