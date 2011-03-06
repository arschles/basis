<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Dict_Test extends PHPUnit_Framework_TestCase
{
	/**
	* @dataProvider dataProvider
	*/
	public function testBasicSetGet($k1, $v1, $k2, $v2)
	{
		$d = new Basis_Type_Dict();
		$d->setValueForKey($k1, $v1);
		$d->setValueForKey($k2, $v2);
		
		$this->assertEquals($d->getValueForKey($k1), $v1);
		$this->assertEquals($d->getValueForKey($k2), $v2);
		
		$this->assertEquals($d->get(), array($k1=>$v1, $k2=>$v2));
	}
	
	public function dataProvider()
	{
		return array(
			array("key1", "val1", "key2", "val2"),
			array("key1", 1, "key2", 2),
			array("key1", new stdClass, "key2", 123),
		);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($dict)
	{
		$d = new Basis_Type_Dict();
		$d->set($dict);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array(1),
			array(array(1=>"one")),
			array("this is a string")
		);
	}
}