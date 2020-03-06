<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Documents;
use App\Department;
use App\DocumentApproval;
use App\Notifications\NewMessage;
use Illuminate\Support\Facades\Notification;

use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\HistoryDocument;
use PDF;
use App;
use App\WorkFlowDetail;
use Illuminate\Http\Response;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:document-list');
        $this->middleware('permission:document-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:document-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('document.index');
    }
    public function needMyAction(){
        return view('document.needmyaction');
    }
    public function myDocument(){
        return view('document.mydocument');
    }
    public function getData(){
        $document = Documents::join('users','documents.doc_author','=','users.id')
        ->select(['documents.id','documents.doc_number','documents.doc_type','documents.doc_submit_date','users.email as doc_author','documents.doc_status','documents.doc_subject','documents.doc_file','documents.created_at','documents.updated_at']);


      
       return Datatables::of($document)->addColumn('action',function($document){
           return '
           <a href="'.route('documents.show',$document->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
           <a href="'.route('document.printDocument',$document->id).'" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Print</a> 
           ';
       })->addColumn('doc_status',function($document){
           return '
           <button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-tags"></i>'.$document->doc_status.'</button>
           ';
       })->rawColumns(['action','doc_status'])
       
       ->editColumn('documents.updated_at', function ($document) {
        return $document->updated_at->diffForHumans();
        })->filterColumn('documents.updated_at', function ($query, $keyword) {
                 $query->whereRaw("DATE_FORMAT(documents.updated_at,'%Y/% m/%d') like ?", ["%$keyword%"]);
                })     
        ->make(true);
    
    }
    public function getDataNeedMyAction(){
        // $document = Documents::select(['id','doc_number','doc_type','doc_submit_date','doc_author','doc_status','doc_subject','doc_file','created_at','updated_at'])
        // ->where('doc_current_author', Auth::user()->id);
        $document = Documents::join('users','documents.doc_author','=','users.id')
        ->select(['documents.id','documents.doc_number','documents.doc_type','documents.doc_submit_date','users.email as doc_author','documents.doc_status','documents.doc_subject','documents.doc_file','documents.created_at','documents.updated_at'])
        ->where('documents.doc_current_author',Auth::user()->id);

        return Datatables::of($document)->addColumn('action',function($document){
            return '
            <a href="'.route('documents.needAction',$document->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Action</a>
             
            ';
        })->addColumn('doc_status',function($document){
            return '
            <button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-tags"></i>'.$document->doc_status.'</button>
             
            ';
        })
        ->rawColumns(['action','doc_status'])
        ->editColumn('documents.updated_at', function ($document) {
         return $document->updated_at->diffForHumans();
         })->filterColumn('documents.updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(documents.updated_at,'%Y/% m/%d') like ?", ["%$keyword%"]);
                 })  

         ->make(true);
     }
     public function getDataMyDocument(){
        // $document = Documents::select(['id','doc_number','doc_type','doc_submit_date','doc_author','doc_status','doc_subject','doc_file','created_at','updated_at'])
        // ->where('doc_author', Auth::user()->id);
        $document = Documents::join('users','documents.doc_author','=','users.id')
        ->select(['documents.id','documents.doc_number','documents.doc_type','documents.doc_submit_date','users.email as doc_author','documents.doc_status','documents.doc_subject','documents.doc_file','documents.created_at','documents.updated_at'])
        ->where('documents.doc_author',Auth::user()->id);

        return Datatables::of($document)->addColumn('action',function($document){
            return '
            <a href="'.route('documents.show',$document->id).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Detail</a>
             
            ';
        })->addColumn('doc_status',function($document){
            return '
            <button class="btn btn-xs btn-info"><i class="glyphicon glyphicon-tags"></i>'.$document->doc_status.'</button>
             
            ';
        })
        ->rawColumns(['action','doc_status'])
        ->editColumn('documents.updated_at', function ($document) {
         return $document->updated_at->diffForHumans();
         })->filterColumn('documents.updated_at', function ($query, $keyword) {
                  $query->whereRaw("DATE_FORMAT(documents.updated_at,'%Y/% m/%d') like ?", ["%$keyword%"]);
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
        $department = DB::Table('users')
        ->join('department','users.id_department','=','department.id')
        ->select('department.department')
        ->where('users.email',Auth::user()->email)->first();
        $stringdepartment= json_decode( json_encode($department), true);
        $current_author = DB::table('work_flow_detail')
        ->join('work_flow','work_flow_detail.id_work_flow','=','work_flow.id')
        ->join('department','work_flow.name','=','department.id')
        ->select('work_flow_detail.author')
        ->where('department.department',$stringdepartment)
        ->where('work_flow_detail.step_number',1)
        ->first();
        return view('document.create',compact('department','current_author'));
        //print_r($nextApproval);
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
        $this->validate($request,[
            'doc_body' => 'required',
            'doc_type' => 'required'
            
        ]);
        $input = $request->all();
        //$doc_number = DB::select('select generate_doc() as doc_number');  
        $nb = collect(DB::select('SELECT generate_doc() AS nb'))->first()->nb;
        // $doc_status = DB::table('work_flow_detail')
        // ->join('work_flow','work_flow_detail.id_work_flow','=','work_flow.id')
        // ->join('department','work_flow.name','=','department.id')
        // ->select('work_flow_detail.status')
        // ->where('department.department',$input['department'])
        // ->where('work_flow_detail.step_number',1)->first(); 
        // //$string_doc_status= json_decode(json_encode($doc_status), true);
        
       
       
        DB::beginTransaction();

        try {
            if(!empty($input['doc_file'])){
                $input['doc_file'] = time().'.'.$request->doc_file->getClientOriginalExtension();
                $request->doc_file->move(public_path('storage'), $input['doc_file']);
            }else {
                # code...
                $input['doc_file']= null;
            }
            
            Documents::create([
                'doc_number' => $nb,
                'doc_type' =>$input['doc_type'],
                'doc_submit_date' =>Carbon::now(),
                'doc_status_number' => 0,
                'doc_author' => $input['id_author'],
                //'doc_status' => $doc_status->status,
                'doc_subject' => $input['doc_subject'],
                'doc_body' => $input['doc_body'],
                'doc_file' => $input['doc_file']
            ]);
            DB::select('call doc_update_next_approval("'.$input['department'].'",0,"'.$nb.'")');
            $idDoc = DB::table('documents')->select('id','doc_number','doc_author','doc_current_author')->where('doc_number',$nb)->first();
            $idUser = DB::table('users')->select('id')->where('email',$input['doc_author'])->first();
            HistoryDocument::create([
                'id_document' => $idDoc->id,
                'id_user' =>  Auth::user()->id,
                'activity' => 'Submit Document',
                'commentar' => '',
                'activity_date' => Carbon::now()
            ]);
            
            DB::select('call doc_update_document_approval('.$idDoc->id.','.Auth::user()->id.',"Submited Document",now())');
            // send notification using the "Notification" facade
            $to = User::where('id',$idDoc->doc_current_author)->first();
            $fromUser = User::where('id',$idDoc->doc_author)->first();
            $document = Documents::where('id',$idDoc->id)->first();
            
            Notification::send($to, new NewMessage($fromUser,$document));
            
            DB::commit();
            
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('documents.index')
            ->with(['success' => 'Document created successfully', 'class' => 'close']);
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
        $document = Documents::find($id);
        $department = DB::Table('users')
        ->join('department','users.id_department','=','department.id')
        ->select('department.department')
        ->where('users.email',Auth::user()->email)->first();
        $stringdepartment= json_decode( json_encode($department), true);
        // $nextApproval = DB::table('work_flow_detail')
        // ->join('work_flow','work_flow_detail.id_work_flow','=','work_flow.id')
        // ->join('department','work_flow.name','=','department.id')
        // ->select('work_flow_detail.author')
        // ->where('department.department',$stringdepartment)
        // ->where('work_flow_detail.step_number',1)//$document->doc_status_number
        // ->first();
        $author = DB::table('users')
        ->join('documents','users.id','=','documents.doc_author')
        ->select('users.email')
        ->where('documents.id',$id)->first();
        $historyDocuments = DB::table('history_document')
        ->join('users','history_document.id_user','=','users.id')
        ->join('documents','history_document.id_document','=','documents.id')
        ->select('users.name','history_document.activity','history_document.commentar','history_document.activity_date','users.image')
        ->where('documents.id',$document->id)->get();
        return view('document.show',compact('document','department','historyDocuments','author'));
        //return $nextApproval->author;

    }
    /**
     * Display the need action form.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function needAction($id){
        $document = Documents::find($id);
        $this->authorizeForUser(Auth::user(), 'show', [$document]);
        
        $document = Documents::find($id);
        $department = DB::Table('users')
        ->join('department','users.id_department','=','department.id')
        ->select('department.department')
        ->where('users.email',Auth::user()->email)->first();
       
        if ($document->doc_status_number == 0) {
            # code...
            $document->doc_status_number = 1;
        }
        $button = collect(DB::select('select `wfd`.`sentBack`,wfd.`check`,wfd.`approve`,wfd.`reject`
        from work_flow_detail wfd
        left join work_flow wf
        on wfd.id_work_flow = wf.id
        left join department d
        on `wf`.name = d.id
        where d.`department` = "'.$department->department.'"
        and wfd.step_number = '.$document->doc_status_number.''))->first();
        if(empty($button)){
            $button = new WorkFlowDetail;
            $button->sentBack = null;
            $button->check = null;
            $button->approve = null;
            $button->reject = null;
        }
        
       
        //$stringdepartment= json_decode( json_encode($department), true);
        $nextApproval = DB::table('work_flow_detail')
        ->join('work_flow','work_flow_detail.id_work_flow','=','work_flow.id')
        ->join('department','work_flow.name','=','department.id')
        ->select('work_flow_detail.author')
        ->where('department.department',$department->department)
        ->where('work_flow_detail.step_number',$document->doc_status_number)
        ->first();
        if(empty($nextApproval)){
            $nextApproval = new User;
            $nextApproval->author = null;
        }
        $user = DB::table('users')->where('id',$document->doc_author)->first();
        $current_author = DB::table('users')->where('email',$nextApproval->author)->first();
        //History Documents
        $historyDocuments = DB::table('history_document')
        ->join('users','history_document.id_user','=','users.id')
        ->join('documents','history_document.id_document','=','documents.id')
        ->select('users.name','history_document.activity','history_document.commentar','history_document.activity_date','users.image')
        ->where('documents.id',$document->id)->get();
       
        return view('document.needaction',compact('user','document','nextApproval','department','button','historyDocuments'));
        
        
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
     * Update Document insert commentar.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sentBack(Request $request){
            DB::beginTransaction();
            try {
                //code...
                

                $input = $request->all();
                $idDoc = DB::table('documents')->select('id','doc_author','doc_current_author','doc_number')->where('id',$input['id'])->first();
                
                DB::Table('documents')->where('id',$input['id'])->update(array('updated_at'=> Carbon::now(),'doc_status_number' => 0,'doc_status'=>'Sent Back Document'));
                DB::select('update documents set doc_current_author = doc_author where doc_number = "'.$idDoc->doc_number.'"');
                HistoryDocument::create([
                    'id_document' => $idDoc->id,
                    'id_user' =>  Auth::user()->id,
                    'activity' => 'Sent Back Document',
                    'commentar' => $input['commentar'],
                    'activity_date' => Carbon::now()
                ]);
                 // send notification using the "Notification" facade
                
                $to = User::where('id',$idDoc->doc_author)->first();
                $fromUser = User::where('id',$idDoc->doc_current_author)->first();
                $document = Documents::where('id',$idDoc->id)->first();
                Notification::send($to, new NewMessage($fromUser,$document));
                DB::commit();
                //return $to;
                // DB::rollback();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
            return redirect()->route('documents.needMyAction')->with(['success'=>'Data has been updated','class' => 'close']);
    }
    /**
     *
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $document = Documents::where('doc_number',$request->doc_number)->first();
        $total_approval = collect(DB::select('select count(*) as total_approval from work_flow_detail wfd
        left join work_flow wf
        on wfd.`id_work_flow`= wf.id
        left join department d
        on wf.name = d.`id`
        where d.department ="'.$request->department.'"'))->first();
        //$total_approval = json_decode( json_encode($total_approval), true);
        

        DB::beginTransaction();
        try {
            //code...

            DB::select('call doc_update_next_approval("'.$request->department.'","'.$document->doc_status_number.'","'.$request->doc_number.'")');
            if ($document->doc_status_number == 0 ) {
                # code...
                $status = 'Submit Document';
            } elseif ($document->doc_status_number < $total_approval->total_approval) {
                # code...
                $status = 'Checked Document';
            }else {
                # code...
                $status = 'Approved Document';
            }
             
            
            HistoryDocument::create([
                'id_document' => $request->id,
                'id_user' =>  Auth::user()->id,
                'activity' => $status,
                'commentar' => '',
                'activity_date' => Carbon::now()
            ]);
            DB::select('call doc_update_document_approval('.$document->id.','.Auth::user()->id.',"'.$status.'",now())');
             // send notification using the "Notification" facade
            $notif = collect(DB::select('select wfd.author from work_flow_detail wfd
            left join `work_flow` wf
            on wf.`id` = wfd.`id_work_flow`
            left join `department` d
            on `wf`.name = d.id
            where d.department = "'.$request->department.'"
            and wfd.`step_number` = '.$request->doc_status_number.' +  1'))->first();
            
            if ($total_approval->total_approval == $request->doc_status_number) {
                $to = User::where('email',$request->doc_author)->first(); // sent to author document
                $fromUser = User::where('email',$request->id_users)->first(); // from doc_next_approval
            }else {
                $to = User::where('email',$notif->author)->first(); // sent to next approval
                $fromUser = User::where('email',$request->id_users)->first(); // from ndoc_ext_approval
            }
            Notification::send($to, new NewMessage($fromUser,$document));
           
            DB::commit();
            
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
       return redirect()->route('documents.needMyAction')->with(['success'=>'Data has been updated','class' => 'close']);
    }
    public function update_ajax(Request $request)
    {
        
        //return response()->json($request->doc_file);
        DB::beginTransaction();
        try {
            //code...
            HistoryDocument::create([
                'id_document' => $request->id,
                'id_user' =>  Auth::user()->id,
                'activity' => 'Modified Document',
                'commentar' => '',
                'activity_date' => Carbon::now()
            ]);
          
           Documents::where('id',$request->id)
           ->update([
           'doc_type' => $request->doc_type,
           'doc_subject' => $request->doc_subject,
           'doc_body' => $request->doc_body
           
           ]);
         DB::commit();
            
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
        flash('Data has been updated')->success();
        // return response()->json(['data has been updated']);
       
       //return redirect()->route('documents.needMyAction');
        
       
        
    }
    public function reject(Request $request){
        DB::beginTransaction();
        try {
            $input = $request->all();
            $idDoc = DB::table('documents')->select('id','doc_author','doc_current_author','doc_number')->where('id',$input['id'])->first();
            DB::Table('documents')->where('id',$input['id'])->update(array('updated_at'=> Carbon::now(),'doc_status_number' => -1,'doc_status'=>'Reject Document'));
            DB::select('update documents set doc_current_author = doc_author where doc_number = "'.$idDoc->doc_number.'"');

            HistoryDocument::create([
                'id_document' => $request->id,
                'id_user' =>  Auth::user()->id,
                'activity' => 'Reject Document',
                'commentar' => $input['commentar'],
                'activity_date' => Carbon::now()
            ]);
            $to = User::where('id',$idDoc->doc_author)->first();
                $fromUser = User::where('id',$idDoc->doc_current_author)->first();
                $document = Documents::where('id',$idDoc->id)->first();
                Notification::send($to, new NewMessage($fromUser,$document));
                DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        return redirect()->route('documents.needMyAction')->with(['success'=>'Data has been Rejected','class' => 'close']);
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
    public function printDocument($id){
     $document = DB::table('documents')
     ->join('users','documents.doc_author','=','users.id')
     ->select('documents.doc_number','users.id_department','documents.doc_type','documents.doc_submit_date','users.name','documents.doc_status','documents.doc_subject','documents.doc_body')
     ->where('documents.id',$id)->first();
     $approval = DB::table('document_approval')
     ->join('documents','document_approval.id_document','=','documents.id')
     ->join('users','document_approval.id_user','=','users.id')
     ->select('users.name','document_approval.status','document_approval.date_action','users.sign')
     ->where('documents.id',$id)->get();
     $user = DB::table('users')
     ->join('documents','users.id','=','documents.doc_author')
     ->join('department','users.id_department','=','department.id')
     ->join('section','users.id_section','=','section.id')
     ->select('users.name','users.email','department.department','section.section','users.tittle','users.position','users.sign')
     ->where('documents.id',$id)->first();

    
    //$pdf = App::make('dompdf');
     //$pdf = PDF::loadView('document.pdf',compact('document','user','approval'));
     //return $pdf->download('itsolutionstuff.pdf');
    //return $pdf->stream('print.pdf');
    return view('document.pdf',compact('document','user','approval'));
    //return $document->name;
    }
}
