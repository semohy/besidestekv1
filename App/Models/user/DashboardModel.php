<?php 
/**
* 
*/
class DashboardModel extends BaseModel
{
	public $table_gelir = "view_gelirler";
	public $table_gider = "view_giderler";

	protected $Auth ;
	
	public function __construct()
	{	
		parent::__construct();

		$this->Auth = new Authenticate();
		$this->Auth->user();


		$this->timestamp = date('Y-m-d');

	}

	public function gelirgider($min_tarih)
	{

		$sql = 'SELECT CAST(SUM('.$this->table_gelir.'.toplam) as unsigned) as gelir, CAST(SUM('.$this->table_gider.'.toplam) as unsigned) as gider FROM '.$this->table_gelir.','.$this->table_gider.' WHERE ( view_gelirler.tarih > '.$min_tarih.'  and view_giderler.tarih > '.$min_tarih.' ) AND (view_gelirler.user_id = '.$this->Auth->user_id.'  and view_giderler.user_id = '.$this->Auth->user_id.')';
			
		$q = $this->db->prepare($sql);
		
		$q->execute();
		return $q->fetch(PDO::FETCH_OBJ);

	}


}