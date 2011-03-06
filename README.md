Basis
============

Basis is a simple way to organize and validate data in a PHP web app.

I constantly notice a common problem in PHP apps. When you work with data from a database (ie: Memcache, MySQL, Membase, HBase, etc...), you have to write a lot of code to validate it when you first read it, and ensure that you don't accidentally corrupt it when you modify and write it.

For example, I often find bugs that started because some code expects some key in a memcache blob to be a list, when it was stored as a dictionary, with keys as strings. Usually, these sorts of bugs are tedious and time consuming to find in even medium sized codebases.

Goals
============

Here are Basis's goals:

1. Stay focused: this list should be short.
2. Represent data: Basis is about representing your data. It should be a great way to represent anything you need to store in your web app.
3. Keep it simple: A smart PHP developer should be able to implement a data model by writing down the field names and their types and no more.
4. Don't discriminate: A developer should be able to use whatever datastore they want, and store their data with whatever serialization they want.

Getting Started
===============

- [download](https://github.com/arschles/basis/tarball/master) Basis
- tar xvzf arschles-basis-90e8d03.tar.gz
- cp arschles-basis-90e8d03 $YOUR-PHP-PROJECT/basis

Example
===============

    require_once 'basis/Basis.php';
    class User extends Basis_Base
    {
        public function properties()
        {
            return array(
                'firstName' => new Basis_Type_String(),
                'lastName' => new Basis_Type_String(),
            );
        }
    }
    
    //create a new memcache connection
    $mc = new Memcache;
    $u = User::decode($mc->get($user_id));
    
    //print out who we are
    echo "Hello! I am " . $u->firstName() . " " . $u->lastName();
    
    //change our identity
    $u->firstName("John");
    $u->lastName("Doe");
    
    //save our new identity forever
    $mc->set($u->encode());