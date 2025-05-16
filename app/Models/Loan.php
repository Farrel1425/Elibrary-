<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{   
        protected $fillable = [
        'member_id', 'book_id', 'librarian_id', 'loan_date', 
        'due_date', 'return_date', 'fine', 'status'
        ];

        // Relasi ke member
        public function member()
        {
            return $this->belongsTo(Member::class);
        }

        // Relasi ke buku
        public function book()
        {
            return $this->belongsTo(Book::class);
        }

        // Relasi ke petugas
        public function librarian()
        {
            return $this->belongsTo(User::class, 'librarian_id');
        }
}

