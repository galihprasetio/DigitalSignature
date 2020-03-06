@extends('admin.admin_template')
@section('tittle','Create Department')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Create New Work Flow</h3>
        <div class="box-tools pull-right">

                <!-- Collapse Button -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="box-body">
        {!! Form::open(['id'=>'productForm','name'=>'productForm']) !!}
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name Department:</strong>
                    {{-- {!! Form::text('name', null, array('placeholder'=>'Fill Name','class'=>'form-control','id'=>'name','name'=>'name')) !!} --}}
                    {!! Form::select('name', $department, $department, ['placeholder'=>'Fill name department','class'=>'form-control','id'=>'name','name'=>'name']) !!}
                </div>

            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="button" class="btn btn-success pull-right btn-addDetail" data-toggle="modal" data-target="#modalDetailWorkFlow"><i class="glyphicon glyphicon-plus"></i> Add Flow</button>
            </div>
        

        <div class="col-xs-12 col-sm-12 col-md-12">
        <table id="department-table" class="table table-bordered table-detailFlow">
            <thead>
                <tr>
                    <th>Step Number</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>SentBack</th>
                    <th>Check</th>
                    <th>Approve</th>
                    <th>Reject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>

        </table>
    </div>
        </div>
    </div>
  
    <div class="box-footer">
        <a href="{{ route('workflow.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn  pull-right btn-primary btn-addFlow"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
  <!-- Modal -->
  <div id="modalDetailWorkFlow" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Insert Flow</h4>
        </div>
        <div class="modal-body">
            <form name="detailWorkFlow" id="detailWorkFlow"method="post">
                <div class="form-group">
                        <strong>Step Number:</strong>
                        {!! Form::number('step_number', null,array('placeholder'=>'Fill','class'=>'form-control','id'=>'step_number','required'=>'required','data-validation'=>'step_number', 'data-validation-error-msg'=>'You did not enter a valid step_number')) !!}
                        {{-- {!! Form::select('step_number', [1,2,3,4,5,6,7,8,9,10], 'step_number', ['placeholder'=>'select number','class'=>'form-control','id'=>'step_number']) !!}                         --}}
                    </div>
                    <div class="form-group">
                        <strong>Status:</strong>
                        {!! Form::text('status', null, array('placeholder'=>'Fill','class'=>'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Author:</strong>
                        {!! Form::select('author',['placeholder'=>''],null,['class'=>'form-control','id'=>"author",'name'=>'author','style'=>'width: 100%']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Authority to Sent Back:</strong>
                        {!! Form::select('sentBack', ['False','True'], 'sentBack', ['placeholder'=>'Select Status','class'=>'form-control','name'=>'sentBack','id'=>'sentBack']) !!}
                        
                    </div>
                    <div class="form-group">
                        <strong>Authority to Check:</strong>
                        {!! Form::select('check', ['False','True'], 'check', ['placeholder'=>'Select Status','class'=>'form-control','name'=>'check','id'=>'check']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Authority to Approve:</strong>
                        {!! Form::select('approve', ['False','True'], 'approve', ['placeholder'=>'Select Status','class'=>'form-control','name'=>'approve','id'=>'approve']) !!}
                    </div>
                    <div class="form-group">
                        <strong>Authority to Reject:</strong>
                        {!! Form::select('reject', ['False','True'], 'reject', ['placeholder'=>'Select Status','class'=>'form-control','name'=>'reject','id'=>'reject']) !!}
                    </div>
                    <p id="demo"></p>
                    
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn pull-right btn-primary btn-kirim" onclick="addDetail()">Save</button>
        </form>
        </div>
      </div>
  
    </div>
  </div>
@push('script')
<script src="{{asset('js/parseTable.js')}}"></script>

<script type="text/javascript">
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".btn-addFlow").click(function(e){
        e.preventDefault();
        var name = document.getElementById('name');
        if (name.value == "")                                  
    { 
        window.alert("Please fill Flow Name."); 
        name.focus(); 
        return false; 
    } 
        var table = document.querySelector(".table-detailFlow");
        var data  = parseTable(table);
        var jsonString = JSON.stringify(data);
       var input = $('#productForm').serialize();
        console.log(data);
        $.ajax({
           url:'{{route('workflow.simpan')}}',
           type: "POST",
           dataType: 'json',
           //data:"sendData="+jsonString,
           //data:"pTableData=" + data,+"&name="+input
           data: "sendData=" +jsonString +"&name="+input,
           success:function(data){
              alert(data.success);
              window.location = '{{route('workflow.index')}}';
           }
        });
	});

    $("form").submit(function(e){
    e.preventDefault();
    var step = document.getElementById('step_number');
    var status = $("input[name='status']").val();
    var author =  document.getElementById('author');
    var sentBack = document.getElementById('sentBack');
    var check = document.getElementById('check');
    var approve = document.getElementById('approve');
    var reject = document.getElementById('reject');
    $("#department-table tbody").append("<tr data-step-number='"+step.value+"' data-status='"+status+"' data-author='"+author.value+"' data-sentback='"+sentBack.value+"' data-check='"+check.value+"' data-approve='"+approve.value+"' data-reject='"+reject.value+"'><td>"+step.value+"</td><td>"+status+"</td><td>"+author.value+"</td><td>"+sentBack.value+"</td><td>"+check.value+"</td><td>"+approve.value+"</td><td>"+reject.value+"</td><td><button class='btn btn-default btn-xs btn-delete'><i class='glyphicon glyphicon-edit'></i> Delete</button></td></tr>");    
    
    $("input[name='status']").val('');
    $('#author').val(null).trigger('change');
    document.getElementById("step_number").value = "";
    document.getElementById("sentBack").value = "";
    document.getElementById("check").value = "";
    document.getElementById("approve").value = "";
    document.getElementById("reject").value = "";
    var table = document.querySelector("table");
    var data = parseTable(table);
    console.log(data);
    $('#modalDetailWorkFlow').modal('toggle');

});
function addDetail(){
    var step_number = document.forms["detailWorkFlow"]["step_number"]; 
    var status = document.forms["detailWorkFlow"]["status"]; 
    var author =  document.forms["detailWorkFlow"]["author"]; 
    var sentBack = document.forms["detailWorkFlow"]["sentBack"]; 
    var check = document.forms["detailWorkFlow"]["check"]; 
    var approve = document.forms["detailWorkFlow"]["approve"]; 
    var reject = document.forms["detailWorkFlow"]["reject"]; 
    if (step_number.value == "")                                  
    { 
        window.alert("Please fill step_number."); 
        step_number.focus(); 
        return false; 
    } 
    if (status.value == "")                                  
    { 
        window.alert("Please fill status."); 
        status.focus(); 
        return false; 
    }
    if (author.value == "")                                  
    { 
        window.alert("Please fill author."); 
        author.focus(); 
        return false; 
    }
    if (sentBack.value == "")                                  
    { 
        window.alert("Please fill sent back."); 
        sentBack.focus(); 
        return false; 
    }
    if (check.value == "")                                  
    { 
        window.alert("Please fill check."); 
        check.focus(); 
        return false; 
    }
    if (approve.value == "")                                  
    { 
        window.alert("Please fill approve."); 
        approve.focus(); 
        return false; 
    }
    if (reject.value == "")                                  
    { 
        window.alert("Please fill reject."); 
        reject.focus(); 
        return false; 
    }
    document.getElementById('step_number').selectedIndex = -1;
    var step = document.getElementById('step_number');
    var status = $("input[name='status']").val();
    var author =  document.getElementById('author');
    var sentBack = document.getElementById('sentBack');
    var check = document.getElementById('check');
    var approve = document.getElementById('approve');
    var reject = document.getElementById('reject');
    $("#department-table tbody").append("<tr data-step-number='"+step.value+"' data-status='"+status+"' data-author='"+author.value+"' data-sentback='"+sentBack.value+"' data-check='"+check.value+"' data-approve='"+approve.value+"' data-reject='"+reject.value+"'><td>"+step.value+"</td><td>"+status+"</td><td>"+author.value+"</td><td>"+sentBack.value+"</td><td>"+check.value+"</td><td>"+approve.value+"</td><td>"+reject.value+"</td><td><button class='btn btn-default btn-xs btn-delete'><i class='glyphicon glyphicon-edit'></i> Delete</button></td></tr>");    
    document.getElementById("step_number").value = "";
    $("input[name='status']").val('');
    $('#author').val(null).trigger('change');
    document.getElementById("sentBack").value = "";
    document.getElementById("check").value = "";
    document.getElementById("approve").value = "";
    document.getElementById("reject").value = "";
    
    $('#modalDetailWorkFlow').modal('toggle');

    
}




$("body").on("click", ".btn-delete", function(){
        $(this).parents("tr").remove();
        
    });

        //select2
        $("#author").select2().select2("val", null);
        $('#author').select2({
        allowClear: true,
        placeholder: 'Search...',

        ajax: {
        url: '{{url('workflow.getuser')}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.email,
                id: item.email
            }
          })
        };
        },
        cache: true
         }
        });  
$(".btn-addDetail").click(function(e){
    e.preventDefault();
    document.getElementById('name').readOnly = true;
   // alert("btn add detail");
});  
</script>
@endpush
@endsection