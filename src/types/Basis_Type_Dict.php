<?php
require_once "Basis_Type_Base.php";

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

	public function getValueForKey($key)
	{
	    $dict = $this->getNoThrow(array());
		if(!isset($dict[$key])) throw new Basis_Exception("no such key $key exists");
		return $dict[$key];
	}
	
	public function setValueForKey($k, $v)
	{
		$dict = $this->getNoThrow(array());
		$dict[$k] = $v;
		$this->set($dict);
	}
}