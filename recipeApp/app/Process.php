<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = "Processes";

    protected $filltable = ['recipe_id', 'num', 'process'];
}
