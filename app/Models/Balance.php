<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    
    public function deposito($value)
    {
        $this->amount += number_format($value ,2 ,'.' ,'' );
        $this->save();
    }
}
