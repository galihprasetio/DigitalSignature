@extends('admin.admin_template')
@section('tittle','Create Department')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Edit Work Flow</h3>
        <div class="box-tools pull-right">

                <!-- Collapse Button -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
    </div>
   
    <div class="box-body">
        {!! Form::open(['id'=>'productForm','name'=>'productForm']) !!}
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', $department->department, array('placeholder'=>'Fill Name','class'=>'form-control','id'=>'name','name'=>'name','readonly')) !!}
                </div>

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
            <tbody class="row_position">
                    @foreach ($workFlowDetail as $item)
                <tr id="{{$item->id}}">
                
                    <td>{{ $item->step_number }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->author }}</td>
                    <td><input type="checkbox" {{ isset($item->sentBack) && $item->sentBack != 0 ? 'checked':''  }} disabled="true"></td>
                    <td><input type="checkbox" {{ isset($item->sentBack) && $item->check != 0 ? 'checked':''  }} disabled="true"></td>
                    <td><input type="checkbox" {{ isset($item->sentBack) && $item->approve != 0 ? 'checked':''  }} disabled="true"></td>
                    <td><input type="checkbox" {{ isset($item->sentBack) && $item->reject != 0 ? 'checked':''  }} disabled="true"></td>
                    {{-- <td><button type="button" class="btn btn-xs btn-default btnEditDetail" data-toggle="modal" data-target="#modalDetailWorkFlow"><i class="glyphicon glyphicon-edit"></i> Edit</button></td> --}}
                    <td><a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-original-title="Edit" class="btn btn-xs btn-default btnEditDetail"><i class="glyphicon glyphicon-edit"></i>Edit</a></td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>
        </div>
    </div>
  
    <div class="box-footer">
        <a href="{{ route('workflow.index')}}" class="btn btn-default"> Back</a>
        <a href="{{ route('workflow.index')}}" class="btn pull-right btn-primary"> Save</a>
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
          <h4 class="modal-title">Update Flow</h4>
        </div>
        <div class="modal-body">
            <form name="detailWorkFlow" id="detailWorkFlow" method="PATCH">
                
                <div class="form-group">
                        <strong>Step Number:</strong>
                        {!! Form::hidden('id_number', null, ['id'=>'id_number','name'=>'id_number']) !!}
                        {!! Form::number('step_number', null,array('placeholder'=>'Fill','class'=>'form-control','id'=>'step_number','required'=>'required','data-validation'=>'step_number', 'data-validation-error-msg'=>'You did not enter a valid step_number')) !!}
                        
                    </div>
                    <div class="form-group">
                        <strong>Status:</strong>
                        {!! Form::text('status', null, array('placeholder'=>'Fill','class'=>'form-control','id'=>'status','name'=>'status')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Author:</strong>
                        
                    </br>
                        {!! Form::select('author',[],'author',['class'=>'form-control','id'=>"author",'name'=>'author','style'=>'width: 100%']) !!}
                        {{-- <select name="author" id="author" class="form-control" style="width:100%">
                            <option value="">Select author</option>
                            @foreach ($author as $item)
                                <option value="{{$item->email}}" {{$item->email? 'selected':''}}>{{$item->email}}</option>
                            @endforeach
                        </select> --}}
                        
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
                    
                    
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn pull-right btn-primary" id="btn-update">Update</button>
        </form>
        </div>
      </div>
  
    </div>
  </div>
@push('script')
<script src="{{asset('js/parseTable.js')}}"></script>

<script type="text/javascript">
    $( ".row_position" ).sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
    });
    function updateOrder(data) {
        $.ajax({
            url:'{{route('workflow.editSort')}}',
            type:'POST',
            data:{position:data},
            success:function(data){
                //alert('your change successfully saved');
                //alert(data);
                location.reload();
            }
        })
    }

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
    
    /* When click edit flow */
    $('body').on('click', '.btnEditDetail', function () {
        var id = $(this).data('id');
        
        $.get('../editDetail/'+ id +'', function (data) {    
            //alert(data.status);
           // $('#modalDetailWorkFlow').html("Edit Flow");
            $('#btn-kirim').val("Update");
            $('#modalDetailWorkFlow').modal('show');
            $('#id_number').val(id);
            $('#step_number').val(data.step_number);
            $('#status').val(data.status);
            $('#currentAuthor').val(data.author);
            $('#author').val(data.author);
            $('#sentBack').val(data.sentBack);
            $('#approve').val(data.approve);
            $('#check').val(data.check);
            $('#reject').val(data.reject);
        })   
      });
    //Update data
    $('#btn-update').click(function (e) {
    e.preventDefault();
    var author = document.getElementById('author');
        if (author.value == "")                                  
    { 
        window.alert("Please fill author."); 
        author.focus(); 
        return false; 
    } 
    
    $.ajax({
        data: $('#detailWorkFlow').serialize(),
        url: "{{ route('workflow.updateDetail') }}",
        type: "PATCH",
        dataType: 'json',
        success: function (data) {
    
           $('#detailWorkFlow').trigger("reset");
           $('#modalDetailWorkFlow').modal('hide');
           
            //alert(data);
           location.reload(); 
        
        },
        error: function (data) {
            console.log('Error:', data);
            $('#btn-update').html('Save Changes');
        }
        });
    }); 
      
    //select2
   // $("#author").select2().select2("val", null);
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