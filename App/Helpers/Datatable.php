<?php 

/**
* semohy datatable...
*/
class Datatable extends Database
{	

	private $data = [];
	private $veri;
	private $toplamFiltreVeri;

	protected $post;
	protected $table_name;

	protected $kolonlar = array();

	protected $select;
	protected $relations = "";
	protected $where = "";

	protected $printable_cols;
	
	public function __construct($post,$data)
	{
		parent::__construct();

		$this->table_name = $data["from"];
		$this->select = $data["select"];

		if( !empty($data["relations"]) )
		{
			$this->relations = $data["relations"]; //joinler
		}

		if(!empty($data["where"]) )
		{
			$this->where = $data["where"]; //joinler
		}

		$this->kolonlar = $data["searchColumns"];
		$this->printable_cols = $data["printColumns"];

		$this->post = $post;
		
		
		$this->prepare();
	}

	private function total_records(){
		$sql = 'SELECT count(*) as count, '.$this->select.' FROM '.$this->table_name.' '.$this->relations.' where '.$this->where;
		//echo $sql;exit();
		$total = $this->db->prepare($sql);
		$total->execute();
		return $total->fetchColumn(0);  
	}

	private function search_total_records($arama_kelime,$sql){
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
		$sql_last = 'SELECT count(*) as count, '.$this->select.' FROM '.$this->table_name.' '.$this->relations.' where '.$this->where." ".$sql;
		$toplam = $this->db->prepare($sql_last);
		$toplam->bindValue(':arama_kelime', "%" . $arama_kelime . "%");
		$toplam->execute(); 
		return $toplam->fetchColumn(0); 
	}

	public function prepare()
	{
		//$this->kolonlar = $this->getColumnNames();

		$arama_kelime = isset($this->post["search"]["value"]) ? $this->post["search"]["value"] : ''; 
		$siralama =  isset($this->post["order"]) ? $this->post["order"] : '';
		$length =  isset($this->post["length"]) ? $this->post["length"] :'' ; 
		$limit =  isset($this->post["start"]) ? $this->post["start"] :'' ; 

		$sql = "SELECT ".$this->select." FROM ".$this->table_name.' '.$this->relations.'  where '.$this->where;

		$this->toplamFiltreVeri = $this->total_records();

		if(!empty($arama_kelime))  // Eğer arama_kelime değişkeni boş değilse yani arama yapılmışsa
		{
			$arama_sql = " AND ( ";
			$arama_index = 0;
			foreach ($this->kolonlar as $kolon) { 
			
				if($arama_index == 0)
				{
					$arama_sql .= $kolon." LIKE :arama_kelime ";
				}else{
					$arama_sql .= "OR ".$kolon." LIKE :arama_kelime ";
				}
				$arama_index++;
			}
			$sql .= $arama_sql.' )';
			$this->toplamFiltreVeri = $this->search_total_records($arama_kelime,$arama_sql.' )'); 
		}

		if(!empty($siralama))  
		{
			
			$sql .= " ORDER BY ".$this->printable_cols[$siralama['0']['column']]." ".strtoupper($siralama['0']['dir'])." ";
		}else{
			// Eğer sıralama işlemi yapılmamışsa varsayılan olarak sıralama yap
			// $sql .= "ORDER BY icerik_id DESC ";
		}

		if($length != 1 && $limit != 0)
		{
			// Sayfalama işlemi
			$sql .= " LIMIT ".$limit.",".$length;
		}
		//echo $limit;exit();
		$this->veriler = $this->db->prepare($sql);
		
		if(!empty($arama_kelime))
		{
			// Eğer arama işlemi yapılmışsa değişkeni bindle
		$this->veriler->bindValue(':arama_kelime', '%' . $arama_kelime . '%');
		}
		$this->veriler->execute();


		foreach ($this->veriler->fetchAll(PDO::FETCH_OBJ) as $veri) {

			$veriDizi = []; 
			foreach ($this->printable_cols as $kolon) {
				// Veri değişkeni içerisinden dinamik olarak kolon değişkeni içerisindeki kolonu getir
				$veriDizi[$kolon] = $veri->$kolon;
			}
			$this->data[] = $veriDizi; // Her seferinde oluşan dizimizi data değişkenine depoluyoruz	
		}

	}

	public function make(){

			$output = array(
					"draw"    => intval($this->post["draw"]),
					"recordsTotal"  => $this->total_records(), // Toplam tablodaki veri sayımızı ekle
					"recordsFiltered" => $this->toplamFiltreVeri, // Toplam filtrelenmiş veri sayısını ekle
					"data"    => $this->data // Verileri depoladığımız değişkeni ekle
					);
				
				return $output;

				//echo json_encode($output);  // Json çıktısı ver
		
	}



}
