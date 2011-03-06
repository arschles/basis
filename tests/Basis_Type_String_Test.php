<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_String_Test extends PHPUnit_Framework_TestCase
{
	/**
	* @dataProvider dataProvider
	*/
	public function testBasicSetGet($s)
	{
		$d = new Basis_Type_String();
		$d->set($s);
		$this->assertEquals($s, $d->get());
		
		$d->set($s . "s");
		$this->assertEquals($s."s", $d->get());
	}
	
	public function dataProvider()
	{
		return array(
			array("a string"),
			array("asda"."asdas"),
		);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($s)
	{
		$d = new Basis_Type_String();
		$d->set($s);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array(1),
			array(array(1, 2, 3)),
			array(new stdClass),
			array(array("1"=>1, "two"=>2)),
		);
	}
}