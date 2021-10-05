@extends('layouts.admin')

@section('styles')
<style type="text/css">
.inc{
       padding: 5px;
       margin: 20px;
       font-family:Arial, Helvetica, sans-serif; 
       font-size:13px;
       display: 100%;
    }

    
    .cx{
       font-family:Arial, Helvetica, sans-serif; 
       font-size:14px;
    }
</style>

@endsection

@section('content')

<div class="content-wrapper">
<section class="content-header" >
      <div class="container-fluid">
       @include('includes.flash-message')
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font_s" style="font-family:Arial, Helvetica, sans-serif;">Rent Paid History</h1>
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-dark border-0"  style=""><a style="color: #fff;" href="{{URL::to('aplist')}}"><i class="fas fa-arrow-circle-left mr-2"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>


          <div class="card inc">
            
            
                            
              <div class="card-body">

                
                
                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Flat Name</th>
                    <th>Renter Name</th>
                    <th>Total Rent</th>
                    <th>Rent Paid</th>
                    <th>Paid Month</th>
                    <th>Rent Recieve By</th>
                    
                    <th>Action</th>
                    
                    
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    <th>Flat Name</th>
                    <th>Renter Name</th>
                    <th>Total Rent</th>
                    <th>Rent Paid</th>
                    <th>Paid Month</th>
                    <th>Rent Recieve By</th>
                    
                    <th>Action</th>
                    
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>


</div>


@endsection

@section('scripts')
<script type="text/javascript">

  $(document).ready(function (){
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var flat_id = '{{$flat_id}}';
     var postData = {};
     postData.flat_id = flat_id;
     postData._token = window.csrfToken;
     var table = $('#jsTable').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('flatpaymentdata')}}",
        "type":"POST",
        "data": function(d){
        $.extend(d, postData);
        var dt_params = $('#jsTable').data('dt_params');
        if(dt_params){
         $.extend(d, dt_params);
        }
       }
      },
   "destroy":true,
   "columns": [
                
                {"data": "flat_name"},
                {"data": "renter_name"},
                {"data": "total_rent_amount"},
                {"data": "rent_paid"},
                {"data": "month"},
                {"data": "paid_by"},
                 
                 {"data": "action"}
                
            ]
    });


     
     
     
  });
</script>

<!-- FLASH MESSAGE -->

<script> 
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 7000
    });

   <?php if($message = Session::get('success')): ?>
      Toast.fire({
        icon: 'success',
        title: '<?php echo "&nbsp; $message" ?>',
      })
      
   <?php endif ?>

   <?php if($message = Session::get('error')): ?>
      Toast.fire({
        icon: 'error',
        title: '<?php echo "&nbsp; $message" ?>',
      })
      
   <?php endif ?>
   });

</script>

@endsection

