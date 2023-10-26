<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternativa extends Model
{
    use HasFactory;

    protected $table='alternativas';

    protected $primaryKey='id_alternativa';

    protected $fillable = [
        'letra',
        'descricao_alternativa',
        'imagem_alternativa',
        'correta',
        'fk_id_exercicio'
    ];

    public function exercicio()
        {
            return $this->belongsTo(Exercicio::class, 'fk_id_exercicio', 'id_exercicio');
        }

    public function referenciadores()
    {
        return $this->hasMany(Alternativa::class, 'letra', 'fk_letra_certa');
    }
}
