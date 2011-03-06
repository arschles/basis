<?php
require_once dirname(__FILE__).'/../Basis.php';

class Basis_Type_Typed_List_Test extends PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider dataProvider
    */
	public function testBasicSetGet($type, array $lst)
	{
		$l1 = new Basis_Type_Typed_List($type);
		$l1->set($lst);
		$this->assertEquals($l1->get(), $lst);
	}
	
	public function dataProvider()
	{
	    return array(
	        array("int", array(1, 2, 3)),
	        array("float", array(1.0, 2.0, 3.5)),
	        array("string", array("one", "two")),
	        array("stdClass", array(new stdClass(), new stdClass())),
	    );
	}
	
	/**
	* @dataProvider dataProvider
	*/
	public function testAppend($type, array $lst)
	{
	    $l1 = new Basis_Type_Typed_List($type);
	    $l1->set($lst);
	    $lst[] = $lst[0];
	    $l1->append($lst[0]);
	    
	    $this->assertEquals($l1->get(), $lst);
	}
	
	/**
	* @expectedException Basis_Exception
	* @dataProvider invalidDataProvider
	*/
	public function testInvalids($type, $lst)
	{
		$d = new Basis_Type_Typed_List($type);
		$d->set($lst);
	}
	
	public function invalidDataProvider()
	{
	    return array(
	        array("int", array(1, 2, "3")),
	        array("float", array(1.0, 2.0, 3)),
	        array("string", array("one", new stdClass())),
	        array("Exception", array(new stdClass(), "new stdClass")),
	        array("int", array("one"=>1, "two"=>"two")),
	        array("string", array(1)),
	    );
	}
}