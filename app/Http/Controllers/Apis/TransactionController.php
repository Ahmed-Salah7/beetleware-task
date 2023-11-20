<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTransactionRequest;
use App\Http\Resources\Transactions\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
      public function store(CreateTransactionRequest $request){

          $data_attributes = $request->safe()->all();
          $request->is_vat_inclusive ?
              $data_attributes['total'] =  $request->amount:
              $data_attributes['total'] = $request->amount + (($request->amount / 100) * $request->vat);

          $request->due_on <= now() ?
              $data_attributes['status'] = 'overdue':
              $data_attributes['status'] = 'Outstanding';

          $transaction = Transaction::create($data_attributes);
          return response()->ok(__('Transaction Created Successfully'),[ new  TransactionResource($transaction)]);

      }
}
