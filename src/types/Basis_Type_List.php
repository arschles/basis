<?php

class Basis_Type_List extends Basis_Type_Base
{
    public function validate($data)
    {
        if(!is_array($data)) return false;
        
        foreach($data as $key=>$val)
        {
            if(!is_int($key)) return false;
        }
		return true;
    }
}