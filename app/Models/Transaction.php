<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'payer_id',
        'amount',
        'amount_remaining_unpaid',
        'total',
        'due_on',
        'is_vat_inclusive',
        'vat_percentage',
        'status',
    ];
    public function payer(){
        return $this->belongsTo(User::class,'payer_id','id');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
