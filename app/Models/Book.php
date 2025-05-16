<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD

class Book extends Model
{
    protected $guarded = []; // Artinya tidak ada field yang diproteksi

    protected static function boot(){
=======
class Book extends Model
{
  protected $guarded = []; // Artinya tidak ada field yang diproteksi

  protected static function boot(){
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
    parent::boot();

    static::creating(function ($book) {
        // Pastikan stok minimal 1
        if ($book->stock < 1) {
            $book->stock = 1;
        }
    });
  }
<<<<<<< HEAD
}
=======

  public function loans()
  {
      return $this->hasMany(Loan::class);
  }
}
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
