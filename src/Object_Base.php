<?php

/**
* base class for handling objects in MongoDB
* 
* sample usage:
* class User extends Mongo_Object_Base
* {
* }
* 
* $mongo = new Mongo();
* $mongoDB = $mongo->selectDB('User');
* $mongoColl = $mongoDB->selectCollection('User');
* $rawBlob = $mongoColl->findOne($my_query_params);
* $user = new User($rawBlob);
* //do stuff with user
* $user->save($mongoColl);
* 
* TODO:
* handle more than the single depth arrays (ie: with pathing)
* handle data structuring and validation (ie: with pathing
*/
abstract class Mongo_Object_Base
{
	private $_id;
	protected $_data;
	
	public function __construct(array $blob)
	{
		$this->_data = $blob;
		
		if(!isset($this->_data['_id'])) throw new Mongo_Object_Exception('no "_id" element in blob passed to Mongo_Object_Base');
		
		//set the ID
		$this->_id = $this->_data['_id'];
		unset($this->_data['_id']);
	}
	
	/**
	* get a value in the object at $path
	*
	* @param Mongo_Object_Path $path: the path from which to get the value
	* @param mixed $returnIfMissing: the value to return if $path doesn't exist
	* @return mixed: the value at $path, if it exists. otherwise $returnIfMissing if $path doesn't exist
	*/
	public function get(Mongo_Object_Path $path, $returnIfMissing = false)
	{
		$path_elts = $path->get();
		$level = $this->_data;
		foreach($path_elts as $path_elt)
		{
			if(is_array($level) && array_key_exists($path_elt, $level))
			{
				$level = $level[$path_elt];
			}
			else
			{
				return $returnIfMissing;
			}
		}
		
		return $level;
	}
	
	/**
	* set $val at $path
	*
	* @param Mongo_Object_Path $path: the path at which to set $val
	* @param mixed $val: the value to set at $path
	* @return void
	*/
	public function set(Mongo_Object_Path $path, $val)
	{
		$path_elts = $path->get();
		$level = &$this->_data;
		foreach($path_elts as $path_elt)
		{
			if((is_array($level) && !array_key_exists($path_elt, $level)) || !is_array($level))
			{
				$level[$path_elt] = array();
			}
			$level = &$level[$path_elt];
		}
		$level = $val;
	}
		
	/**
	* set a value at $path iff that value already existed and was equal to $testVal.
	* note that this function is NOT atomic on the server.
	* 
	* @param Mongo_Object_Path $path: the path at which to testAndSet
	* @param mixed $testVal: the value to test
	* @param mixed $setVal: the value to set
	* @return bool: true if $setVal was set at $path, else false
	*/
	public function testAndSet(Mongo_Object_Path $path, $testVal, $setVal)
	{
		$actualVal = $this->get($path);
		if($actualVal == $testVal) $this->set($path, $setVal);
	}
		
	public function getID()
	{
		return $this->_id;
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
	
	public function save(MongoCollection $c)
	{
		$this->_data['_id'] = $this->_id;
		
		$c->save($this->_data);
		
		unset($this->_data['_id']);
	}
}
