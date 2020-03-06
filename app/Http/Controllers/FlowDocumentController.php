<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlowDocument;
use App\User;
use Yajra\DataTables\DataTables;
use DB;

class FlowDocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:workflow-list');
        $this->middleware('permission:workflow-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:workflow-edit', ['only' => ['edit', 'update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('flow.index');
    }

    public function getData(){
        $flow = FlowDocument::select([
            'id',
            'id_doc',
            'step_number',
            'author',
            'status_number',
            'status',
            'button',
            'created_at',
            'updated_at'
        ]);
        return DataTables::of($flow)->addColumn('action',function($flow){
            return 
            '<a href="'.route('department.show',$flow->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
             <a href="'.route('department.edit',$flow->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a>
             <a href="data-remote" data-remote ="'.route('flow.destroy',$flow->id).'"class="btn btn-xs btn-delete btn-default"><i class="glyphicon glyphicon-edit"></i> Delete</a>
            ';
        })->editColumn('updated_at', function ($flow) {
            return $flow->updated_at->diffForHumans();
            })->filterColumn('updated_at', function ($query, $keyword) {
                     $query->whereRaw("DATE_FORMAT(updated_at,'%Y/% m/%d') like ?", ["%$keyword%"]);
                    })     
            ->make(true);    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('flow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
