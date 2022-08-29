<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    
    public function deposito($value)
    {
        $totalAntes = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value ,2 ,'.' ,'' );
        $this->save();

        $historico = auth()->user()->historic()->create([
            'type' => 'I' ,
            'amount'=> $value,
            'total_before'=> $totalAntes,
            'total_after'=> $this->amount,
            'date' => date('Ymd'),
        ]);

        
    }
}
