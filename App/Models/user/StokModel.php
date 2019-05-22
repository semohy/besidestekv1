<?php 

/**
* Register Model...
*/


class StokModel extends BaseModel
{	
	protected $timestamp ;
	protected $Auth ;

	public $table='stoklar';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d');

	}

	public  function save($posts){
		$sql = 'INSERT INTO '.$this->table.' (adi,miktar,birim,birim_alis_fiyat,birim_satis_fiyat,stok_takip,kritik_stok_miktar,updated_at,user_id) VALUES (:adi,:miktar,:birim,:birim_alis_fiyat,:birim_satis_fiyat,:stok_takip,:kritik_stok_miktar,:updated_at,:user_id)'; 
		$q = $this->db->prepare($sql);

		$bind_array = [];
		
		foreach ($posts as $key => $value) {
			if ($value == null) {
				$bind_array[":".$key] = null;
			}else{
				$bind_array[":".$key] = $value;
			}
		}

		$bind_array["user_id"] = $this->Auth->user_id;
		$bind_array["updated_at"] = $this->timestamp;

		try {
			
			if ($q->execute($bind_array)) {
					return true;
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

	public function getAll(){

		$sql  = 'SELECT * FROM '.$this->table.' WHERE '.$this->table.'.user_id = '.$this->Auth->user_id;
		$q = $this->db->prepare($sql);
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);
	}



}