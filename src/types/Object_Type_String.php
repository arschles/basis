<?php

class Object_Type_String extends Object_Type_Base
{
    public function validate($data)
    {
        return is_string($data);
    }
}