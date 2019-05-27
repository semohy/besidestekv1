<?php 

/**
* Register Model...
*/


class GelirKategoriModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='gelir_kategori';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d H:i:s');

	}

	public  function save($posts){
		$sql = 'INSERT INTO '.$this->table.' (adi,user_id) VALUES (:adi,:user_id)'; 
		$q = $this->db->prepare($sql);
		$bind_array = [
						
						":adi" => $posts,
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

	public function get($where_data){
		
		$bind_array = [];
		
		$fields = "";
		foreach ($where_data as $key => $value) {
			$fields .= $this->table.'.'.$key.' = :'.$key." And ";
			$bind_array[":".$key] = $value;
		}

		$sql  = 'SELECT * FROM '.$this->table.' WHERE '.$fields.' '.$this->table.'.user_id = :user_id';
		$q = $this->db->prepare($sql);

		$bind_array[":user_id"] = $this->Auth->user_id;
		$q->execute($bind_array);
		return $q->fetch(PDO::FETCH_OBJ);
	}



}