<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table='professors';

    protected $primaryKey = 'cpf_professor';

    protected $keyType = 'string';

    protected $increments=false;

    protected $fillable = [
        'cpf_professor',
        'rg_professor',
        'nome_professor',
        'email_professor',
        'celular_professor',
        // 'fk_materia',
        'imagem_professor',
        'descricao_professor',
        'senha_professor'
    ];

    // public function materia()
    // {
    //     return $this->belongsTo(Materia::class, 'nome_materia', 'fk_materia');
    // }
}
