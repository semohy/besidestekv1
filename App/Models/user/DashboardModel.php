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

	public function stoklogs($stok_kodu,$min_tarih)
	{

		$sql = 'SELECT stoklar.adi as adi,min(stok_log.miktar) as miktar, stok_log.updated_at as time   from stok_log 
					inner join stoklar on stok_log.stok_kodu = stoklar.stok_kodu 
				WHERE stok_log.updated_at > "'.$min_tarih.'" and stok_log.stok_kodu = '.$stok_kodu.' and stok_log.user_id = '.$this->Auth->user_id.' GROUP by  stok_log.updated_at order by stok_log.updated_at asc';
			
		$q = $this->db->prepare($sql);
		
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);

	}

	public function gelirgider($min_tarih)
	{

		$sql = 'SELECT CAST(SUM('.$this->table_gelir.'.toplam) as unsigned) as gelir, CAST(SUM('.$this->table_gider.'.toplam) as unsigned) as gider FROM '.$this->table_gelir.','.$this->table_gider.' WHERE ( view_gelirler.tarih > "'.$min_tarih.'"  and view_giderler.tarih > "'.$min_tarih.'" ) AND (view_gelirler.user_id = '.$this->Auth->user_id.'  and view_giderler.user_id = '.$this->Auth->user_id.')';
			
		$q = $this->db->prepare($sql);
		
		$q->execute();
		return $q->fetch(PDO::FETCH_OBJ);

	}

	public function gelirler($min_tarih)
	{
		$joins = " INNER JOIN gelir_kategori on gelir_kategori.id = view_gelirler.kategori ";
		$sql = 'SELECT CAST(SUM('.$this->table_gelir.'.toplam) as unsigned) as toplam, gelir_kategori.adi as kategori FROM '.$this->table_gelir.' '.$joins.' WHERE view_gelirler.tarih > "'.$min_tarih.'"  AND view_gelirler.user_id = '.$this->Auth->user_id.' group by '.$this->table_gelir.'.kategori';
		
		$q = $this->db->prepare($sql);
		
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);

	}

	public function giderler($min_tarih)
	{
		$joins = " INNER JOIN gider_kategori on gider_kategori.id = view_giderler.kategori ";
		$sql = 'SELECT CAST(SUM(view_giderler.toplam) as unsigned) as toplam, gider_kategori.name as kategori FROM view_giderler  '.$joins.' WHERE view_giderler.tarih > "'.$min_tarih.'"  AND view_giderler.user_id = '.$this->Auth->user_id.' group by view_giderler.kategori';
		
		$q = $this->db->prepare($sql);
		
		$q->execute();
		return $q->fetchAll(PDO::FETCH_OBJ);

	}

	public function gelirGiderDate($min_tarih)
	{
		$sql1 = 'SELECT sum(view_gelirler.toplam) as gelir, CONCAT(EXTRACT(YEAR FROM view_gelirler.tarih),"-",EXTRACT(MONTH FROM view_gelirler.tarih)) as ay  FROM view_gelirler WHERE
		 view_gelirler.tarih > "'.$min_tarih.'" and view_gelirler.user_id = '.$this->Auth->user_id.' Group By ay order by ay asc';

		$q_gelir = $this->db->prepare($sql1);
		$q_gelir->execute();
		
		$gelir = $q_gelir->fetchAll(PDO::FETCH_OBJ);

		$sql2 = 'SELECT sum(view_giderler.toplam) as gider, CONCAT(EXTRACT(YEAR FROM view_giderler.tarih),"-",EXTRACT(MONTH FROM view_giderler.tarih)) as ay  FROM view_giderler WHERE
		 view_giderler.tarih > "'.$min_tarih.'" and view_giderler.user_id = '.$this->Auth->user_id.' Group By ay order by ay asc';

		$q_gider = $this->db->prepare($sql2);
		$q_gider->execute();

		$gider = $q_gider->fetchAll(PDO::FETCH_OBJ);

		return [$gider,$gelir];

	}


}