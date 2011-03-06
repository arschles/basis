<?php

/**
* base class for handling data
* 
* TODO: put sample usage here
*/
abstract class Basis_Base
{
    private $_data = array();
    	
	private $_name;
	
	public function __construct(array $options = array())
	{
	    $this->_name = $this->name();
	    
	    $data = array();
	    if(isset($options['data']))
	    {
	        $data = $options['data'];
	    }
	    
	    $props = $this->properties();
	    
	    //loop through prop names and populate them if they were given (ie: from datastore)
	    foreach($props as $prop_name=>$prop_val)
	    {
	        if(!is_a($prop_val, "Basis_Type_Base"))
	        {
	            $name = $this->name();
	            throw new Basis_Exception("property $prop_name is not a Basis_Type_Base subclass in $name");
	        }
	        
	        if(isset($data[$prop_name]))
	        {
	            $prop_val = $data[$prop_name];
	        }
	            
			$this->_data[$prop_name] = $prop_val;
	    }
	}
	
	final public function getRawData()
	{
	    return $this->_data;
	}
	
	public function exists($prop)
	{
		return isset($this->_data[$prop]);
	}
	
	//the getter and setter functions
	final public function & __call($name, array $args)
	{
	    $ret = null;
		if($this->exists($name))
		{
		    //set
			if(count($args) == 1)
			{
			    $ret = &$this->set($name, $args[0]);
			}
			else
			{
			    $ret = &$this->get($name);
			}
		}
		return $ret;
	}
	
	final private function ensureField($name)
	{
	    if(!$this->exists($name))
	    {
	        $thisclass = $this->name();
    	    throw new Basis_Exception("no such field $name in $thisClass");
	    }
	}
	
	final public function & get($name)
	{
	    $this->ensureField($name);
	    $ret = & $this->_data[$name];
	    return $ret;
	}
	
	final public function set($name, $val)
	{
	    $this->ensureField($name);
	    $this->_data[$name]->set($val);
	}
		
	public function name()
    {
	    return get_class($this);
	}
	
	public function __toString()
	{
	    return $this->name();
	}
	
	public function encode()
	{
	    $data = $this->_data;
	    $arr = array();
	    foreach($data as $prop_name=>$val)
	    {
	        $arr[$prop_name] = $val->encode();
	    }
	    
	    return json_encode($arr);
	}
	
	public static function decode($encoded)
	{
	    $cls = get_called_class();
	    $decoded_raw = json_decode($encoded, true);
	    $decoded_complete = array();
	    foreach($decoded_raw as $key=>$val)
	    {
	        $decoded_complete[$key] = Basis_Type_Base::decode($val);
	    }
	    
	    return new $cls(array('data'=>$decoded_complete));
	}
	
	abstract public function properties();
}
