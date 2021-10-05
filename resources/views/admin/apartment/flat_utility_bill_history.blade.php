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

    .cfo{
       font-family:Arial, Helvetica, sans-serif; 
       font-size:16px;
    }
    .leb{
       font-family:Arial, Helvetica, sans-serif; 
       font-size:13px;
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
            <h1 class="font_s">Utility Bill Information</h1>
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-dark border-0"  style=""><a style="color: #fff;" href="{{URL::to('aplist')}}"><i class="fas fa-arrow-circle-left mr-1"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>


          <div class="card inc">
                            
              <div class="card-body">
                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    
                    <th>Month</th>
                    <th>Electricity Bill</th>
                    <th>Water Bill</th>
                    <th>Gas Bill</th>
                    <th>Security Bill</th>
                    <th>Garage Bill</th>
                    <th>Others Utility Bill</th>
                    <th>Others Bill</th>
                    <th>Total Bill</th>
                    <th>Paid Status</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    
                    <th>Month</th>
                    <th>Electricity Bill</th>
                    <th>Water Bill</th>
                    <th>Gas Bill</th>
                    <th>Security Bill</th>
                    <th>Garage Bill</th>
                    <th>Others Utility Bill</th>
                    <th>Others Bill</th>
                    <th>Total Bill</th>
                    <th>Paid Status</th>
                    <th>Action</th>
                    
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>

  <section>
  <div class="modal fade" id="edit_utility_bill">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <div style="display: block;">
              <h4 class="font_s">Edit Utility Bill</h4>
              
              </div>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'utility_bill_update', 'autocomplete'=>'off', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="utility_id" id="utility_id">
        

            
            <div class="header">
                        <div class="row leb input-group">
                          <div class="input-daterange form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Month</label>
                              <div class="input-group-prepend">
                                <span class="rounded-0 input-group-text" ><i class="fas fa-calendar-alt"></i></span>
                                <?php
                                $months = [
                                    '0' => 'Select Month',
                                    '1' => 'January',
                                    '2' => 'February',
                                    '3' => 'March',
                                    '4' => 'April',
                                    '5' => 'May',
                                    '6' => 'June',
                                    '7' => 'July',
                                    '8' => 'August',
                                    '9' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December'
                                ];

                                $monthSelected = date('m');
                                ?>
                                {{ Form::select('month', $months, null, ['id' => 'month', 'class' => 'rounded-0 form-control monthSelected']) }}

                            </div>
                          </div>

                            <div class="input-daterange form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Year</label>
                              <div class="input-group-prepend">
                               <span class="rounded-0 input-group-text" ><i class="fas fa-calendar-alt"></i></span>
                       
                                
                                <?php
                                $selYear = date('Y');
                                $year = [
                                    '0' => 'Select Year',
                                    
                                    date('Y', strtotime('-5 years')) => date('Y', strtotime('-5 years')),
                                    date('Y', strtotime('-4 years')) => date('Y', strtotime('-4 years')),
                                    date('Y', strtotime('-3 years')) => date('Y', strtotime('-3 years')),
                                    date('Y', strtotime('-2 years')) => date('Y', strtotime('-2 years')),
                                    date('Y', strtotime('-1 years')) => date('Y', strtotime('-1 years')),
                                    date('Y') => date('Y'),
                                    date('Y', strtotime('+1 years')) => date('Y', strtotime('+1 years')),
                                    
                                ];
                                ?>
                                {{ Form::select('year', $year, null, ['id' => 'year', 'class' => 'rounded-0 form-control yearSelected']) }}

                            </div>

                        </div>
                      </div>



              <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Electricity Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text" ><i class="fas fa-money-check-alt"></i></span>
                       
                    <input type="number" name="electricity_bill" id="electricity_bill" class="rounded-0 form-control" required>

                    </div> 
                  </div>
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Water Bill</label>
                  <div class="input-group-prepend">
                    
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="water_bill" id="water_bill" class="rounded-0 form-control" required>
                  </div>
                  </div>
                </div>
             

           <div class="leb input-group mb-3 row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Gas Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                       
                    <input type="number" name="gas_bill" id="gas_bill" class="rounded-0 form-control" required>
                </div>
              </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Security Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="security_bill" id="security_bill" class="rounded-0 form-control" required>
              </div>
            </div>
          </div>


              <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Others Utility Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="others_utility_bill" id="others_utility_bill" class="rounded-0 form-control" required>
                  </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Others Utility Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="others_bill" id="others_bill" class="rounded-0 form-control" required>
              </div>
            </div>
          </div>
             

    
                  
              <div class="leb input-group mb-3 row ">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Garage Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="garage_bill" id="garage_bill" class="rounded-0 form-control" required>
                  </div>
                </div>
             </div>
                                
                           
                                   
                                         
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Update  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
            </div>
            <!-- <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</section>

<section>

<div class="modal fade" id="utility_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
{{ Form::open(array('url' => 'deleteutilitybill', 'id'=>'user_delete_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submitdl" class="btn btn-primary border-0 btn_submit">Yes</button>
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>
</div>


@endsection

@section('scripts')
<script type="text/javascript">

  $('#datepicker').datepicker();

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
        "url": "{{URL::to('utilitydatatable')}}",
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
                {"data": "month"},
                {"data": "electricity_bill"},
                {"data": "water_bill"},
                {"data": "gas_bill"},
                {"data": "security_bill"},
                {"data": "garage_bill"},
                {"data": "others_utility_bill"},
                {"data": "others_bill"},
                {"data": "total_bill"},
                 {"data": "status"},
                {"data": "action"}
            ]
    });

     $('#jsTable').on('click', '.edit_utility', function(){
      var id = $(this).attr('href');
      var electricity_bill = $(this).attr('electricity_bill');
      var gas_bill = $(this).attr('gas_bill');
      var water_bill = $(this).attr('water_bill');
      var security_bill = $(this).attr('security_bill');
      var others_bill = $(this).attr('others_bill');
      var others_utility_bill = $(this).attr('others_utility_bill');
      var garage_bill = $(this).attr('garage_bill');
      var month = $(this).attr('month');
      var year = $(this).attr('year');

      $('#utility_id').val(id);
      $('#electricity_bill').val(electricity_bill);
      $('#gas_bill').val(gas_bill);
      $('#water_bill').val(water_bill);
      $('#security_bill').val(security_bill);
      $('#others_bill').val(others_bill);
      $('#others_utility_bill').val(others_utility_bill);
      $('#garage_bill').val(garage_bill);
      $('#month').val(month);
      $('#year').val(year);


        });

     $('#jsTable').on('click', '.utility_delete', function(){
      var id = $(this).attr('href');
      

      $('#id').val(id);
      
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

