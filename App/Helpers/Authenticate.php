<?php
/**
* 
*/
class Authenticate
{	
	public $auth = False;
	public $user_id;

	public function __construct()
	{
		//session_start();
	}

	public function isLogin()
	{
		if( isset( $_SESSION['AUTHENTİCATE']["user_id"] )  ){

			$this->auth = True;
			$this->user_id = $_SESSION['AUTHENTİCATE']["user_id"];
			return true;
		}else{

			$this->user_id = false;
			header('location: login');
			exit();
		}
	}


	//login eder...
	public function Auth($posts = array(), $model)
	{	
		$ar =[
			"email" => $posts["email"],
		];

		$user = $model->getUser($ar);

		//var_dump(password_verify($posts["password"],$user->password));exit();
		if ( password_verify($posts["password"],$user->password) ) {
			$_SESSION['AUTHENTİCATE']["user_id"] = $user->id;
			$_SESSION['AUTHENTİCATE']["name"] = $user->name;
			$_SESSION['AUTHENTİCATE']["role"] = $model->getRoleById($user->role_id)->name;
			$_SESSION['AUTHENTİCATE']["email"] = $user->email;
		}

	}

	
}