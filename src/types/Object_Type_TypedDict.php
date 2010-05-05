<?php

class Object_Type_TypedDict extends Object_Type_Dict
{
    private $typename;
    public function __construct($typename)
    {
        $this->typename = $typename;
        parent::__construct();
    }
    
    public function validate($data)
    {
        if(!is_array($data)) return false;
        
        foreach($data as $key=>$val)
        {
            if(get_class($val) != $this->typename) return false;
        }
        
        parent::validate($data);
    }
}