@extends('admin.admin_template')
@section('tittle','List Flow')
@push('header-name')
<h1>
    Flow Management
<small><a class="btn btn-success" href="{{route('flow.create')}}"> Create New Flow</a></small>

</h1>

<ol class="breadcrumb">
    <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Flow</li>
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
        <table id="flow-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Doc Number</th>
                    <th>Step Number</th>
                    <th>Author</th>
                    <th>Status Number</th>
                    <th>Status</th>
                    <th>Authority</th>
                    <th>Created at</th>
                    <th>Update at</th>
                    <th>Action</th>
                </tr>
            </thead>

        </table>
    </div>
</div>
    @push('script')
    <script>
        $('#flow-table').DataTable({
        scrollX:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('flow.dataflow') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'id_doc',
                name: 'Id_doc'
            },
            {
                data: 'step_number',
                name: 'step_number'
            },
            {
                data: 'author',
                name: 'author'
            },
            {
                data: 'status_number',
                name: 'status_number'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'button',
                name: 'button'
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
                orderable: false,
                searchable: false
            }
        ]
    });

    </script>
    @endpush
@endsection
