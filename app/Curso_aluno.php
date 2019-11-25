<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso_aluno extends Model
{
    protected $table = 'curso_aluno';

	protected $primaryKey = 'id_curso_aluno';
    
    protected $fillable = [
        'id_curso',
        'id_aluno',      
    ];

    public $timestamps = true;
}
