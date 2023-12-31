<?php

namespace App\Http\Resources\Transactions;

use App\Http\Resources\UserResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->status == 'outstanding') {
                if($request->due_on <= now()){
                    $transaction = Transaction::find($this->id);
                    $transaction->status='overdue';
                    $transaction->save();
                }
        }

        return [
            'id' => $this->id,
            'payer_id' => $this->payer_id,
            'amount' => $this->amount,
            'total' => $this->total,
            'due_on' => $this->due_on,
            'is_vat_inclusive' => $this->is_vat_inclusive,
            'vat_percentage' => $this->vat_percentage,
            'status' => $this->status,
            'payments' => $this->payments,
        ];
    }
}
