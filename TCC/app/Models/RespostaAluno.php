<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaAluno extends Model
{
    use HasFactory;

    protected $table='resposta_alunos';

    protected $primaryKey='id_resposta';

    // public $incrementing = false;

    protected $fillable = [
        'id_resposta',
        'fk_id_exercicio', 
        'letra_respondida'
    ];


    public function exercicio()
    {
        return $this->belongsTo(Exercicio::class, 'id_exercicio', 'fk_id_exercicio');
    }
}
