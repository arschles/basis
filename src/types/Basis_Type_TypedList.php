<?php

class Basis_Type_TypedList extends Basis_Type_List
{
    private $typename;
    public function __construct($typename)
    {
        $this->typename = $typename;
        parent::__construct();
    }
    
    public function validate($data)
    {
		if(parent::validate($data) == false) return false;
		
        foreach($data as $key=>$val)
        {
            if(get_class($val) != $this->typename) return false;
        }
		
		return true;
    }
}