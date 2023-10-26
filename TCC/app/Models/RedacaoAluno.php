<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedacaoAluno extends Model
{
    use HasFactory;

    
    protected $table='redacao_alunos';

    protected $primaryKey='id_redacao';



    protected $fillable = [
        'fk_cpf_aluno',
        'fk_tema',
        'nome_arquivo'
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'fk_cpf_aluno', 'cpf_aluno');
    }

    public function redacao()
    {
        return $this->belongsTo(Redacao::class, 'titulo', 'fk_tema');
    }
 
}
