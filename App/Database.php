<?php

class Database

{

    public $db;

    public function __construct()

    {

        try {

        	$options = [
			  PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
			  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
			  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
			];

            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4', DB_USERNAME, DB_PASSWORD, $options);

        } catch (Exception $e) {
  error_log($e->getMessage());
  exit($e->getMessage());  
        }

    }


}