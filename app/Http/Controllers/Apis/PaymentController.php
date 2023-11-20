<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
      public function store(CreatePaymentRequest $request){

          $data_attributes = $request->safe()->all();
          $payment = Payment::create($data_attributes);

          $transaction = Transaction::find($request->transaction_id);
          $transaction->amount_remaining_unpaid = $transaction->amount_remaining_unpaid - $request->amount;
          if($transaction->amount_remaining_unpaid <= 0) $transaction->status = 'paid';
          $transaction->save();

          return response()->ok(__('Payment Created Successfully'),[ new  PaymentResource($payment)]);

      }
}
