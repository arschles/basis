<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Timestamp_Test extends PHPUnit_Framework_TestCase
{
	public function testBasicSetGet()
	{
	    $tsval = microtime(true);
	    $ts1 = new Basis_Type_Timestamp($tsval);
	    $this->assertEquals($ts1->get(), $tsval);
	    
	    $ts2 = new Basis_Type_Timestamp();
	    $this->assertTrue($ts2->get() <= microtime(true));
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($v)
	{
		$d = new Basis_Type_Timestamp($v);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array("sasda"),
			array((int)1),
			array((float)-100.00),
			array(new stdClass())
		);
	}
}