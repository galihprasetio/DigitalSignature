@extends('admin.admin_template')
@section('tittle','Create Flow')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle">Create New Flow</h3>
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
        {!! Form::open(array('route'=>'flow.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Doc:</strong>
                    {!! Form::text('id_doc', null, array('placeholder'=>'ID Document','class'=>'form-control')) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                <div class="form-group">
                    <a href="" class="btn btn-success pull-right">Add</a>
                </div>
                <table id="department-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Department</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <td>1</td>
                        <td>I.T</td>
                        <td>2019.05.06</td>
                        <td>2009.05.06</td>
                        <td>Submited</td>
                    </tbody>
                    
                </table>
            </div>
        
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Step Number:</strong>
                    {!! Form::text('step_number', null, array('placeholder'=>'Step Number','class'=>'form-control')) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Author:</strong>
                    {!! Form::text('author', null, array('placeholder'=>'Author','class'=>'form-control')) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status Number:</strong>
                    {!! Form::Number('status_number', null, array('placeholder'=>'Status Number','class'=>'form-control')) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    {!! Form::text('status', null, array('placeholder'=>'Status Document','class'=>'form-control')) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Authority:</strong>
                    {!! Form::text('button', null, array('placeholder'=>'Authority','class'=>'form-control')) !!}
                </div>

            </div> --}}
        </div>
    </div>
    <div class="box-footer">
        <a href="{{ route('flow.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection