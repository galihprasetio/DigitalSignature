@extends('admin.admin_template')
@section('tittle','List Flow')
@push('header-name')
<h1>
    Work Flow
<small><a class="btn btn-success" href="{{route('workflow.create')}}"> Create New Work Flow</a></small>

</h1>

<ol class="breadcrumb">
    <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Work Flow</li>
</ol>
@endpush
@section('content')

<div class="box">
    <div class="box-header">


            <div class="box-tools pull-right">

                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
    </div>
    <div class="box-body">
            {{-- <form method="POST" id="search-form" class="form-inline" role="form">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="search name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="search email">
                    </div>
        
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </br> --}}
        <table id="workFlow-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>

    @push('script')
    <script>
       // $('#workFlow-table').DataTable({
        var oTable = $('#workFlow-table').DataTable({
        scrollX:true,
        processing: true,
        serverSide: true,
        ajax: {
            url :"{{ route('workflow.dataworkflow') }}",
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.email = $('input[name=email]').val();
            }
        }
        ,

        columns: [
            {
                data: 'department',
                name: 'name'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            }
        ]
    });
    $('#workFlow').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    </script>
    @endpush
@endsection
