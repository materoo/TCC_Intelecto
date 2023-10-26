<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table='materias';

    protected $primaryKey = 'nome_materia';

    protected $keyType = 'string';

    protected $increments=false;

    // public $incrementing = false;

    protected $fillable = [
        'nome_materia'
    ];

    public function assuntos()
    {
        return $this->hasMany(Assunto::class, 'fk_materia', 'nome_materia');
    }

    public function aulas()
    {
        return $this->hasMany(Aula::class, 'fk_materia', 'nome_materia');
    }

    public function exercicios()
    {
        return $this->hasMany(Exercicio::class, 'fk_materia', 'nome_materia');
    }




}
