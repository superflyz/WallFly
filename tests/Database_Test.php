<?php

require_once('../classes/Database.php');

class Database_Test extends PHPUnit_Framework_TestCase {

  public function testConnectionOk()
  {
    $db = Database::getInstance();
    $this->assertNotEmpty($db);
  }

  public function testOnePlusOne() {
		$this->assertEquals(1+1,3);
  	}


}