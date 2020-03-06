@extends('admin.admin_template')
@section('tittle','List Document')
@push('header-name')
<h1>
    Need My Actions


</h1>

<ol class="breadcrumb">
    <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Need My Actions</li>
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
        <table id="document-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                   
                    <th>Doc Number</th>
                    <th>Type</th>
                    <th>Submit Date</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Subject</th>
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
        $('#document-table').DataTable({
        scrollX:true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('documents.dataNeedMyAction') }}",
        columns: [
            {
                data: 'doc_number',
                name: 'doc_number'
            },
            {
                data: 'doc_type',
                name: 'doc_type'
            },
            {
                data: 'doc_submit_date',
                name: 'doc_submit_date'
            },
            
            {
                data: 'doc_author',
                name: 'doc_author'
            },
            {
                data: 'doc_status',
                name: 'doc_status'
            },
            {
                data: 'doc_subject',
                name: 'doc_subject'
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

    </script>
    @endpush
@endsection
