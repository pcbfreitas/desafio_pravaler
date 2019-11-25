<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inst_curso extends Model
{
    protected $table = 'inst_curso';

	protected $primaryKey = 'id_inst_curso';
    
    protected $fillable = [
        'id_instituicao',
        'id_curso',        
    ];

    public $timestamps = true;
}
