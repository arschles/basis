<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_List_Test extends PHPUnit_Framework_TestCase
{
	public function testBasicSetGet()
	{
	    $val1 = array(1, 2, 3);
	    $val2 = array("x", "y", "z");
	    
		$l1 = new Basis_Type_List();
		$l1->set($val1);
		$this->assertEquals($l1->get(), $val1);
		
		$l1->set($val2);
		$this->assertEquals($l1->get(), $val2);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($lst)
	{
		$d = new Basis_Type_List();
		$d->set($lst);
	}
		
	public function invalidDataProvider()
	{
		return array(
		    array(new stdClass),
		    array(array("one"=>"one", 2=>2)),
		    array(1),
		    array("string"),
		);
	}
	
	public function testAppend()
	{
	    $val1 = array(1, 2, 3);
	    $l1 = new Basis_Type_List();
	    $l1->set($val1);
	    $l1->append(4);
	    $this->assertEquals($l1->get(), array(1, 2, 3, 4));
	}	
}