<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicaoFinanceira',
        'modalidadeCredito',
        'valorAPagar',
        'valorSolicitado',
        'taxaJuros',
        'qntParcelas'
    ];
}
