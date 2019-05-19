<?php 
/**
* 
*/
class RoleModel extends BaseModel
{
	public $table = "roles";

	public function getRoleByName($name)
	{
		
		$sql = 'SELECT * FROM '.$this->table.' WHERE name="'.$name.'"';

		$q = $this->db->query($sql)->fetchObject('RoleModel');
		return $q;
	}
}