<?php

$src = dirname(__FILE__).'/src/';

//TODO: autoloader

require_once $src.'Exception.php';
require_once $src.'Basis_Base.php';

require_once $src.'types/Basis_Type_Base.php';
require_once $src.'types/Basis_Type_Dict.php';
require_once $src.'types/Basis_Type_Float.php';
require_once $src.'types/Basis_Type_Int.php';
require_once $src.'types/Basis_Type_List.php';
require_once $src.'types/Basis_Type_Ranged_Int.php';
require_once $src.'types/Basis_Type_String.php';
require_once $src.'types/Basis_Type_Timestamp.php';
require_once $src.'types/Basis_Type_TypedDict.php';
require_once $src.'types/Basis_Type_TypedList.php';
require_once $src.'types/Basis_Type_Unsigned_Float.php';
require_once $src.'types/Basis_Type_Unsigned_Int.php';