<?php

class Basis_Type_Dict extends Basis_Type_Base
{
    public function validate($data)
    {
        if(!is_array($data)) return false;

        foreach($data as $key=>$val)
        {
            if(is_int($key)) return false;
        }

		return true;
    }

	public function get($key)
	{
		$dict = parent::get();
		if(!isset($dict[$key])) throw new Basis_Exception("no such key $key exists");
		return $dict[$key];
	}
	
	public function set($key, $val)
	{
		$dict = parent::get();
		$dict[$key] = $val;
		parent::set($dict);
	}
}