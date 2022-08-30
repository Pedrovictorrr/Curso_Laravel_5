<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Historico extends Model
{
    protected $fillable = ['type','amount','total_before','total_after','user_id_transaction','date'];

    public function type($type = null)
    {
        $types = [
            'I' => 'Entrada',
            'O' => 'Saque',
            'T' => 'Transferencia',
        ];
        if (!$type)
        {
            return $types;
        }
        
        return $types[$type];
    }

   
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function userSender()
        {
            return $this->belongsTo(User::class, 'user_id_transaction');
        }
    

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
