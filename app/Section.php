<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'section';
    protected $fillable = ['section'];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function Department(){
        return $this->belongsTo('App\Department');
    }
}
