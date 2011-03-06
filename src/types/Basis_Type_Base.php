<?php

abstract class Basis_Type_Base
{
    private $val = null;
    private $_name;
    private $isset = false;
    
    /**
    * create a new Basis_Type_Base
    * 
    * @param array $options an array of options. can have the following keys:
    * - 'default': if this key is present, its value will be passed to $this->set
    */
    public function __construct(array $options = array())
    {
        $this->_name = get_class($this);
        if(isset($options['default']))
        {
            $this->set($options['default']);
        }
    }
    
    public function set($val)
    {
        $name = $this->name();
        $valid = $this->validate($val);
        if($valid === false)
        {
            throw new Basis_Exception($this->validationErrorString($val));
        }
        
        $this->val = $val;
        $this->isset = true;
    }
    
    public function validationErrorString($val)
    {
        $t = Basis_Type_Types::getTypeStringNoThrow($val);
        $name = $this->name();
        return "data of type [$t] passed into [$name] was invalid";
    }
        
    public function get()
    {
        if(!$this->isset)
        {
            $name = $this->name();
            throw new Basis_Exception("no value set for $name");
        }
        return $this->val;
    }
    
    public function getNoThrow($defaultReturn = null)
    {
        try
        {
            return $this->get();
        }
        catch(Basis_Exception $e)
        {
            return $defaultReturn;
        }
    }
    
    public function name()
    {
        return $this->_name;
    }
	
	public function __toString()
	{
		return $this->name();
	}
		
    /**
    * validate data
    * 
    * @return bool true if it is valid, false otherwise
    */
    abstract public function validate($data);
    
    const TYPE_PREFIX_LEN = 11;//the length of "Basis_Type_"
    const ENCODING_SEPARATOR = '!!';
    
    final public function encode()
    {
        return get_class($this).self::ENCODING_SEPARATOR.json_encode($this->val);
    }
    
    final public static function decode($data)
    {
        if(!is_string($data))
        {
            throw new Basis_Exception("data given to decode function is not a string");
        }
        else if(substr($data, 0, self::TYPE_PREFIX_LEN) != 'Basis_Type_')
        {
            throw new Basis_Exception("data [$data] given to decode function is malformatted");
        }
        
        $separator_pos = strpos($data, self::ENCODING_SEPARATOR);
        $typename = substr($data, 0, $separator_pos);
        if(!class_exists($typename))
        {
            throw new Basis_Exception("class $typename does not exist");
        }
        $json = substr($data, $separator_pos+strlen(self::ENCODING_SEPARATOR));
        $json_decoded = json_decode($json, true);
        
        $obj = new $typename();
        if(!is_a($obj, "Basis_Type_Base"))
        {
            throw new Basis_Exception("decoded class $typename is not derived from Basis_Type_Base");
        }
        
        $obj->set($json_decoded);
        return $obj;
    }
}