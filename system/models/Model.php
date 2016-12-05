<?php

//Main Model

namespace system\models;

use \app\config\Config;


/**
* 
*/
class Model
{
	
	public function __construct()
	{
		$dbname = Config::DB_NAME;
		$dbuser = Config::DB_USER;
		$dbpass = Config::DB_PASS;
		$host = Config::DB_HOST;

		try {
            $this->db = new \PDO( "mysql:host=$host;dbname=$dbname" , $dbuser , $dbpass);
        }
        catch(PDOException $e) {
            die("Database Problem. Not connected.");
        }
	}

	public function pdoQuery($query) {
        try {
            $prepare = $this->db->prepare($query);
            return $prepare;
        }
        catch(PDOException $e) {
            return false;
        }
        
    } //pdo_query($query)
    
	
}