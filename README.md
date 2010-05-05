Basis
============

Basis is a very simple data ORM for PHP. It generally aims to for the base for all of your data models, and more specifically tries to accomplish the following goals:

- Type safety

You specify the name of fields in your data as well as the type, and Basis checks to make sure that the field is there and its data is of the right type

- Simplicity

Basis aims to be lightweight and to stay out of your way. If you want to use it, create a subclass and name your fields, their types, and tell it how to save your data. Basis doesn't enforce the data storage engine. You can use MySQL, Memcache, MongoDB, etc....

Getting Started
===============

This sample code covers the high level usage of Basis. More to come here.

    class User extends Mongo_Object_Base
    {
      public static $name = new Object_Type_String();
  
      private $coll;
      public function __construct(array $blob, Mongo_Collection $coll)
      {
       $this->coll = $coll;
       parent::__construct($blob);
      }
      public function save()
      {
       $this->coll->save($this->_data);
      }
    }

    $mongo = new Mongo();
    $mongoDB = $mongo->selectDB('User');
    $mongoColl = $mongoDB->selectCollection('User');
    $rawBlob = $mongoColl->findOne($my_query_params);
    $user = new User($rawBlob);
    //do stuff with user
    var_dump($user->name);
    $user->save();


