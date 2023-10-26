<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $table='assuntos';

    protected $primaryKey = 'nome_assunto';

    protected $keyType = 'string';

    protected $increments=false;

    protected $fillable = [
        'nome_assunto',
        'carga_horaria',
        'fk_materia'
    ];

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'fk_assunto', 'nome_assunto');
    }
    public function exercicios()
    {
        return $this->hasMany(Exercicio::class, 'fk_assunto', 'nome_assunto');
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'fk_materia', 'nome_materia');
    }

}
