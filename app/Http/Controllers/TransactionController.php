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
        $statuses = Status::all();
        $items = Item::all();
        $transactions = Transaction::all();
        // dd($items);
       
        return view('transactions.index')->with('items', $items)->with('transactions', $transactions)->with('statuses', $statuses);
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


      
        // dd($request->all());
        $transaction = new Transaction;
        $transaction_number = Auth::user()->id . Str::random(8) . time();
        $user_id = Auth::user()->id;
        $borrow_date = $request->input('borrow');
        $return_date = $request->input('return');

        $transaction->transaction_number = $transaction_number;
        $transaction->user_id = $user_id;
        $item_id = $request->input('item_name');
        $transaction->item_id = $item_id;
        $transaction->borrow_date = $borrow_date;
        $transaction->return_date = $return_date;
        $transaction->save();

        $item = Item::find($item_id);
        $item->isAvailable = false;
        $item->save();
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
        // dd($transaction->item->name);
        // echo "im here";
        return view('transactions.show')->with('transaction', $transaction)->with('items', $items);
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
        $transaction->status_id = $request->input('status');
        // dd($request->input('status'));
        $transaction->save();

        // echo "hey";
        return redirect(route('transactions.index'))
        ->with('updated_transaction', $transaction->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        // echo "deleted";

        return redirect(route('items.index'))->with('destroy_message', 'Transaction Cancelled');
    }

}
