<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    protected $guarded = []; // Artinya tidak ada field yang diproteksi

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            // Pastikan stok minimal 1
            // if ($member->stock < 1) {
            //     $member->stock = 1;
            // }
        });
    }

    protected $casts = [
        'join_date' => 'date',
    ];
}
