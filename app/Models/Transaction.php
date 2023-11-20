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
        'due_on',
        'is_vat_inclusive',
        'vat_percentage',
        'status',
        'total',
        ];
    public function payer(){
        return $this->belongsTo(User::class,'payer_id','id');
    }
}
