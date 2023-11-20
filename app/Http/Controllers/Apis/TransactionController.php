<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTransactionRequest;
use App\Http\Resources\Transactions\TransactionCollection;
use App\Http\Resources\Transactions\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin', ['only' => ['store']]);

    }
    public function index(){
        $user = auth()->user();
        $transactions =  $user->is_admin ?
            Transaction::paginate(10):
             Transaction::where('payer_id',$user->id)->paginate(10);
        return response()->ok(__('Transactions retrivered  successfully'),   new TransactionCollection($transactions));
    }
      public function store(CreateTransactionRequest $request){

          $data_attributes = $request->safe()->all();
          $request->is_vat_inclusive ?
              $data_attributes['total'] =  $request->amount:
              $data_attributes['total'] = $request->amount + (($request->amount / 100) * $request->vat);

          $request->due_on <= now() ?
              $data_attributes['status'] = 'overdue':
              $data_attributes['status'] = 'Outstanding';

          $data_attributes['amount_remaining_unpaid'] = $data_attributes['total'];

          $transaction = Transaction::create($data_attributes);
          return response()->ok(__('Transaction Created Successfully'),[ new  TransactionResource($transaction)]);

      }

      public function report(Request $request){
        $transactions = Transaction::whereBetween('created_at', [$request->from_date, $request->to_date])
            ->select(
                    DB::raw('MONTH(created_at) month , YEAR(created_at) year') ,
                    DB::raw('sum(case when status = "paid" then total END) as `paid`'),
                    DB::raw('sum(case when status = "outstanding" then total END) as `outstanding`'),
                    DB::raw('sum(case when status = "overdue" then total END) as `overdue`'),
            )->groupby('month','year')
             ->get();
          return response()->ok(__('Transactions Report Retrivered  Successfully'), $transactions);
      }
}
