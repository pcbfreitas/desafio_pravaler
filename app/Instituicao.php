<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
	protected $table = 'instituicao';

	protected $primaryKey = 'id_instituicao';
    
    protected $fillable = [
        'nome',
        'cnpj',
        'status',        
    ];

    public $timestamps = true;
}
