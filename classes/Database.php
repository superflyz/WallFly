<?php

require_once('../config/db.php');


// Singleton design pattern
class Database {

  private static $db;

  public static function getInstance() {
    // if we haven't instantiate any db, instantiate one
  	try{

  		if (self::$db === NULL) {
      self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    return self::$db;

  	}
  	catch(PDOException $e) {
    	echo $e->getMessage();
		}
    
  	}

}