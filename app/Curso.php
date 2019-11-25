<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';

	protected $primaryKey = 'id_curso';
    
    protected $fillable = [
        'nome',
        'duracao',
        'status',        
    ];

    public $timestamps = true;
}
