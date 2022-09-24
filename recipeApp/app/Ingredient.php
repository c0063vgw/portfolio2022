<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = "ingredients";

    protected $filltable = ['recipe_id', 'name', 'quantity', 'tag_id'];
}
