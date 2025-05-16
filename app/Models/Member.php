<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
