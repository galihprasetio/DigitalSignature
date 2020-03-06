@extends('admin.admin_template')
@section('tittle','Detail Document')
@section('content')

  
{!! Form::close() !!}
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Document</strong></a></li>
      <li><a href="#tab_2" data-toggle="tab"><strong>History Document</strong></a></li>
      <div class="pull-right">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>    
      </div>
      
      
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab_1">
        
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
            {!! Form::open(array('route'=>'documents.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    
            <div class="row">
    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Document Number:</strong>
                        {!! Form::text('doc_number', $document->doc_number, array('placeholder'=>'Document Number','class'=>'form-control','readonly')) !!}
                    </div>
                </div>
    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Document Type:</strong>
                        {!! Form::text('doc_type', $document->doc_type, array('placeholder'=>'Document Type','class'=>'form-control','readonly')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Department:</strong>
                        {!! Form::text('department',$department->department, array('placeholder'=>'','class'=>'form-control','readonly')) !!}
                       
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
                        <strong>Author Document:</strong>
                        {!! Form::text('doc_author', $author->email, array('placeholder'=>'Author Document','class'=>'form-control','readonly')) !!}
    
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
                        <strong>Next Approval:</strong>
                        {!! Form::text('id_users',$document->doc_next_approval, array('placeholder'=>'Next Approval','class'=>'form-control','readonly')) !!}
    
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Subject:</strong>
                        {!! Form::text('doc_subject', $document->doc_subject, array('placeholder'=>'Subject','class'=>'form-control','readonly')) !!}
    
                    </div>
                </div>
    
    
    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {{-- {!! Form::textarea('doc_body', $document->doc_body, array('placeholder'=>'Description','class'=>'form-control','id'=>'doc_body','disabled' => 'true')) !!} --}}
                        {{-- {!! Form::textarea('doc_body', $document->doc_body, ['class' => 'form-control doc_body','id' => 'doc_body','name' => 'doc_body','disabled'=>'true']) !!} --}}
                        {{-- <textarea name="doc_body" id="doc_body" class="form-control" disabled="true">
                            {!! $document->doc_body !!}
                        </textarea> --}}

                        <div>
                            {!! $document->doc_body!!}
                        </div>
                    </div>
    
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>File Attachment:</strong>
                        {{-- {!! Form::file('doc_file',['type'=>'file','class'=>'form-control','name'=>'doc_file']) !!} --}}
                        {!! Form::text('doc_file', $document->doc_file, ['type'=>'file','class'=>'form-control','name'=>'doc_file','readOnly']) !!}
                        {{-- <div id="preview"><img  src="{{asset((isset($document) && $document->doc_file!='')?'storage/'.$document->doc_file:'storage/noimage.jpg')}}" /></div><br> --}}
                    </div>
    
                </div>
    
                
        
                
            </div>
        </div>
    
    
    
          
    
    
    <div class="box-footer">
        <a href="{{route('documents.index')}}" class="btn btn-default"> Back</a>
        
    </div>
    
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
                  {{$item->name}}   <strong> {{$item->activity}}</strong>
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
      
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
@push('script')
<script>
   $('#doc_body').richText({
       
   });    
   
</script>
@endpush
@endsection
