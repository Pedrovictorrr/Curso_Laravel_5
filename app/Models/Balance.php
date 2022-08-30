<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\User;

class Balance extends Model
{
    public $timestamps = false;
    
    public function deposito(float $value) : Array
    {   
            DB::beginTransaction();
        $totalAntes = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value ,2 ,'.' ,'' );
        $deposito = $this->save();

        $historico = auth()->user()->historic()->create([
            'type' => 'I' ,
            'amount'=> $value,
            'total_before'=> $totalAntes,
            'total_after'=> $this->amount,
            'date' => date('Ymd'),
        ]);

        if($deposito && $historico){ 
                DB::commit();
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
            }else {
                DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao carregar'
            ];

            }
            

        
    }

    public function retirada(float $value) : Array
    {   

        if($this->amount < $value){
            return [
                'success' => false,
                'message'  =>'Saldo Insuficiente'
            ];
        }else{
        DB::beginTransaction();
        $totalAntes = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value ,2 ,'.' ,'' );
        $deposito = $this->save();

        $historico = auth()->user()->historic()->create([
            'type' => 'O' ,
            'amount'=> $value,
            'total_before'=> $totalAntes,
            'total_after'=> $this->amount,
            'date' => date('Ymd'),
        ]);

        if($deposito && $historico){ 
                DB::commit();
            return [
                'success' => true,
                'message' => 'Sucesso ao Sacar'
            ];
            }else {
                DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao Sacar'
            ];

            }
            

        }
    }

    public function enviarModel(float $value,User $sender) : Array
    {
        if($this->amount < $value){
            return [
                'success' => false,
                'message'  =>'Saldo Insuficiente'
            ];
        }else{
        DB::beginTransaction();

        // ************************** Remetente *************
        $totalAntes = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value ,2 ,'.' ,'' );
        $deposito = $this->save();

        $historico = auth()->user()->historic()->create([
            'type' => 'T' ,
            'amount'=> $value,
            'total_before'=> $totalAntes,
            'total_after'=> $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $sender->id,
        ]);

        // ************************** Destinatário*************
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalAntesSender = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value ,2 ,'.' ,'' );
        $depositoSender = $senderBalance->save();

        $historico = $sender->historic()->create([
            'type' => 'I' ,
            'amount'=> $value,
            'total_before'=> $totalAntesSender,
            'total_after'=> $senderBalance->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => auth()->user()->id,
        ]);


        if($deposito && $historico && $depositoSender){ 
                DB::commit();
            return [
                'success' => true,
                'message' => 'Sucesso ao Transferir'
            ];
            }else {
                DB::rollback();
            return [
                'success' => false,
                'message' => 'Falha ao Transferir'
            ];

            }
            

        }

    }
}
