<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;

class BalanceController extends Controller
{
    public function index()
    {
           
            $balance = auth()->user()->balance;
            $amount = $balance ? $balance->amount : 0;
            return view('Admin.Balance.index',compact('amount'));
    }
    public function deposito()
    {
            return view('Admin.Balance.deposito');
    }
    public function store(Request $request)
    {
            $balance = auth()->user()->balance()->firstOrCreate([]);
            $balance->deposito($request->value);
            

    }
}
