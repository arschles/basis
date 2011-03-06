<?php
require_once dirname(__FILE__).'/../Basis.php';

class basicObj extends Basis_Base
{
    public function properties()
    {
        return array(
            'exampleOne' => new Basis_Type_String(),
            'exampleTwo' => new Basis_Type_Int()
        );
    }
}

class Basis_Base_Test extends PHPUnit_Framework_TestCase
{
    public function testBasicRoundTrip()
    {
        $b = new basicObj();
        $b->exampleOne('hello');
        $b->exampleTwo(1);
        
        $encoded = $b->encode();
        $decoded = basicObj::decode($encoded);
        $this->assertEquals($decoded->exampleOne(), $b->exampleOne());
        $this->assertEquals($decoded->exampleTwo(), $b->exampleTwo());
    }
}
