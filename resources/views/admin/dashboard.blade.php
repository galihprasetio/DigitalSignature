@extends('admin.admin_template')
@section('tittle','Dashboard')
@push('header-name')
<h1>
    Dashboard


</h1>

<ol class="breadcrumb">
    <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@endpush
@section('content')
<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$totalDocument}}</h3>

            <p>Total Submited Documents</p>
          </div>
          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
          <a href="{{route('documents.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{$totalCompleted}}<sup style="font-size: 20px"></sup></h3>
  
                <p>Completed Documents</p>
              </div>
              <div class="icon">
                <i class="fa fa-check-square-o"></i>
              </div>
              <i href="{{route('documents.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></i>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3>{{$totalUser}}</h3>
      
                    <p>User Registrations</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{route('users.create')}}" class="small-box-footer">Register User <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                      <div class="inner">
                        <h3>65</h3>
          
                        <p>Unique Visitors</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
@push('script')
<script>
    

</script>
@endpush
@endsection
