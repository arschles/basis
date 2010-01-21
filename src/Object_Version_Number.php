<?php

class Mongo_Object_Version_Number
{
	protected $_ver;
	
	public function __construct($ver)
	{
		if(!is_integer($ver)) throw new Exception('$ver passed to Mongo_Object_Version is not an integer');
		$this->_ver = $ver;
	}
	
	/**
	* get a raw integer representation of the version number
	*
	* @return int: the version number
	*/
	public function getRaw()
	{
		return $this->_ver;
	}
	
	/**
	* determine whether this version is greater than $v
	* 
	* @return bool: true if this version is greater than $v, false otherwise
	*/
	public function greaterThan(Mongo_Object_Version_Number $v)
	{
		return ($this->_ver > $v->getRaw());
	}
	
	/**
	* determine whether this version is equal to $v
	* 
	* @return bool: true if this version is equal to $v, false otherwise
	*/
	public function equals(Mongo_Object_Version_Number $v)
	{
		return ($this->_ver == $v->getRaw());
	}
	
	/**
	* determine whether this version is less than $v
	*
	* @return bool: true if this version is less than $v, false otherwise
	*/
	public function lessThan(Mongo_Object_Version_Number $v)
	{
		return ($this->_ver < $v->getRaw());
	}
	
	public function __toString()
	{
		return "<Mongo_Object_Version: $this->%ver>\n";
	}
}