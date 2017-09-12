<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Reset the table value
    protected $table = 'categories';

    public function posts()
    {
      return $this->hasMany('App\Post');
    }
}
