<?php

require_once 'PHPUnit/Framework.php';
require_once(dirname(__FILE__).'/../Mongo_Object_Environment.php');

class Mongo_Object_Version_Number_Test extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
    	$ver = new Mongo_Object_Version_Number(1);
    	$this->assertTrue($ver instanceof Mongo_Object_Version_Number);
    }
    
    public function testComparisons()
    {
    	$ver1 = new Mongo_Object_Version_Number(1);
    	$ver2 = new Mongo_Object_Version_Number(2);
    	
    	$this->assertTrue($ver1->lessThan($ver2));
    	$this->assertTrue($ver2->greaterThan($ver1));
    	$this->assertTrue($ver1->equals($ver1));
    }
}
