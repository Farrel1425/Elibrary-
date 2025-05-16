<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $guarded = []; // Artinya tidak ada field yang diproteksi

    protected static function boot(){
    parent::boot();

    static::creating(function ($book) {
        // Pastikan stok minimal 1
        if ($book->stock < 1) {
            $book->stock = 1;
        }
    });
  }
}