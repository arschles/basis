<?php

require_once 'PHPUnit/Framework.php';
require_once(dirname(__FILE__).'/../Mongo_Object_Environment.php');

class Mongo_Object_Path_Test extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
    	$expected = array('pathelt1', 'pathelt2');
    	$path = new Mongo_Object_Path($expected);
    	$this->assertEquals($path->get(), $expected);
    }
}
