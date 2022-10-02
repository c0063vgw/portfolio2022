<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function Genres()
    {
        $genre_list = $this::orderBy("id", "asc")->get();
    
        //dd($genre_list);
        return $genre_list;
    }
}
