<?php

class Video{

    public $name;
    public $length;
    
    public function __construct($name , $length)
    {
        $this->name = $name;
        $this->length = $length;
            
    }

}

class Collection{

    public   $items;
    public   $name;

    public function __construct(  array $items)
    {
        $this->items = $items;
    }

    public function sum($key)
    {
       return array_sum(array_column($this->items , $key));

    }

}
class VideosCollection extends Collection {

    public function length()
    {
        return $this->sum('length');
     }

}

$video = new VideosCollection(
    [
    new Video('dfdfd' , 100),
    new Video('dfdfd' , 100),
    new Video('dfdfd' , 100)
    ]
 );

    echo "<pre>"; print_r($video->length()); die;