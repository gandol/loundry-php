<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function getAllTransactions(Request $request)
    {
        $userId = $request->get('user_id');
        $transactionsData = Transactions::where('user_id', $userId)
        ->get();
        foreach ($transactionsData as $transaction) {
            $transaction->items = DB::table('transaksi_items')->where("transaksi_id", $transaction->id)->get();
        }
        return response()->json($transactionsData);
    }
}
