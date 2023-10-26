<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacao extends Model
{
    use HasFactory;

    protected $table='redacaos';

    protected $primaryKey='titulo';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'titulo', 
        'nome_imagem',
        'texto_imagem',
        'descricao'
    ];

    public function referenciadores()
    {
        return $this->hasMany(Redacao::class, 'titulo', 'fk_tema');
    }

    public function redacoesCorrigidas()
    {
        return $this->hasMany(RedacaoCorrigida::class, 'fk_tema', 'titulo');
    }

}
