<?php

class Object_Type_List extends Object_Type_Base
{
    public function validate($data)
    {
        if(!is_array($data)) return false;
        
        foreach($data as $key=>$val)
        {
            if(!is_int($key)) return false;
        }
    }
}