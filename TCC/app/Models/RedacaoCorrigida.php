<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedacaoCorrigida extends Model
{
    use HasFactory;

    protected $table='redacao_corrigidas';

    protected $primaryKey='id_redacao_corrigida';

    protected $fillable = [
        'fk_tema',
        'fk_cpf_aluno',
        'arquivo_correcao'
    ];
    public function redacao()
    {
        return $this->belongsTo(Redacao::class, 'fk_tema', 'titulo');
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'fk_cpf_aluno', 'cpf_aluno');
    }

}
