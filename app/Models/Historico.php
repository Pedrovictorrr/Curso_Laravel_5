<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['type','amount','total_before','total_after','user_id_transaction','date'];
}
