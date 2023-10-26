<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $table='aulas';

    protected $primaryKey='nome_aula';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'nome_aula',
        'nome_arquivo',
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
}
