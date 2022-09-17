<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = "recipes";

    protected $filltable = ['id', 'recipename', 'energy', 'salt', 'num_people', 'time', 'url'];
}
