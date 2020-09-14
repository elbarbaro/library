<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function user() {
        return $this->hasOne('App\Borrow', 'book_id', 'id');
    }
}
