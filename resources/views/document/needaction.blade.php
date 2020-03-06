@extends('admin.admin_template')
@section('tittle','Action Document')
@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong> Document </strong></a></li>
      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong> History Document </strong></a></li>
      
      <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>

    </div>
      
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab_1">
        {{-- <div class="box"> --}}
    
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="box-body">
        
        {!! Form::model($document, ['method' => 'PATCH','route' => ['documents.update',$document->id],'enctype'=>'multipart/form-data','id'=>'document']) !!}
        {{-- {!! Form::open(['id'=>'document','name'=>'document']) !!} --}}
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Document Number:</strong>
                    {!! Form::text('doc_number', $document->doc_number, array('placeholder'=>'Document Number','class'=>'form-control','readonly')) !!}
                    {{-- {!! Form::text('doc_step_number', $document->doc_status_number, array('placeholder'=>'Document Number','class'=>'form-control','readonly')) !!} --}}
                    {!! Form::hidden('doc_status_number', $document->doc_status_number, ['placeholder' => 'Doc Status number','class'=>'form-control','readonly']) !!}
                    {!! Form::hidden('id', $document->id, ['placeholder' => 'Doc Status number','class'=>'form-control','readonly']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Document Type:</strong>
                    {!! Form::text('doc_type', $document->doc_type, array('placeholder'=>'Document Type','class'=>'form-control','id'=>'doc_type')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    {!! Form::text('department',$department->department, array('placeholder'=>'','class'=>'form-control','readonly','id'=>'department')) !!}
                   
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Submit Date:</strong>
                    {!! Form::text('doc_submit_date',$document->doc_submit_date, array('placeholder'=>'Submit Date','class'=>'form-control','readonly')) !!}

                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Requestor Document:</strong>
                    {!! Form::text('doc_author', $user->email, array('placeholder'=>'Author Document','class'=>'form-control','readonly')) !!}

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Document Status:</strong>
                    {!! Form::text('doc_status', $document->doc_status, array('placeholder'=>'Author Document','class'=>'form-control','readonly')) !!}

                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Current Author:</strong>
                    {!! Form::hidden('id_current_author',null, []) !!}
                    {!! Form::text('id_users',$nextApproval->author, array('placeholder'=>'Next Approval','class'=>'form-control','readonly')) !!}

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject:</strong>
                    {!! Form::text('doc_subject', $document->doc_subject, array('placeholder'=>'Subject','class'=>'form-control','id'=>'doc_subject')) !!}

                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    
                    @if ($document->doc_status_number == 0 && $document->doc_status == 'Sent Back Document')
                        {!! Form::textarea('doc_body', $document->doc_body, array('placeholder'=>'Description','class'=>'form-control','id'=>'doc_body')) !!}
                    @else
                    <div id="doc_body">
                      {!! $document->doc_body !!}
                    </div>
                    @endif
                    

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>File Attachment:</strong>
                    {!! Form::file('doc_file',['type'=>'file','class'=>'form-control','name'=>'doc_file','id'=>'doc_file']) !!}
                    {{-- {!! Form::file('doc_file', $document->doc_file, ['type'=>'file','class'=>'form-control','name'=>'doc_file','id'=>'doc_file']) !!} --}}
                    {{-- <div id="preview"><img  src="{{asset((isset($document) && $document->doc_file!='')?'storage/'.$document->doc_file:'storage/noimage.jpg')}}" /></div><br> --}}
                </div>

            </div>

            
            
            
        </div>
    </div>
    {!! Form::close() !!} 
        <div class="box-footer">
        <a href="{{route('documents.needMyAction')}}" class="btn btn-default"> Back</a>
        
        <div class="pull-right">
        @if ($document->doc_status_number == 1 && $document->doc_status == 'Sent Back Document')
            <button class="btn btn-warning" id="btnEdit" onclick="btnEdit()"><i class="glyphicon glyphicon-edit"></i>  Edit</button>
            <button class="btn btn-primary" id="btnSave" onclick="btnSave()"><i class="glyphicon glyphicon-floppy-saved"></i>  Save</button>
            <button type="submit" class="btn btn-primary" id="btnSubmit"><i class="glyphicon glyphicon-send" style="hidden"></i>  Submit</button>
        @else
            @if ($button->sentBack == 1 && $document->doc_status !== 'Sent Back Document')
            <button class="btn btn-warning" data-toggle="modal" data-target="#commentarSentBack"><i class="glyphicon glyphicon-menu-left"></i> SentBack</button>
            @endif
            @if ($button->check == 1)
            <button type="submit" class="btn btn-success" id="btnCheck"><i class="glyphicon glyphicon-check"></i>Check</button>
            @endif
            @if ($button->approve == 1)
            <button  type="submit" class="btn btn-primary" id="btnApprove"><i class="glyphicon glyphicon-check"></i>Approve</button>
            @endif
            @if ($button->reject == 1)
            <button  class="btn btn-danger" id="btnReject" data-toggle="modal" data-target="#commentarreject" ><i class="glyphicon glyphicon-remove"></i>Reject</button>
            @endif
        @endif
        
        
        </div>
    </div>

    {{-- </div> --}}
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2">
        {{-- commentar --}}
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: auto;">
                <!-- chat item -->
                @foreach ($historyDocuments as $item)
                    
               
                <div class="item">
                  <img src="{{asset((isset($item->image) && $item->image!='')?'storage/'.$item->image:'storage/noimage.jpg')}}">
                  
                  <p class="message">
                    <a href="#" class="name">
                      <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$item->activity_date}}</small>
                      {{$item->name}} <strong><td>{{$item->activity}}</td></strong>
                    </a>
                    
                  </p>
                  <div class="attachment">
                    {{-- <h4>Attachments:</h4>
    
                    <p class="filename">
                      Theme-thumbnail-image.jpg
                    </p>
    
                    <div class="pull-right">
                      <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                    </div> --}}
                    {{-- {{$item->commentar}} --}}
                    {{isset($item->commentar) && $item->commentar!=''?$item->commentar:'No commentar'}}
                  </div>
                  <!-- /.attachment -->
                </div>
                <!-- /.item -->
                @endforeach
              </div>
              <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 184.911px;">
            </div>
            <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
            </div>
        </div>
    
    
            {{-- end commentar --}}
      </div>
      <!-- /.tab-pane -->
     
    </div>
    <!-- /.tab-content -->
  </div>
</div>



      

  


{{-- Modal Comentar sentBack --}}
{!! Form::open(array('route'=>'documents.sentBack','method'=>'POST')) !!}
<div id="commentarSentBack" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Commentar</h4>
            </div>
            <div class="modal-body">
              {{-- {!! Form::text('id', $document->id, ['class'=>'form-control','type'=>'hidden']) !!} --}}
              <input type="hidden" name="id" id="id" value={{$document->id}}>
              <input type="hidden" name="doc_author" id="doc_author" value={{$document->doc_author}}>
              {{-- {!! Form::text('doc_author', $document->doc_author, ['class'=>'form-control','type'=>'hidden']) !!} --}}
              {!! Form::textarea('commentar', null, ['class'=>'form-control']) !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
              {{-- <a href="{{route('documents.sentBack')}}" class="btn btn-primary">Save</a> --}}
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
{!! Form::close() !!}

{{-- Modal Comentar reject --}}
{!! Form::open(array('route'=>'documents.reject','method'=>'POST')) !!}
<div id="commentarreject" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Commentar</h4>
            </div>
            <div class="modal-body">
              {{-- {!! Form::text('id', $document->id, ['class'=>'form-control','type'=>'hidden']) !!} --}}
              <input type="hidden" name="id" id="id" value={{$document->id}}>
              <input type="hidden" name="doc_author" id="doc_author" value={{$document->doc_author}}>
              {{-- {!! Form::text('doc_author', $document->doc_author, ['class'=>'form-control','type'=>'hidden']) !!} --}}
              {!! Form::textarea('commentar', null, ['class'=>'form-control']) !!}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
              {{-- <a href="{{route('documents.sentBack')}}" class="btn btn-primary">Save</a> --}}
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
{!! Form::close() !!}
@push('script')

<script>
      $(document).ready(function(){
        $('#doc_type').attr("disabled", true);
        $('#doc_subject').attr("disabled", true);
        $('#doc_body').attr("disabled", true);
        $('#doc_file').attr("disabled", true);
      });
      function btnEdit(){
          
        
        $('#doc_type').attr("disabled", false);
        $('#doc_subject').attr("disabled", false);
        $('#doc_body').attr("disabled", false);
        $('#doc_file').attr("disabled", false);
        document.getElementById("btnSubmit").disabled = false;
        document.getElementById("btnSave").disabled = false;
    }
  
     $(function(){
      $('#btnSubmit').on('click', function(){
          $('#document').submit();
      });
      $('#btnCheck').on('click',function(){
          $('#document').submit();
      });
      $('#btnApprove').on('click',function(){
          $('#document').submit();
      });
      
      
      document.getElementById("btnSubmit").disabled = true;
      document.getElementById("btnSave").disabled = true;
      $('#doc_type').attr("disabled", true);
      $('#doc_subject').attr("disabled", true);
      $('#doc_body').attr("disabled", true);
      $('#doc_file').attr("disabled", true);
      $('#doc_body').richText();
      
     });
    function btnSave(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      /* Get from elements values */
      //var $form = $('#document');
      //var data = $form.serialize();
     var doc_type = document.getElementById("doc_type").value;
     var doc_subject = document.getElementById("doc_subject").value;
     var doc_body = document.getElementById("doc_body").value;
     var doc_file = document.getElementById('doc_file').value;
     var id = document.getElementById('id').value;
     var param = "doc_type="+doc_type+"&doc_subject="+doc_subject+"&doc_body="+doc_body+"&doc_file="+doc_file+"&id="+id;
      
      $.ajax({
            url: "{{route('documents.update_ajax')}}",
            type: "POST",
            data: param ,
            success: function (response) {
              document.location.href = "{{route('documents.index')}}";
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    
    
</script>


@endpush
@endsection
