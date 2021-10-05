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
            
            <h1><a class="text-dark font_s" href="{{URL::to('aplist')}}">{{$apartments->apartment_name}} Details</a></h1>
           </div>



          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class="floorAdd breadcrumb-item  btn border-0 mr-3 btn_add"><a data-toggle='modal' data-target='#addfloor' style="color: #fff;" href = {{$apartments->floor_count}}><i class="fas fa-plus mr-1"></i>Add Floor</a>  </button> 

              <button class=" breaddcrumb-item  btn border-0 btn_add"><a data-toggle='modal' data-target='#addflat'  style="color: #fff;" href = {{$apartments->floor_count}}><i class="fas fa-plus mr-1"></i>Add Flat</a>  </button>
            </ol> 
          </div>
          
        </div>
      </div>


          <div class="card inc">
                            
              <div class="card-body">

                <div class="input-group mb-2">

                  <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Floor</label>
                              <div class="input-group-prepend">
                               
                                <select id="floor" name="floor"  class="leb form-control floorSelected">
                                    <option value="0" selected="selected">All Floor</option>
                                     @for ($i =1; $i <= $apartments->floor_count; $i++)

                                         <option value="{{ $i }}">{{ $i }}</option>
                                     @endfor               
                                </select>


                        </div>
                    </div>

                    <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Status</label>
                              <div class="input-group-prepend">

                                <?php

                                   $status =[
                                     0=>'Free',
                                     1=>'Hired'
                                    ]
                                     ?>
                               
                                {{ Form::select('status', $status , null, ['class' => 'form-control leb statusSelected', 'placeholder'=>'All Status']) }}

                        </div>
                    </div>
     
                      </div> 

                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Flat Details</th>
                    <th>Flat Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    <th>Flat Details</th>
                    <th>Flat Status</th>
                    <th>Action</th>
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>
</div>





<!-- Modal Flat Edit -->
<section>
<div class="modal fade" id="flat_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLabel">Flat Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'flatupdate', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="id" id="flat_id">
            <div class="form-group input-group">
             <div class="leb">
                <label for="flat_name">Flat Name</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-file-signature" style="font-size: 18px;"></i> </span>
             </div>

               <input name="flat_name" id="flat_name" class="form-control" required  type="text">
             </div> 






           <div class="form-group input-group">
            <div class="leb">
                <label for="flat_status">Status</label>
              </div>
               <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-toggle-on"></i> </span>
              </div>
  
                         <?php

                         $status =[
                         0=>'To Let',
                         1=>'Hired'
                       ]

                          ?>
                 {!! Form::select('flat_status', $status, null, ['class' => 'form-control' , 'id' => 'flat_status']) !!}
             
              </div>


              <div class="form-group input-group">
                  <div class="leb">
                    <label for="flat_rent">Flat Rent</label>
                  </div>
                 <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-money-check-alt"></i> </span>
                </div>
                <input name="flat_rent" id="flat_rent" class="form-control" required  type="text"><br>
                
             </div>
             <div class="leb text-danger"><span><strong>*If rent will change, Please Select from Which Month</strong></span></div>
             


                  
                                <div class="form-group input-group">
                                	<div class="leb">
                                    <label>Start Month</label>
                                </div>
                                    <div class="input-group-prepend">
                                        <span class="input-group-addon"><i class="fas fa-calendar" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        </div>
                  
                                        <input required  name="start_month" id='datepicker' data-date-autoclose="true"
                                               class="form-control" data-date-format="yyyy-mm-dd" >
                                      
                                  </div>
                                
                           
                                   
                                         
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Update  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
      </div>
      
    </div>
  </div>
</div>
</section>


<!-- Modal For AddFlat -->
<section>
<div class="modal fade" id="addflat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div  class="modal-header">
        <h5 class="modal-title tac font_s" id="exampleModalLabel">Apartment: <b> {{$apartments->apartment_name}}</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'flatadd', 'id'=>'flat_add_form', 'method' =>'POST'))}}
         


        <input type="hidden" name="apartment_id" value="{{$id}}">
            <div class="form-group input-group">
             <div class="leb">
                <label for="flat_name">Select Floor</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-toggle-on" style="font-size: 18px;"></i> </span>
             </div>
             <select name="floor_number" class="form-control" id="d">
              @for($i=1; $i<=$apartments->floor_count; $i++ )
               
                    <option value="{{$i}}">{{$i}}</option>
              
              
              @endfor
              </select>
             </div> 
          
                    <div class="form-group input-group">
                      <div class="leb">
                        <label class="control-label">New Flat</label>
                      </div>
                          <div class="input-group-prepend">
                            <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                          </div>
                        <input type="number" id="flat_count" name="flat_count" required class="form-control" >
                                    
                    </div>
                        

           
                <div class="form-group" id="append_here">
                    <div class="field_wrapper"></div>
                </div>
                    


     
                                    
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Update  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
      </div>
      
    </div>
  </div>
</div>
</section>

<!-- Modal For DeleteFlat -->
<div class="modal fade" id="deleteflat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div  class="modal-header">
        <h5 class="modal-title tac font_s" id="exampleModalLabel">Flat Delete</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'flatdelete', 'id'=>'flat_delete_form', 'method' =>'POST'))}}
         


        <input type="hidden" name="flat_id" id="flat_idd">
            
          
                    <div class="form-group input-group">
                      <div class="leb">
                        <label class="control-label">Comment</label>
                      </div>
                          <div class="input-group-prepend">
                            <span class="input-group-addon"><i class="fas fa-comment-dots" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                          </div>
                        <input type="text" id="flat_comment" name="flat_comment" required class="form-control" >
                                    
                    </div>

                    <div class="form-group input-group">
                                	<div class="leb">
                                    <label>Select Month</label>
                                </div>
                                    <div class="input-group-prepend">
                                        <span class="input-group-addon"><i class="fas fa-calendar" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        </div>
                  
                                        <input name="rent_end_month" id='datepicker2' data-date-autoclose="true" autocomplete="off"
                                               class="form-control" data-date-format="yyyy-mm-dd" >
                                      
                                  </div>
                        

                      
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Delete  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
      </div>
      
    </div>
  </div>
</div>
</section>

<!-- Modal For AddFloor -->
<section>
<div class="modal fade" id="addfloor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div  class="modal-header">
        <h5 class="modal-title tac font_s" id="exampleModalLabel">Add Floor</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'flooradd', 'id'=>'flat_add_form', 'method' =>'POST'))}}
         


        <input type="hidden" name="apartment_id" value="{{$id}}">
        <input type="hidden" name="last_floor_number" id="last_floor_number" value="{{$apartments->floor_count}}"> 
             
          
                    <div class="form-group input-group">
                      <div class="leb">
                        <label class="control-label">New Floor</label>
                      </div>
                          <div class="input-group-prepend">
                            <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                          </div>
                        <input type="number" id="floor_count" name="floor_count" required class="form-control" >
                                    
                    </div>
                        

           
                <div class="leb follow form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="append_here2">
                    <div class="field_wrapper2"></div>
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
@endsection

@section('scripts')
<script type="text/javascript">

	$(document).on('focus', ".datepicker", function() {
    $(this).datepicker();
     });
	$('#datepicker').datepicker();
	$('#datepicker2').datepicker();

  $(document).ready(function (){
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var apartment_id = '{{$id}}';
     var postData = {};
     postData.apartmentId = apartment_id;
     postData._token = window.csrfToken;
     var table = $('#jsTable').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('apartmentdata')}}",
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
                
                {"data": "flat_details"}, 
                {"data": "status"},
                {"data": "action"},
            ]
    });

     
      

     $('#jsTable').on('click', '.edit_flat_details', function() {
      
           var id = $(this).attr('href');
           var flat_name = $(this).attr('flatName');
           var flat_status = $(this).attr('flatStatus');
           var flat_rent = $(this).attr('flatRent');
           var date = $(this).attr('rent_date');
           
           
           $('#flat_id').val(id);
           $('#flat_name').val(flat_name);
           $('#flat_status').val(flat_status);
           $('#flat_rent').val(flat_rent);
           $('#datepicker').val(date);
           
        });

      
  $('#flat_count').change(function(){
            $('.field_wrapper').empty();
            var loopQty = $(this).val();

            for(i = 0; i < loopQty; i++){
                var flatNum = i + 1;
                var wrapper = $('.field_wrapper');
                var html = '<div style="padding-left: 8px;" class="row">' +
                    '<label class="badge badge-info mb-3" style="line-height: 25px; padding-left: 10px; font-size: 14px;">New Flat ' + flatNum + ' Details: </label>' +
                    '<div class="input-group mb-3 mr-2">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text" >Flat ' + flatNum +' Name</span>' +
                    '</div>' +
                    '<input type="text" name="flat_name[]" class="form-control" required>' +
                    '</div>' +
                    
                    
                    
                    '<div class="input-group mb-3 mr-2">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text" >Flat ' + flatNum +' Rent</span>' +
                    '</div>' +
                    '<input type="number" name="flat_rent[]" class="form-control" required>' +
                    '</div>' +
                    
                    
                    '<div class="input-group mb-3 mr-2">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text" >Start Month</span>' +
                    '</div>' +
                    '<input name="rent_start_month[]" data-date-autoclose="true" required class="form-control datepicker" autocomplete="off" data-date-format="yyyy-mm-dd">' +
                    '</div>' +
                    '</div>' +
                    
                    '<hr>';
               
                
                flatNum++;
                    
                $(wrapper).append(html);
            }
        });

      $('#jsTable').on('click', '.delete_flat', function() {
      
           var id = $(this).attr('href');
           
           $('#flat_idd').val(id);
           
        });

     


      $('#floor_coun').change(function(){
      	   
           

            $('.field_wrapper2').empty();
            var loopQty = $(floor_count).val();
            var floor_number = $(last_floor_number).val(); 
            var num = parseInt(floor_number);

            for(i = 0; i < loopQty; i++){
                var flatNum = i + num + 1;
                var wrapper = $('.field_wrapper2');
                var html2 = '<div style="padding-left: 8px;" class="row">' +
                    '<label class="badge badge-info leb mr-2" style="line-height: 25px; padding-left: 10px; font-size: 14px;">New Floor ' + flatNum + ' Added </label>' 
                    
                    '<hr>';
               
                
                flatNum++;
                    
                $(wrapper).append(html2);
            }
            var floor = $(this).attr('href');
            $('#floor_n').val(floor);
        });




// NEW ss

       $('#floor_count').change(function(){
            $('.field_wrapper2').empty();
            var floor_number = $(last_floor_number).val(); 
            var number = parseInt(floor_number);
            var loopQty = $(floor_count).val();
            var totalloop = parseInt(floor_number) + parseInt(loopQty);

            for(i = number; i < totalloop; i++){
                var flatNum = i + 1;
                var wrapper = $('.field_wrapper2');
                var html = '<div class="row">'+
                '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">' +
                
                '<label class="badge badge-info" style="line-height: 25px; padding-left: 10px; font-size: 14px;">New Floor ' + flatNum + ' : </label>' +

                '<div class="input-group mb-3 ">' +
                '<div class="input-group-prepend">' +
                '<span class="input-group-text">Flat Per Floor</span>' +
                '</div>' +
                '<input type="number" name="flat_count[]" num="'+flatNum+'" id="floor' + flatNum + '" class="form-control floor_details" aria-label="Default" aria-describedby="inputGroup-sizing-default" required> ' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="flat_count_appent" id = "append_here2' + flatNum + '">' +
                '<div class = "asd" id="field_wrapper_floor2' + flatNum + '">' +
                
                '</div>' +
                    '<hr>';

                $(wrapper).append(html); //Add field html
            }
            var floor = $(this).attr('href');
            $('#floor_n').val(floor);
        });

       

        $('#append_here2').on('change', '.floor_details', function(){

            var flatCount = $(this).val();
            var num = $(this).attr('num');
            
            
            $('#field_wrapper_floor2' + num).empty();
            if(flatCount > 0){
              
                var wrapper1 = $(this).parents('.follow').find('#field_wrapper_floor2' + num);

                var html1 = '';
                
                 var flatNum = 1;
            

                for(i = 0; i < flatCount; i++){
                    html1 += '<div style="padding-left: 8px; padding-right: 8px;" class="row">' +
                    '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">' +
                    '<div class="input-group mb-3">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">Flat ' + flatNum +' Name</span>' +
                    '</div>' +
                    '<input type="text" name="flat_name[]" class="form-control" required>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">' +
                    '<div class="input-group mb-3">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">Flat ' + flatNum +' Rent</span>' +
                    '</div>' +
                    '<input type="number" name="flat_rent[]" class="form-control" required>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">' +
                    '<div class="input-group mb-3">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text">Start Month</span>' +
                    '</div>' +
                    '<input name="rent_start_month[]" data-date-autoclose="true" required class="form-control datepicker" autocomplete="off" data-date-format="yyyy-mm-dd">' +
                    '</div>' +
                    '</div>' +
                    '</div>';
               
                
                flatNum++;
                 
                }

                $(wrapper1).append(html1);
            }
        });


        $('.floorSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var floorSelected = $('.floorSelected').val();
            if (floorSelected != "") {
                filterables.floor = floorSelected;
            } else {
                filterables.floor = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
        });


        $('.statusSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var statusSelected = $('.statusSelected').val();
            if (statusSelected != "") {
                filterables.status = statusSelected;
            } else {
                filterables.status = 0;
            }
            $('#jsTable').data('dt_params', filterables);
            $('#jsTable').DataTable().draw();
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

