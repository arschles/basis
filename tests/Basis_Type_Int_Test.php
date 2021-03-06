<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Int_Test extends PHPUnit_Framework_TestCase
{
	/**
	* @dataProvider dataProvider
	*/
	public function testBasicIncDec($i)
	{
		$i1 = new Basis_Type_Int();
		$i1->set($i);
		$this->assertEquals($i1->increment(), $i + 1);
		$this->assertEquals($i1->decrement(), $i);
	}
	
	public function dataProvider()
	{
		return array(
			array(-1),
			array(0),
			array(1)
		);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($i)
	{
		$in = new Basis_Type_Int();
		$in->set($i);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array(0.1),
			array("asdas"),
			array(new stdClass())
		);
	}
}