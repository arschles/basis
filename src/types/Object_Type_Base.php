<?php

abstract class Object_Type_Base
{
    private $val;
    private $name;
    
    public function __construct()
    {
        $this->name = get_class($this);
    }
    
    public function set($val)
    {
        $name = $this->name();
        $valid = $this->validate($val);
        if($valid === false)
        {
            throw new Mongo_Object_Exception("data [$val] passed into [{$name}] was invalid");
        }
        
        $this->val = $val;
    }
    
    public function get()
    {
        return $this->val;
    }
    
    public function name()
    {
        return $this->name;
    }
    
    /**
    * validate data
    * 
    * @return bool true if it is valid, false otherwise
    */
    abstract public function validate($data);
}