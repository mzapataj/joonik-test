<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Get Author 
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
