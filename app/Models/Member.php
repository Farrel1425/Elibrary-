<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD


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
=======
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    /**
     * Kolom yang tidak boleh diisi secara massal
     * 
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Kolom yang harus di-cast
     * 
     * @var array
     */
    protected $casts = [
        'join_date' => 'date'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
}
