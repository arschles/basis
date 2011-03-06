<?php
require_once "Basis_Type_Base.php";

class Basis_Type_Types
{
    const ARRAY_TYPE = "array";
    const BOOL_TYPE = "bool";
    const FLOAT_TYPE = "float";
    const INT_TYPE = "int";
    const NULL_TYPE = "null";
    const STRING_TYPE = "string";
    
    public static function getTypeString($val)
    {
        if(is_object($val)) return get_class($val);
        else if(is_array($val)) return self::ARRAY_TYPE;
        else if(is_bool($val)) return self::BOOL_TYPE;
        else if(is_float($val)) return self::FLOAT_TYPE;
        else if(is_int($val)) return self::INT_TYPE;
        else if(is_null($val)) return self::NULL_TYPE;
        else if(is_string($val)) return self::STRING_TYPE;
        
        throw new Basis_Exception("type of $val is unknown");
    }
    
    public static function getTypeStringNoThrow($val)
    {
        try
        {
            return self::getTypeString($val);
        }
        catch(Basis_Exception $e)
        {
            return "unknown";
        }
    }
}