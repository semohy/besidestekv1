<?php
/**
* 
*/
class Authenticate
{	
	public $auth = False;
	
	public $user_id;
	public $user_name;
	public $user_email;
	public $user_role;

	public function __construct()
	{

	}

	public function isLogin()
	{	
		$url = new Route();
		$url = explode('/', $url->parse_url());

		if( isset( $_SESSION['AUTHENTİCATE']["user_id"] )  ){

			$this->auth = True;
			$this->user_id = $_SESSION['AUTHENTİCATE']["user_id"];
			
			if( in_array('login', $url) || in_array('register', $url) ){

				header('location: dashboard');
				exit();
			}
			return true;

		}else{

			$this->user_id = false;

			if( !in_array('login', $url) && !in_array('register', $url) ){
				//url login değilse...
				header('location: login');
				exit();
			}
			
			return false;

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

			$this-user();
			
			return header('location: dashboard');
			exit();
		}else{
			
			$_SESSION['errors'] = "Kullanıcı adı veya Şifre Hatalı";
			return header('location: login');
			exit();
		}

	}

	public function user()
	{
			$this->user_name = $_SESSION['AUTHENTİCATE']["name"];
			$this->user_role = $_SESSION['AUTHENTİCATE']["role"];
			$this->user_email  = $_SESSION['AUTHENTİCATE']["email"];
	}

	
}