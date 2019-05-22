<?php 

/**
* Register Model...
*/


class KategoriModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='kategoriler';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d H:i:s');

	}

	public  function save($posts){
		$sql = 'INSERT INTO '.$this->table.' (kategori_adi,ust_kategori_id,user_id) VALUES (:adi,:ust_kod,:user_id)'; 
		$q = $this->db->prepare($sql);
		$bind_array = [
						
						":adi" => $posts["cat_name"],
						":ust_kod" => $posts["ust_cat"],
						":user_id" => $this->Auth->user_id,					
					  ];
		try {
			
			if ($q->execute($bind_array)) {
					return true;
				}	
		} catch (Exception $e) {
			var_dump($e);exit();
		}
		
	}

	public function getAll(){

		$sql  = 'SELECT * FROM '.$this->table.' WHERE '.$this->table.'.user_id = '.$this->Auth->user_id;
		$q = $this->db->prepare($sql);
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);
	}



}