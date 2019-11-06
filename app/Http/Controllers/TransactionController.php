<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Item;
use App\Status;
use Auth;
use Str;
use Category;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::all();
        $items = Item::all();
        $transactions = Transaction::all();
        // dd($items);
       
        return view('transactions.index')->with('items', $items)->with('transactions', $transactions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'borrow' => 'required',
            'return' => 'required'
        ]);

        //   Transaction::create([
        //     'borrow' => $request->input('borrow'),
        //     'return' => $request->input('return'),
        // ]);
        // dd($request->all());
        $transaction = new Transaction;
        $transaction_number = Auth::user()->id . Str::random(8) . time();
        $user_id = Auth::user()->id;
        $borrow_date = $request->input('borrow');
        $return_date = $request->input('return');

        $transaction->transaction_number = $transaction_number;
        $transaction->user_id = $user_id;
        $transaction->borrow_date = $borrow_date;
        $transaction->return_date = $return_date;
        $transaction->save(); 

        // dd($transaction);
        // $request->session()->flash('transaction_message', 'Successfully Requested!');

        return redirect(route('transactions.show', ['transaction'=>$transaction->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $items = Item::all();
        $transactions = Transaction::all();
        // dd($transaction);

        return view('transactions.show')->with('transactions', $transactions)->with('items', $items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
