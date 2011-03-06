<?php
require_once "Basis_Type_Base.php";

class Basis_Type_String extends Basis_Type_Base
{
    public function validate($data)
    {
        return is_string($data);
    }
}