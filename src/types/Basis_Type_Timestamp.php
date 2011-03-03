<?php
class Basis_Type_Timestamp extends Basis_Type_Unsigned_Float
{
	public function __construct($ts = null)
	{
		if(is_null($ts)) $ts = microtime(true);
		
		parent::__construct($ts);
	}
}