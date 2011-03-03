<?php

abstract class Basis_Type_Base
{
    private $val;
    private $name;
    
    public function __construct($val)
    {
        $this->name = get_class($this);
		$this->set($val);
    }
    
    public function set($val)
    {
        $name = $this->name();
        $valid = $this->validate($val);
        if($valid === false)
        {
            throw new Basis_Exception("data [$val] passed into [{$name}] was invalid");
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
	
	public function __toString()
	{
		return json_encode($this->get());
	}
    
    /**
    * validate data
    * 
    * @return bool true if it is valid, false otherwise
    */
    abstract public function validate($data);
}