<?php

class Object_Type_Dict extends Object_Type_Base
{
    public function validate($data)
    {
        if(!is_array($data)) return false;
    }
}