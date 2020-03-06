<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkFlowDetail extends Model
{
    //
    protected $table = 'work_flow_detail';
    protected $fillable = [
        'id_work_flow',
        'step_number',
        'status',
        'author',
        'sentBack',
        'check',
        'approve',
        'reject'
        ];
    public $timestamps = true;
}
