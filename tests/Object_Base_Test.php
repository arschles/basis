<?php

require_once 'PHPUnit/Framework.php';
require_once(dirname(__FILE__).'/../Mongo_Object_Environment.php');

class MockObject extends Mongo_Object_Base
{
	
}

class Mongo_Object_Base_Test extends PHPUnit_Framework_TestCase
{
	private $_arr;
	
	private $_mongoID;
	
	public function setUp()
	{
		$this->_mongoID = new MongoID();
		$this->_arr = array('_id'=>$this->_mongoID, 'one'=>'oneval', 'two'=>array('three'=>'four'));
	}
	
	private function constructObj()
	{
		$mock = new MockObject($this->_arr);
		return $mock;
	}
	
    public function testConstruct()
    {
    	$mock = $this->constructObj();
    	
    	$this->assertTrue($mock instanceof Mongo_Object_Base);
    }
    
    public function testGet()
    {
    	$mock = $this->constructObj();
    	$val = $mock->get(new Mongo_Object_Path(array('two', 'three')), false);
    	$this->assertEquals($val, 'four');
    	
    	$valNotFound = $mock->get(new Mongo_Object_Path(array('two', 'three', 'four', 'five')), false);
    	$this->assertFalse($valNotFound);
    }
    
    public function testSet()
    {
    	$mock = $this->constructObj();
    	$mock->set(new Mongo_Object_Path(array('a')), 'b');
		$this->assertEquals($mock->get(new Mongo_Object_Path(array('a'))), 'b');
		
		$mock->set(new Mongo_Object_Path(array('a', 'b')), 'c');
		$this->assertEquals($mock->get(new Mongo_Object_Path(array('a', 'b'))), 'c');
    	
    	//TODO
    }
    
    public function testGetID()
    {
    	$mock = $this->constructObj();
    	
    	$this->assertEquals($mock->getID(), $this->_mongoID);
    }
}
