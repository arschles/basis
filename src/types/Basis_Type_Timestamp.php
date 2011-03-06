<?php
require_once "Basis_Type_Unsigned_Float.php";
class Basis_Type_Timestamp extends Basis_Type_Unsigned_Float
{
    //todo: add auto_now and auto_now_add semantic. see http://code.google.com/appengine/docs/python/datastore/typesandpropertyclasses.html#DateTimeProperty
	public function __construct($ts = null)
	{
		if(is_null($ts)) $ts = microtime(true);
		
		parent::__construct();
		$this->set($ts);
	}
}