<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Http\Requests\ValidacaoSaldoFormRequest;

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
    public function saque()
    {
            return view('Admin.Balance.saque');
    }
    public function store(ValidacaoSaldoFormRequest $request)
    {
                $balance = auth()->user()->balance()->firstOrCreate([]);
                $response= $balance->deposito($request->value);

                if($response['success']){
                        return redirect()->route('balance')->with('success', $response['message']);
                }else{
                        return redirect()->back()->with('error', $response['message']);
                }
    }


    public function retirar(ValidacaoSaldoFormRequest $request)
    {
                $balance = auth()->user()->balance()->firstOrCreate([]);
                $response= $balance->retirada($request->value);

                if($response['success']){
                        return redirect()->route('balance')->with('success', $response['message']);
                }else{
                        return redirect()->back()->with('error', $response['message']);
                }
    }
}
