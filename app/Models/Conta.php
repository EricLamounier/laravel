<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $table = 'conta';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome', 'total', 'tipo_conta'
    ];
}
