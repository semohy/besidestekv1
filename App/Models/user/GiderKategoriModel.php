<?php 

/**
* Register Model...
*/


class GiderKategoriModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='gider_kategori';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d H:i:s');

	}

	public  function save($posts){
		$sql = 'INSERT INTO '.$this->table.' (name,user_id) VALUES (:name,:user_id)'; 
		$q = $this->db->prepare($sql);
		$bind_array = [
						
						":name" => $posts,
						":user_id" => $this->Auth->user_id,					
					  ];
	
			if ($q->execute($bind_array)) {
					return $this->db->lastInsertId();
				}else{
					return false;
				}
		
	}

	public function getAll(){

		$sql  = 'SELECT * FROM '.$this->table.' WHERE '.$this->table.'.user_id = '.$this->Auth->user_id;
		$q = $this->db->prepare($sql);
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);
	}



}