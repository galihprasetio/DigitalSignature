<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkFlow extends Model
{
    //
    protected $table = 'work_flow';
    protected $fillable = [
        'name'
        
    ];
    public $timestamps = true;
}
