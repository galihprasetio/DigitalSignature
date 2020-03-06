<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Digital|Approval</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/AdminLTE.min.css')}}">
  <!-- Include stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/quill.snow.css')}}">
    
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('AdminLte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

  <script src="{{ asset('AdminLte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
  <!-- Include the Quill library -->
  <script src="{{ asset('js/quill.js')}}"></script>
  <!-- Initialize Quill editor -->
  
</head>
{{-- onload="window.print();" --}}
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="glyphicon glyphicon-print"></i> Digital Approval, id.
          <small class="pull-right">Date: {{\Carbon\Carbon::now()}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        
        <b> From</b>
        <address>
        
       <table>
           <tr>
               <th>Requestor Name:</th>
               <td> <b>{{$user->name}}</b></td>
           </tr>
           <tr>
                <th>Email:</th>
                <td><b>{{$user->email}}</b></td>
            </tr>
            <tr>
                <th>Submit Date:</th>
                <td><b>{{$document->doc_submit_date}}</b></td>
            </tr>
             <tr>
                <th>Department:</th>
                <td><b>{{$user->department}}</b></td>
            </tr>
            <tr>
                <th>Section:</th>
                <td><b>{{$user->section}}</b></td>
            </tr>
             <tr>
                <th>Tittle:</th>
                <td><b>{{$user->tittle}}</b></td>
            </tr>
            <tr>
                <th>Position:</th>
                <td><b>{{$user->position}}</b></td>
            </tr>
        
       </table>
    </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        {{-- To
        <address>
          <strong>John Doe</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com
        </address> --}}
      </div>
      <!-- /.col -->
      
      <div class="col-sm-4 invoice-col">
        <br>
        
        Document Number #<b>{{$document->doc_number}}</b><br>
        <br>
        <br>
        <table>
            <tr>
                <th>
                    Type:
                </th>
                <td>
                    <b>{{$document->doc_type}}</b>
                </td>
            </tr>
            <tr>
                <th>
                    Document Status:
                </th>
                <td>
                        <b>{{$document->doc_status}}</b>
                </td>
            </tr>
            <tr>
                <th>
                    Subject:
                </th>
                <td>
                    <b>{{$document->doc_subject}}</b>
                </td>
            </tr>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
       
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Detail Description:</p>
        {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}

        {{-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. </p> --}}
          
          {{-- {!! Form::textarea('doc_body', $document->doc_body, array('placeholder'=>'Description','class'=>'form-control','id'=>'doc_body')) !!} --}}
          <!-- Create the editor container -->
          <div id="editor">
            {!! $document->doc_body!!}
          </div>
            
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">List Approval</p>

        <div class="table-responsive">
          <table class="table">
             
                 
            
             <tr>
              @foreach ($approval as $item)
                  
                
              <th style="width:50%">{{$item->name}}</th>
              
              @endforeach 
            </tr>
            <tbody>
                <tr>
                    @foreach ($approval as $item)
                    {{-- <td style="width:50%">{{$item->sign}}</td> --}}
                    <td><img src="{{$item->sign}}" alt="Sign" height="64" width="64"></td>
                    @endforeach
                        
                   
                </tr>
            </tbody>
            <tr>
                @foreach ($approval as $item)
                    <td style="width:50%"><b> {{$item->status}}</b></td>
                    
                @endforeach
                    
                
            </tr>
            <tr>
                @foreach ($approval as $item)
                    <td style="width:50%"><b> {{$item->date_action}}</b></td>
                    
                @endforeach
                    
                
            </tr>
            
            
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Initialize Quill editor -->
<script>
  //   var quill = new Quill('#editor', {
  //   theme: 'snow',
  //   modules: {
  //   toolbar: '',
    
  // },
  // readOnly: true
  // });
   </script>
</body>
</html>
