<?php

class Basis_Type_Unsigned_Float extends Basis_Type_Unsigned_Float
{
	public function validate($data)
	{
		return parent::validate($data) && ($data >= 0);
	}
}