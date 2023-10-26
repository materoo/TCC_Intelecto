<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $table='exercicios';
    protected $primaryKey ='id_exercicio';

    public $incrementing = false;

    protected $fillable = [
        'id_exercicio',
        'descricao_exercicio',
        'imagem_exercicio',
        'ano_exercicio',
        'vestibular',
        'fk_assunto',
        'fk_materia'
    ];

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'fk_assunto', 'nome_assunto');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'fk_materia', 'nome_materia');
    }

    public function alternativas()
    {
        return $this->hasMany(Alternativa::class, 'fk_id_exercicio', 'id_exercicio');
    }
}
