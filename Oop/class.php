<?php

trait message1 {
    public function msg1() {
        return "OOP is fun! ";
    }
}

interface Detail{

     public  function firstName();
}

class Person{

     use message1;

     protected $name;
     protected $member;

    public function __construct($name , $member)
    {
     $this->name = $name;
     $this->member = $member;

    }

    public static function start(...$params)
    {
               return new static(...$params);

    }

    public function firstName()
    {
       //return  $this->name;
      //  return preg_split('/(?=[A-Z])/', 'AizazAziz', -1, PREG_SPLIT_NO_EMPTY);

    }

    public function add()
    {
    }
    public function member()
    {
        return $this->member;

    }

}


class Member{

    protected  $name;
    public function __construct($name)
    {
        return  $this->name = $name;

    }

}

$person =  Person::start('AizazAziz' , [
    new Member('sdsds')
    ]
);
//echo $person->firstName();
//echo '<pre>'; var_dump($person->firstName());
echo preg_replace('/(?<!^)([A-Z])/', ' \\1', 'AizazAiz');

