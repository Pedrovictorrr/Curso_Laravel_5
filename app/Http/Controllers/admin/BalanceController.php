<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;
use App\Http\Requests\ValidacaoSaldoFormRequest;
use App\Models\User;
use App\Models\Historico;

class BalanceController extends Controller
{
        
    public function index()
    {
            $balance = auth()->user()->balance;
            $amount = $balance ? $balance->amount : 0;
            return view('Admin.Balance.index',compact('amount'));
    }
                        
    
        // *************DEPOSITAR OU SACAR*************
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



    // **************** TRANSFERIR PARA OUTRO USUARIO ***************

    public function transferir()
    {
        return view('Admin.Balance.Transferir');
    }

    public function enviar(Request $request,User $user)
    {   

      if(!$sender = $user->receber($request->sender)){
        return redirect()->back()->with('error', 'Usuario informado não existe.');
      }
      if($sender->id === auth()->user()->id){
        return redirect()->back()->with('error', 'Não pode transferir para si mesmo.');
      }
      $balance = auth()->user()->balance;
      return view('Admin.Balance.enviar-confirmar',compact('sender','balance'));
    }


    public function EnviarConfirmar(ValidacaoSaldoFormRequest $request,User $user)
    {
        
        if(!$sender = $user->find($request->sender_id)){
                return redirect()->route('balance.transferir')->with('success', 'Distinatário não encontrado');
        }
        
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response= $balance->enviarModel($request->value,$sender);
       
       if($response['success']){
               return redirect()->route('balance')->with('success', $response['message']);
        }else{
               return redirect()->back()->with('error', $response['message']);
        }
    }

// ********************* Historico *********************

public function historico(Historico $Historicos)
{
        $historicos = auth()->user()->historic()->with(['userSender'])->simplePaginate(5);

        $types = $Historicos->type();
        
        return view('Admin.Balance.historico', compact('historicos','types'));
}

public function historicoPesquisa(Request $request,Historico $Historicos)
{
        $dataform = $request->except('_token');
        $historicos =  $Historicos->search($dataform);
        $types = $Historicos->type();
        return view('Admin.Balance.historico', compact('historicos','types', 'dataform'));
}
   
}
