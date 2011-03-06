<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Typed_Dict_Test extends PHPUnit_Framework_TestCase
{
	/**
	* @dataProvider dataProvider
	*/
	public function testBasicSetGet($type, array $dict)
	{
		$d = new Basis_Type_Typed_Dict($type);
		$d->set($dict);
		
		$this->assertEquals($d->get(), $dict);
		
		$keys = array_keys($dict);
		$key = $keys[0];
		$val = $dict[$key];
		$dict[$key] = $val;
		$d->setValueForKey($key, $val);
		
		$this->assertEquals($d->get(), $dict);
	}
	
	public function dataProvider()
	{
		return array(
			array("int", array("one"=>1, "two"=>2)),
			array("stdClass", array("ex"=>new stdClass())),
			array("string", array("one"=>"one", "two"=>"two")),
			array("float", array("one"=>(float)1.0, "two"=>(float)2.0)),
		);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($type, $dict)
	{
		$d = new Basis_Type_Typed_Dict($type);
		$d->set($dict);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array("int", array(1)),
			array("float", array("one"=>"one", "two"=>(int)2)),
			array("string", array("one"=>1, "two"=>"two")),
			array("Exception", array("ex"=>1, "ex1"=>new stdClass))
		);
	}
}