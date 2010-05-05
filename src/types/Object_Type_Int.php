<?php

class Object_Type_Int extends Object_Type_Base
{
    public function validate($data)
    {
        return is_int($data);
    }
}