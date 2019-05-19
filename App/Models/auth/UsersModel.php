<?php 

require 'App/Models/RoleModel.php'; //relation roles
/**
* Register Model...
*/

class UsersModel extends BaseModel
{	
	protected $timestamp ;

	public $table='users';

	

	
	public function __construct()
	{	
		parent::__construct();

		$this->timestamp = date('Y-m-d H:i:s');

	}

	public  function insert($posts){
		$sql = 'INSERT INTO users (name,email,password,role_id,created_at,updated_at) VALUES (:name,:email,:password,:role_id,:created_at,:updated_at)'; 
		$q = $this->db->prepare($sql);

		
		$bind_array = [
						
						":name" => $posts["name"],
						":email" => $posts["email"],
						":password" => $posts["password"],
						":role_id" => $posts["role_id"],
						":created_at" => $this->timestamp,
						":updated_at" => $this->timestamp,						
					  ];

		

		try {
			
			if ($q->execute($bind_array)) {
					return true;
				}	
		} catch (Exception $e) {
			var_dump($e);exit();
		}
		
	}

	public function getRole($name){

		$role_model = new RoleModel();
		
		return $role_model->getRoleByName($name); 
	}


}