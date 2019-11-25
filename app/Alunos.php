<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    protected $table = 'alunos';

	protected $primaryKey = 'id_aluno';
    
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'email',        
        'celular',        
        'endereco',        
        'numero',        
        'bairro',        
        'cidade',        
        'uf',        
        'status',        
    ];

    public $timestamps = true;
}
