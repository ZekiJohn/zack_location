<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    protected $fillabel = ['name', 'age', 'weight', 'sex'];
    public $visible = ['name', 'age', 'weight', 'sex'];
}
