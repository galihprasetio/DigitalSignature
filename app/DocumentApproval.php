<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentApproval extends Model
{
    //
    protected $table = 'document_approval';


    protected $fillable = [
        'id_document',
        'id_user',
        'status',
        'date_action'
    ];
    protected $primaryKey = ['id_document','id_user'];
    public $incrementing = false;
    
}
