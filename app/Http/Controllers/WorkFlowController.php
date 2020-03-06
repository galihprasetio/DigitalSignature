<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\WorkFlow;
use App\WorkFlowDetail;
use App\User;
use Yajra\DataTables\DataTables;
use DB;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use App\Department;
use Carbon\Carbon;

class WorkFlowController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:workflow-list');
        $this->middleware('permission:workflow-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:workflow-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:workflow-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('workflow.index');
    }
    public function getData(Request $request){
        //$workflow = WorkFlow::select(['id','name','created_at','updated_at']);
       $workflow = DB::table('work_flow')
       ->join('department','work_flow.name','=','department.id')
       ->select('work_flow.id','department.department','work_flow.created_at','work_flow.updated_at');
        return Datatables::of($workflow)->addColumn('action',function($workflow){
           return '
            <a href="'.route('workflow.show',$workflow->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
            <a href="'.route('workflow.edit',$workflow->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a>
           ';
       })->filter(function ($query) use ($request) {
        if ($request->has('department')) {
            $query->where('department.department', 'like', "%{$request->get('name')}%");
        }})
        ->make(true);
        
       
    }
    public function getUser(Request $request){
        $key = trim($request->q);
        if(empty($key)){
            return response()->json([]);
        }else {
            $tags = User::select(['email','email'])->where('email','LIKE','%'.$key.'%')->get();

            $formatted_tags = [];
    
            foreach ($tags as $tag) {
                $formatted_tags[] = ['email' => $tag->email, 'email' => $tag->email];
            }
            return response()->json($formatted_tags);
            
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department = Department::pluck('department','id')->all();

        return view('workflow.create',compact('department'));
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
        // Orang::updateOrCreate(['name'=>$request->name],
        // ['password'=>$request->password],
        // ['email'=>$request->email]);
        $input = $request->name;
        // $id = DB::table('work_flow')->select('id')->where('name',$input)->first();
        // $id = json_encode($id,true);
        $myField = WorkFlow::where('name', $input)->first()->id;
        return response()->json(['success'=>$myField]);
        
    }
    public function simpan(Request $request){
      
            // Validate the value...
        $input = $request->name;
        $dataTable = $request->sendData;
        $dataTable = json_decode($dataTable,True);
        WorkFlow::create([
            'name' => $input
        ]);
      
        $idWOrkFlow = WorkFlow::where('name', $input)->first()->id;
        
        foreach($dataTable as $dataTable)
        WorkFlowDetail::create([
            'id_work_flow' => $idWOrkFlow,
            'step_number' => $dataTable['Step Number'],
            'status' => $dataTable['Status'],
            'author' => $dataTable['Author'],
            'sentBack' => $dataTable['SentBack'],
            'check' => $dataTable['Check'],
            'approve' => $dataTable['Approve'],
            'reject' => $dataTable['Reject']
        ]);
       
       
       return response()->json(['success'=>'success']);
       return redirect()->route('workflow.index');
       
    }
    public function ajaxRequestPost(Request $request){
        $input = $request->all();
        return response()->json(['success'=>'got simple ajax request']);
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
        $workFlow = WorkFlow::find($id);
        $department = DB::Table('work_flow')
        ->join('department','work_flow.name','=','department.id')
        ->where('work_flow.id',$id)->first();
        $workFlowDetail = DB::table('work_flow_detail')->where('id_work_flow',$id)->orderBy('step_number','asc')->get();
       // $workFlowDetail =WorkFlowDetail::find($id)->all();
        return view('workflow.show',compact('workFlow','workFlowDetail','department'));
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
        $workFlow = WorkFlow::find($id);
        $department = DB::Table('work_flow')
        ->join('department','work_flow.name','=','department.id')
        ->where('work_flow.id',$id)->first();
        $workFlowDetail = DB::table('work_flow_detail')->where('id_work_flow',$id)->orderBy('step_number','asc')->get();
        $author = User::all()->pluck('email');
        //$author = User::select(['email'])->get();

        return view('workflow.edit',compact('workFlow','workFlowDetail','department','author'));
        

    }
    public function editDetail(Request $request){
        $workFlowDetail = WorkFlowDetail::find($request->id);
        return response()->json($workFlowDetail);
    }
    public function editSort(Request $request){
        //$position = $_POST['position'];
        $position = $request->position;
        $i=1;
        foreach($position as $k=>$v){
        //$sql = "Update sorting_items SET position_order=".$i." WHERE id=".$v;
        //$mysqli->query($sql);
        DB::update('update work_flow_detail set step_number = '.$i.' where id = '.$v.'');
    	$i++;
        }
        return response()->json([$position]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       
        
    }
    public function updateDetail(Request $request){
         
         DB::table('work_flow_detail')->where('id',$request->id_number)
         ->update([
             'step_number' => $request->step_number,
             'status' => $request->status,
             'author' => $request->author,
             'sentBack' => $request->sentBack,
             'check' => $request->check,
             'approve' => $request->approve,
             'reject' => $request->reject,
             'updated_at' =>Carbon::now()
         ]);
         
         return response()->json(['success'=>'Data has been updated.']);
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
