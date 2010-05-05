<?php

/**
* base class for handling data (ie: a blob)
* 
* sample usage for MongoDB:
* 
* class User extends Mongo_Object_Base
* {
*   public static $name = new Object_Type_String();
*   
*   private $coll;
*   public function __construct(array $blob, Mongo_Collection $coll)
*   {
*       $this->coll = $coll;
*       parent::__construct($blob);
*   }
*   public function save()
*   {
*       $this->coll->save($this->_data);
*   }
* }
* 
* $mongo = new Mongo();
* $mongoDB = $mongo->selectDB('User');
* $mongoColl = $mongoDB->selectCollection('User');
* $rawBlob = $mongoColl->findOne($my_query_params);
* $user = new User($rawBlob);
* //do stuff with user
* var_dump($user->name);
* $user->save();
*/
abstract class Object_Base
{
    protected $_expected_properties = array();
    
	protected $_data;
	
	protected $_name;
	
	public function __construct(array $blob)
	{
	    $refl = new ReflectionClass($this);
	    
	    $prop_names = $refl->getStaticProperties();
	    
	    $this->_name = $this->name();
	    
	    foreach($prop_names as $prop_name)
	    {
	        $prop_val = $refl->getStaticPropertyValue($prop_name);
	        if(!($prop_val instanceof Object_Type_Base))
	        {
	            throw new Mongo_Object_Exception("in {$this->_name}, {$prop_name} is not a subclass of Object_Type_Base");
	        }
	        
	        $this->_expected_properties[$prop_name] = $prop_val;
	    }
		
		$this->matchProperties($this->_expected_properties, $this->_data);
		
		$this->_data = $blob;
	}
	
	public function matchProperties(array $expected, array $blob)
	{
	    foreach($expected as $name => $type)
	    {
	        if(!isset($blob[$name]))
	        {
	            throw new Mongo_Object_Exception("data given to {$this->_name} has no key {$name}");
	        }
	        
	        $validated = $type->validate($blob[$name]);
	        if($validated === false)
	        {
	            $typename = $type->name();
	            throw new Mongo_Object_Exception("key {$name} in blob given to {$this->_name} is not a {$typename}");
	        }
	    }
	}
	
	public function & __get($s)
	{
	    if(!isset($this->_expected_properties[$s]))
	    {
	        throw new Mongo_Object_Exception("attempt to get property [$s] which does not exist");
	    }
	    return $this->_data[$s];
	}
	
	public function name()
    {
	    return get_class($this);
	}
	
	public function __toString()
	{
		$arr = array();
		foreach($this->_data as $k=>$v)
		{
			$arr[] = $k .' = ' . $v;
		}
		
		
		return "id = $this->_id\n".implode("\n", $arr)."\n";
	}
	
	abstract public function save();
}
