<?php

class Basis_Type_Unsigned_Int extends Basis_Type_Int
{
	public function validate($data)
	{
		return parent::validate($data) && ($data >= 0);
	}
}