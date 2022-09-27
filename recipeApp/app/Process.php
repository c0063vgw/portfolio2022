<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = "processes";

    protected $filltable = ['recipe_id', 'num', 'process'];
}
