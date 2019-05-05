<?php
namespace App;
use Illuminate\Database\Eloquent\Collection;

class aCollection extends Collection{
    public function startsWithA()
    {
        return $this->filter(function($item){
            if(substr($item, 0, 1) === 'A'){
                return $item;
            }
        });
    }
}
