<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    protected $table = 'returns';
    protected $fillable = ['loans_detail_id', 'charge', 'amount'];

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class, 'loans_detail_id');
    }
}
