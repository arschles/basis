<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Unsigned_Float_Test extends PHPUnit_Framework_TestCase
{
	public function testBasicSetGet()
	{
	    $val = 1.2;
		$d = new Basis_Type_Unsigned_Float();
		$d->set($val);
		
		$this->assertEquals($d->get(), $val);
		
		$val2 = 44.5;
		$d->set($val2);
		$this->assertEquals($d->get(), $val2);
	}
		
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($val)
	{
		$d = new Basis_Type_Unsigned_Float();
		$d->set($val);
	}
	
	public function invalidDataProvider()
	{
		return array(
		    array("sasda"),
		    array(100),
		    array(new stdClass),
		    array(-1.223),
		    array(-100),
		    array(0x234234),
		);
	}
}