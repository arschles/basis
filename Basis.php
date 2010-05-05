<?php

$src = dirname(__FILE__).'/src/';

//TODO: autoloader

require($src.'Exception.php');
require($src.'Object_Base.php');

require($src.'types/Object_Type_Base.php');
require($src.'types/Object_Type_Dict.php');
require($src.'types/Object_Type_Int.php');
require($src.'types/Object_Type_List.php');
require($src.'types/Object_Type_String.php');
require($src.'types/Object_Type_TypedList.php');
require($src.'types/Object_Type_TypedDict.php');
