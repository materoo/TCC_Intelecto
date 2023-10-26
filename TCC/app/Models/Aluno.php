<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table='alunos';

    protected $primaryKey = 'cpf_aluno';

    protected $keyType = 'string';

    protected $increments=false;

    protected $fillable = [
        'cpf_aluno',
        'rg_aluno',
        'nome_aluno',
        'email_aluno',
        'celular_aluno',
        'escola_aluno',
        'serie_aluno',
        'imagem_aluno',
        'senha_aluno'
    ];

    public function referenciadores()
    {
        return $this->hasMany(Aluno::class, 'fk_cpf_aluno', 'cpf_aluno');
    }

    public function redacoes()
    {
        return $this->hasMany(RedacaoAluno::class, 'fk_cpf_aluno', 'cpf_aluno');
    }

    public function redacoesCorrigidas()
    {
        return $this->hasMany(RedacaoCorrigida::class, 'fk_cpf_aluno', 'cpf_aluno');
    }
}
