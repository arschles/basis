<?php

/**
* class that handles versioning of objects in MongoDB
* 
* sample usage:
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
abstract class Mongo_Object_Versioned extends Mongo_Object_Base
{
	private /*MongoID*/$_id;
	private /*Mongo_Object_Version*/$_version;
	protected /*array*/$_data;
	
	public function __construct(array $blob)
	{
		parent::__construct($blob);
		
		//do the versioning
		$newest_ver = $this->getNewestVersion();
		$ver = isset($this->_data['_ver']) ? new Mongo_Object_Version($this->_data['_ver']) : false;
		
		if(false === $ver)
		{
			$this->ensureNewest();
			$this->_version = $newest_ver;
			$ver = $newest_ver;
		}
		
		if($ver < $newest_ver)
		{
			$this->upconvertVersion($ver);
			$this->_version = $newest_ver;
		}
		else
		{
			//WTF - this is a newer version than we know abt
		}
	}
	
	/**
	* get the version of this object
	*
	* @return int: the version number of this object
	*/
	public function getVersion()
	{
		return $this->_version;
	}
	
	public function __toString()
	{
		$arr = array();
		foreach($this->_data as $k=>$v)
		{
			$arr[] = $k .' = ' . $v;
		}
		
		return "version = $this->_version\n".parent::__toString();
	}
	
	public function save(MongoCollection $c)
	{
		$this->_data['_id'] = $this->_id;
		$this->_data['_ver'] = $this->_version;
		
		$c->save($this->_data);
		
		unset($this->_data['_id']);
		unset($this->_data['_ver']);
	}
	
	//called when a blob with an old version number (ie: less than getNewestVersion) is encountered.
	//this function should convert the blob from $oldVersion to the most recent version (ie: getNewestVersion())
	abstract protected function upconvertVersion($oldVersion);
	//ensure that the data in this blob is of the newest version
	abstract protected function ensureNewest();
	//get the newest version of any blob
	abstract protected function getNewestVersion();
}
