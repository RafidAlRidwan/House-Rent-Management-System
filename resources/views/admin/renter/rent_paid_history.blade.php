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
              
              <button class=" breadcrumb-item  btn btn-dark border-0"  style=""><a style="color: #fff;" href="{{URL::to('renterlist')}}"><i class="fas fa-arrow-circle-left mr-2"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>


          <div class="card inc">
            
            
                            
              <div class="card-body">

                <div class="input-group mb-2">

                  <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Apartment</label>
                              <div class="input-group-prepend">
                                
                                
                                {{ Form::select('apartment_name', $apartment, null, ['class' => 'form-control cx apartmentnameSelected', 'placeholder'=>'All Apartment']) }}

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cx">Select Flat</label>
                                    <div class="input-group">
                                        
                                        <select name="flat_id" disabled="disabled" class="form-control changeFlat cx">
                                           <option value="">Select Flat</option>
                                        </select>
                                    <span class="help-block text-danger">{{ $errors->first('flat_id') }}</span>
                                </div>
                            </div>
                        </div>
                          <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Renter</label>
                              <div class="input-group-prepend">
                                
                                
                                {{ Form::select('renter_name', $renter, null, ['class' => 'form-control cx renternameSelected', 'placeholder'=>'All Renter']) }}

                            </div>
                          </div>

                            
                      </div>
                
                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Flat Name</th>
                    <th>Total Rent</th>
                    <th>Rent Paid</th>
                    <th>Paid Month</th>
                    <th>Rent Recieve By</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                    
                    
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    <th>Flat Name</th>
                    <th>Total Rent</th>
                    <th>Rent Paid</th>
                    <th>Paid Month</th>
                    <th>Rent Recieve By</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                    
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>

 <section>
  <div class="modal fade" id="payment_details">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <div style="display: block;">
              <h3 class="font_s">Payment Details of <span class="rent_pay_month"></span></h3>
              </div>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <article class="card-body mx-auto" style="max-width: 800px;">


            
            <div class="header">
                        
              <div class="leb input-group mb-3 row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx">Apartment Name: <span class="text-info apartment_name"></span> &nbsp</h4>
               </div>
              <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx ">Flat Name: <span class="text-info flat_name"></span>&nbsp</h4> 
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx">Renter Name: <span class="text-info renter_name"></span> &nbsp</h4>
               </div>
              </div>

              
              
              <div class="leb input-group mb-3 row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx">Total Paid Amount(Collected): <span class="text-success paid_amount"></span> &nbsp</h4>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx">Note: <span class="text-info comment"></span>&nbsp</h4> 
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  <h4 class="cx">Payment Submission Date: <span class="text-info date"></span> &nbsp</h4>
               </div>
              
              </div>
              <hr>
             

                                  
<table class="table table-bordered table-striped" style="background: linear-gradient(to right, #ece9e6, #ece9e6);">
  <thead>
  </thead>
  <tbody>
    <tr>
      
      <td >Flat Rent:</td>
      <td><span class=" flat_rent"></span></td>
    </tr>
    <tr>
      
      <td>Utility Bill:</td>
      <td><span class="utility_bill"></span></td>
      
    </tr>
    <tr>
      
      <td>Additional Charge:</td>
      <td><span class="additional"></span></td>
      
    </tr>
    <tr>
      
      <td>Discount:</td>
      <td><span class="discount"></span></td>
      
    </tr>
    <tr>
      
      <td>Paid from Advance:</td>
      <td><span class="text-danger paid_from_advance"></span></td>
      
    </tr>
    <tr>
      
      <td><strong>Total</strong> </td>
      <td><strong><span class="text-success paid_amount"></span></strong></td>
      
    </tr>
    <tr>
      
      <td><strong>Due</strong> </td>
      <td><strong><span class="text-danger due_amount"></span></strong></td>
      
    </tr>
  </tbody>
</table>   
                                                                     
         
       </article>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</section>
<section>
  
<div class="modal fade" id="p_revert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       {{ Form::open(array('url' => 'paydelete', 'id'=>'delete_form', 'method' => 'POST')) }}
    <div class="modal-body">
     
      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="pay_revert_id"  id="delete">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary border-0 btn_submit">Yes</button>
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
     var postData = {};
     postData._token = window.csrfToken;
     var table = $('#jsTable').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('paiddata')}}",
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
                {"data": "total_rent_amount"},
                {"data": "rent_paid"},
                {"data": "month"},
                {"data": "paid_by"},
                 // {"data": "status"},
                 {"data": "action"}
                
            ]
    });


     $('.renternameSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var renternameSelected = $('.renternameSelected').val();
            if (renternameSelected != "") {
                filterables.renter = renternameSelected;
            } else {
                filterables.renter = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
        });

     $('.apartmentnameSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var apartmentnameSelected = $('.apartmentnameSelected').val();
            if (apartmentnameSelected != "") {
                filterables.apartment = apartmentnameSelected;
            } else {
                filterables.apartment = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
        });


     $('.apartmentnameSelected').on('change', function () {
            var flId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-all-flat') }}",
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
                        select.append('<option value="">All Flat</option>'); 
                        $.each(res['flat'], function (k, v) {
                            select.append('<option value=' + v.id + '>' + v.flat_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">All Flat</option>');
                    }
                }
            });
        });


     $('.changeFlat').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var changeFlat = $('.changeFlat').val();
            if (changeFlat != "") {
                filterables.flat = changeFlat;
            } else {
                filterables.flat = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
        });
    
    $('#jsTable').on('click', '.pay_details', function() {
      
           var renter_name = $(this).attr('renter_name');
           var apartment_name = $(this).attr('apartment_name');
           var flat_name = $(this).attr('flat');
           var flat_rent = $(this).attr('flat_rent');
           var utility_bill = $(this).attr('utility_bill');
           var rent_pay_month = $(this).attr('rent_pay_month');
           var total = $(this).attr('total');
           var paid_from_advance = $(this).attr('paid_from_advance');
           var additional = $(this).attr('additional');
           var discount = $(this).attr('discount');
           var payment_date = $(this).attr('payment_date');
           var paid_amount = $(this).attr('paid_amount');
           var due_amount = $(this).attr('due_amount');
           var comment = $(this).attr('comment');
           var date = $(this).attr('date');

           $('span.renter_name').text(renter_name);
           $('span.apartment_name').text(apartment_name);
           $('span.flat_name').text(flat_name);
           $('span.flat_rent').text(flat_rent);
           $('span.utility_bill').text(utility_bill);
           $('span.rent_pay_month').text(rent_pay_month);
           $('span.total').text(total);
           $('span.additional').text(additional);
           $('span.paid_from_advance').text(paid_from_advance);
           $('span.payment_date').text(payment_date);
           $('span.discount').text(discount);
           $('span.paid_amount').text(paid_amount);
           $('span.comment').text(comment);
           $('span.due_amount').text(due_amount);
           $('span.date').text(date);

        });

    $('#jsTable').on('click', '.pay_revert', function() {
      
           var id = $(this).attr('href');
           $('#delete').val(id);
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

