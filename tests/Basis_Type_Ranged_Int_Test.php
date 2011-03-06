<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Ranged_Int_Test extends PHPUnit_Framework_TestCase
{
    const MIN = -100;
    const MAX = 100;
    
	/**
	* @dataProvider dataProvider
	*/
	public function testBasicSetGet($val)
	{
		$d = new Basis_Type_Ranged_Int(self::MIN, self::MAX, $val);
		$this->assertEquals($d->get(), $val);
	}
	
	public function dataProvider()
	{
		return array(
		    //in bounds
			array(self::MIN + 1),
			//on bounds
			array(self::MIN),
			array(self::MAX)
		);
	}
	
	
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($val)
	{
		$d = new Basis_Type_Ranged_Int(self::MIN, self::MAX, $val);
	}
	
	public function invalidDataProvider()
	{
		return array(
			array(self::MIN-1),
			array(self::MAX+1),
			array(PHP_INT_MAX),
		);
	}
}