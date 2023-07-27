<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    public function userbooks()
    {
        return $this->hasMany(UserBook::class, 'book_id', 'id');
    }

    public function borrow_book()
    {
        return $this->hasMany(borrowBook::class, 'book_id', 'id');
    }
}