@extends('layouts.admin')

@section('styles')
  
  
  <style type="text/css">
    .tablecolor{
      background: #85C1E9;
      color: #fff;
      
    }
    .inc{
       padding: 5px;
       margin: 20px;
       font-family:Arial, Helvetica, sans-serif; 
       font-size:14px;
       display: 100%;
    }
    .leb{
      width: 100%;
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
            <h1 class="font_s">Expense</h1>


           
           </div>


          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0 btn_add" data-toggle="modal" data-target="#expense_add_modal"  style=""><i class="fas fa-plus mr-1"></i> Add </button> 
            </ol>
          </div>

        </div>
      </div>
      <div class="row" style="margin-top: 10px; margin-bottom: 0; margin-left: 13px; ">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="body">
                            <div class="row">
                                <div class="col-3">
                                    <i style="margin: 10px; font-size: 35px; color: #007bff;" class="fas fa-money-bill-alt"></i>
                                </div>
                                <div class="col-9">
                                    <h6 class="mb-0 pt-2 ml-3">Total Expense</h6>
                                    <p class="mb-0 ml-3" id="total"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
  
         <div class="card inc ">
                            
              <div class="card-body">

                <div class="input-group mb-2">

                      <div class=" input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Month</label>
                              <div class="input-group-prepend">
                                
                                <?php
                                $months = [
                                    '0' => 'All Month',
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
                                {{ Form::select('filter_month', $months, $monthSelected, ['class' => 'form-control monthSelected']) }}

                            </div>
                          </div>

                            <div class=" input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Year</label>
                              <div class="input-group-prepend">
 
                                <?php
                                $selYear = date('Y');
                                $year = [
                                    '0' => 'All Year',
                                    
                                    date('Y', strtotime('-5 years')) => date('Y', strtotime('-5 years')),
                                    date('Y', strtotime('-4 years')) => date('Y', strtotime('-4 years')),
                                    date('Y', strtotime('-3 years')) => date('Y', strtotime('-3 years')),
                                    date('Y', strtotime('-2 years')) => date('Y', strtotime('-2 years')),
                                    date('Y', strtotime('-1 years')) => date('Y', strtotime('-1 years')),
                                    date('Y') => date('Y'),
                                    date('Y', strtotime('+1 years')) => date('Y', strtotime('+1 years')),
                                    
                                ];
                                ?>
                                {{ Form::select('filter_year', $year, $selYear, ['class' => 'form-control yearSelected']) }}

                            </div>

                        </div>
                        <div class="input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Cost Sector</label>
                              <div class="input-group-prepend">
                                
                              <select name="cost" class="costsSelected form-control">
                                    <option value="all">All Cost Sector</option>
                                @foreach($cost_sector as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>

                                @endforeach         
                                    <option value="0">Other</option>          
                              </select>

                        </div>
                        </div>
                      </div>


                    

                            
                      
                <table id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>

                    <th>Cost Sector</th>
                    <th>Cost Details</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Remarks</th>
                    <th>Submitted By</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tfoot>
                    <tr>

                    <th>Cost Sector</th>
                    <th>Cost Details</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Remarks</th>
                    <th>Submitted By</th>
                    <th>Action</th>
        
                  </tr>
                  </tfoot>

</table>
</div>

<!--Add  Modal -->
<section>
  <div class="modal fade" id="expense_add_modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <div style="display: block;">
              <h4 class="cus">Add Expense</h4>
              </div>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'expenseadd', 'autocomplete'=>'off', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

            
            <div class="header">
                        <div class="row input-group">



                  
     
                 
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
                                {{ Form::select('month', $months, $monthSelected, ['class' => 'rounded-0 form-control monthSelected']) }}

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
                                {{ Form::select('year', $year, $selYear, ['class' => 'rounded-0 form-control yearSelected']) }}

                            </div>

                        </div>

                        
                      </div>

              
          <div class="input-group row">
                  
            <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Cost Sector</label>
                  <div class="input-group-prepend">
                    <span style="width: 45px;" class="rounded-0 input-group-text" ><i class="fas fa-money-check-alt"></i></span>
                       
                    
                    <select name="cost_sector_id" class="changeCost form-control">
                          <option>Select Cost Sector</option>
                      @foreach($cost_sector as $c)
                          <option value="{{$c->id}}">{{$c->name}}</option>

                      @endforeach         
                          <option value="0">Other</option>          
                    </select>
                    

                </div>
              </div>

              
            
               
                <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Amount</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="amount" class="rounded-0 form-control" required>
              </div>
            </div>
          </div>
            <!--  <div class="append_text_field">

             </div>
            <div class="input-group row leb">
              <div class="others_text_field col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display: none">
                  <div class="input-group-prepend  mb-3 pr-3" >
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                      <input type="text" name="others_cost" class="rounded-0 form-control" required placeholder="Other Cost">
                  </div>
              </div>
            </div> -->

            <div class="form-group" id="append_here">
                       <div class="field_wrapper">
                                                    
                   </div>
             </div>

            
             
          
          


              <div class="input-group row ">
                <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Aparment</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text" ><i class="fas fa-building"></i></span>
                       
                    {!! Form::select('apartment_id', $apartment, null, ['class' => 'form-control changeApt', 'placeholder'=>'Select Apartment'  ]) !!}

                    </div> 
                  </div>



                 <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Flat</label>
                  <div class="input-group-prepend">
                    
                    <span class="rounded-0 input-group-text"><i class="fas fa-building"></i></span>
                  
                   <select name="flat_id" disabled="disabled" class="form-control changeFlat">
                            <option value="">Select Flat</option>
                   </select>
                  </div>
                  </div>
                </div>
             

              <div class="input-group row">

                <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Renter</label>
                  <div class="input-group-prepend">
                    
                    <span class="rounded-0 input-group-text"><i class="fas fa-user"></i></span>
                  
                   <select name="renter_id" disabled="disabled" class="form-control  changeRenter">
                    <option value="">Renter Name</option>
                    </select>
                  </div>
                  </div>
                <div class="mb-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Select Date</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-calendar"></i></span>
                        
                    <input name="transaction_date" id='datepicker' data-date-autoclose="true" required class="form-control" data-date-format="yyyy-mm-dd" >
                  </div>
                </div>
                

          </div>
      

      <div class="input-group row">
          <div class="mb-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                 <label>Comment</label>
                      <div class="input-group-prepend">
                          <span class="rounded-0 input-group-text"><i class="fas fa-address-card"></i></span>
                          <textarea id="remarks" name="remarks" rows="2" class="form-control" placeholder="Comments"></textarea>
                        </div>
                                    
          </div>
                          
       </div>

                                   
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Submit  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
            </div>
            
          </div>
          
        </div>
        
      </div>
</section>

<section>
  
<div class="modal fade" id="ex_revert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       {{ Form::open(array('url' => 'exdelete', 'id'=>'delete_form', 'method' => 'POST')) }}
    <div class="modal-body">
     
      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="ex_revert_id"  id="delete">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary border-0 btn_submit">Yes</button>
      </div>

    </div>
    {{ Form::close() }}

        
    </div>
  </div>
</div>
</section>




@endsection

@section('scripts')



<script type="text/javascript">
  $('.changeCost').on('change', function () {
     
            var field = $(this).val();
            if (field == 0) {
                var wrapper = $('.field_wrapper');
                var html = '<div class="input-group row">'+
                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">' +
                '<div class="input-group">' + 
                '<span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>' +
                '<input type="text" name="others_cost" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default " placeholder="Other Cost" required> ' +
                '</div>' +
                '</div>' +
                '</div>';

                $(wrapper).append(html);
            }
            else{
              $('.field_wrapper').empty();
            }
        });
  $('.changeApt').on('change', function () {
            var flId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-flat-list') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'flId': flId,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    var select = $('.changeFlat');
                    select.find('option').remove();
                    if (res['flat'].length > 0) {
                        select.attr('disabled', false);
                        select.append('<option value="">Select Flat</option>'); 
                        $.each(res['flat'], function (k, v) {
                            select.append('<option value=' + v.id + '>' + v.flat_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Select Flat</option>');
                    }
                }
            });
        });


    $('.changeFlat').on('change', function () {
            var flId = $(this).val();
            
            $.ajax({
                url: "{{ URL::to('get-renter') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'flId': flId,
                    
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    var select = $('.changeRenter');
                    select.find('option').remove();
                    if (res['flat_renter'].length > 0) {
                        select.attr('disabled', false); 
                  
                        $.each(res['flat_renter'], function (k, v) {
                            select.append('<option value=' + v.id + '>' + v.renter_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Flat is not in Rent</option>');
        
                    }
                }
            });
            });

     window.csrfToken = '<?php echo csrf_token(); ?>';
     var postData = {};
     postData._token = window.csrfToken;

     var table = $('#jsTable').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('expensedata')}}",
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
   
                {"data": "cost_sector"},
                {"data": "cost_details"},
                
                {"data": "amount"},
                {"data": "month"},
                {"data": "remarks"},
                {"data": "submitted_by"},
                {"data": "action"},
            ]

            });

     table.on('xhr', function () {
            var json = table.ajax.json();
            $("#total").text(json.total);

        });

     $('.monthSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var monthSelected = $('.monthSelected').val();
            if (monthSelected != "") {
                filterables.month = monthSelected;
                $('#jsTable').data('dt_params', filterables);
                $('#jsTable').DataTable().draw();
            }
        });

    $('.yearSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var yearSelected = $('.yearSelected').val();
            if (yearSelected != "") {
                filterables.year = yearSelected;
                $('#jsTable').data('dt_params', filterables);
                $('#jsTable').DataTable().draw();
            }
        });

    $('.costsSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var costsSelected = $('.costsSelected').val();
            if (costsSelected != "") {
                filterables.cost = costsSelected;
            } else {
                filterables.cost = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
        });

    $('#jsTable').on('click', '.expense_revert', function() {
      
           var id = $(this).attr('href');
           $('#delete').val(id);
        });

     
     
  
</script>


<script type="text/javascript">
  $(function() {

    $('#datepicker').datepicker();
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

