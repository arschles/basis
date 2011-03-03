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
abstract class Basis_Base
{
    private $_data = array();
    	
	private $_name;
	
	public function __construct(array $blob = null)
	{
	    $refl = new ReflectionClass($this);
	    
	    $prop_names = $refl->getProperties(ReflectionProperty::IS_PROTECTED);
	    
	    $this->_name = $this->name();
	    
	    foreach($prop_names as $prop_name)
	    {
			if(!is_null($blob) && !isset($blob[$prop_name]))
			{
				throw new Basis_Exception("expected a $prop_name but didn't find one in given data");
			}
			
	        $type_obj = $this->$prop_name;
			
	        if($type_obj instanceof Basis_Type_Base)
	        {
				$type_obj->set($blob[$prop_name]);
				$this->_data[$prop_name] = $type_obj;
	        }
	    }
	}
		
	public function keyExists($prop)
	{
		return isset($this->_data[$prop]);
	}
	
	public function __call($name, array $args)
	{
		if($this->keyExists($prop))
		{
			return $this->_data[$name];
		}
		else if(substr($name, 0, 3) == "set")
		{
			$propname = substr($name, 3);
			
			if($this->keyExists($propname) && count($args) > 0)
			{
				$this->_expectedProperties[$propname]->set($args[0]);
			}
			else if(count($args) == 0)
			{
				throw new Basis_Exception("no data given to set for property $propname");
			}
			else if(!$this->keyExists($propname))
			{
				throw new Basis_Exception("no such property $propname");
			}
			return true;
		}
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
			$arr[] = "$k = $v";
		}
		
		return "id = $this->_id\n".implode("\n", $arr)."\n";
	}
	
	abstract public function save();
}
