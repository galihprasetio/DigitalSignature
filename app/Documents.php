<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //
    protected $table = 'documents';
    protected $fillable = [
        'doc_number',
        'doc_type',
        'doc_submit_date',
        'doc_status_number',
        'doc_author',
       // 'doc_status',
        'doc_subject',
        
        'doc_body',
        'doc_file',
        'created_at',
        'updated_at',
    ];
    protected $primaryKey = 'id';
}
