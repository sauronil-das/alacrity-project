<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'brp',
        'amount',
        'sort_code',
        'account',
        'loan_date',
        'interest_rate',
        'repayment_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAmountPaid()
    {
        return $this->payments()->sum('amount');
    }

    public function getAmountRemaining()
    {
        return $this->amount - $this->getTotalAmountPaid();
    }
}
