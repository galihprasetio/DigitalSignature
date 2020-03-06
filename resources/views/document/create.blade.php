@extends('admin.admin_template')
@section('tittle','Create Document')
@section('content')

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong> New Document</strong></a></li>
      {{-- <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><strong> History Document</strong></a></li> --}}
      
      
      <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
    <!-- /.box-tools -->
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="tab_1">
        {{-- <div class="box"> --}}
            
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
                {!! Form::open(array('route'=>'documents.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        
                <div class="row">
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Document Number:</strong>
                            {!! Form::text('doc_number', null, array('placeholder'=>'Document Number','class'=>'form-control','readonly')) !!}
                        </div>
                    </div>
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Document Type:</strong>
                            {!! Form::text('doc_type', null, array('placeholder'=>'Document Type','class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Department:</strong>
                            {!! Form::text('department',$department->department, array('placeholder'=>'','class'=>'form-control','readonly')) !!}
                            {{-- <input type="text" name="department" id="department" value={{$users->id_department}} class='form-control'> --}}
                        </div>
                    </div>
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Submit Date:</strong>
                            {!! Form::text('doc_submit_date', ''.date('d-m-Y H:i:s').'', array('placeholder'=>'Submit Date','class'=>'form-control','readonly')) !!}
        
                        </div>
                    </div>
        
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Requestor Document:</strong>
                            {!! Form::hidden('id_author', ''.Auth::user()->id.'', []) !!}
                            {!! Form::text('doc_author', ''.Auth::user()->email.'', array('placeholder'=>'Author Document','class'=>'form-control','readonly')) !!}
        
                        </div>
                    </div>
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Document Status:</strong>
                            {!! Form::text('doc_status', 'Draft', array('placeholder'=>'Author Document','class'=>'form-control','readonly')) !!}
        
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Current Author:</strong>
                            {!! Form::text('id_users', $current_author->author, array('placeholder'=>'Next Approval','class'=>'form-control','readonly')) !!}
        
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Subject:</strong>
                            {!! Form::text('doc_subject', null, array('placeholder'=>'Subject','class'=>'form-control')) !!}
        
                        </div>
                    </div>
        
        
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{-- {!! Form::textarea('doc_body', null, array('class'=>'form-control','id'=>'doc_body')) !!} --}}
                            {{-- <div id="doc_body">
                                        
                            </div> --}}
                            {!! Form::textarea('doc_body', null, ['class' => 'form-control doc_body','id' => 'doc_body','name' => 'doc_body','readOnly']) !!}
        
                        </div>
        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>File Attachment:</strong>
                            {!! Form::file('doc_file', ['type'=>'file','class'=>'form-control','name'=>'doc_file']) !!}
        
                        </div>
        
                    </div>
        
                    
            
                    
                </div>
            </div>
        
        
        
              
        
        
        <div class="box-footer">
            <a href="{{route('documents.index')}}" class="btn btn-default"> Back</a>
            <button type="submit" class="btn btn-primary pull-right"> Submit</button>
        </div>
        </div>
        {!! Form::close() !!}
      {{-- </div> --}}
      <!-- /.tab-pane -->
      {{-- <div class="tab-pane" id="tab_2">
        <table id="history-documebt" class="table table-bordered">
            <thead>
                <tr>
                    
                    <th>User</th>
                    <th>Activity</th>
                    <th>Commentar</th>
                    <th>Activity Date</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>

        </table>
      </div> --}}
      <!-- /.tab-pane -->
      
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
@push('script')
<script>
$('.doc_body').richText({
    
});

</script>
@endpush
@endsection
