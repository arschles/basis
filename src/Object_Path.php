<?php

class Mongo_Object_Path
{
	private $path;
	public function __construct(array $path)
	{
		$this->path = $path;
	}
	
	public function get()
	{
		return $this->path;
	}
}
