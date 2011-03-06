<?php
require_once "Basis_Type_Dict.php";
class Basis_Type_Typed_Dict extends Basis_Type_Dict
{
    private $typename;
    public function __construct($typename)
    {
        $this->typename = $typename;
        parent::__construct();
    }
    
    public function validate($data)
    {
		if(!parent::validate($data)) return false;
		
        
        foreach($data as $key=>$val)
        {
            if(Basis_Type_Types::getTypeString($val) != $this->typename) return false;
        }
        
        return true;
    }
    
    public function name()
    {
        $typename = $this->typename;
        return "Basis_Type_Typed_Dict (type = $typename)";
    }
}