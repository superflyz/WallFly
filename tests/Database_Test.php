<?php

require_once('../classes/Database.php');

class Database_Test extends PHPUnit_Framework_TestCase {

  // Test if database object is instantiated
  public function testConnectionOk()
  {
    $db = Database::getInstance();
    $this->assertNotEmpty($db);
  }
  
}