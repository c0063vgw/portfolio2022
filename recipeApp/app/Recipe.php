<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = "recipes";

    protected $filltable = ['recipe_id', 'tag_id', 'recipename', 'energy', 'salt', 'num_people', 'time', 'food_items', 'steps', 'url'];
}
