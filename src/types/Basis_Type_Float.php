<?php
require_once "Basis_Type_Int.php";

class Basis_Type_Float extends Basis_Type_Int
{
	public function validate($data)
	{
		return is_float($data);
	}
}