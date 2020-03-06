<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryDocument extends Model
{
    //
    protected $table = 'history_document';
    protected $fillable = [
        'id_document',
        'id_user',
        'activity',
        'commentar',
        'activity_date'
    ];
}
