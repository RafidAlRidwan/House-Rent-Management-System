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
            
            <h1 class="font_s">Apartment</h1>
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              
              
              <button class=" breadcrumb-item  btn btn-info border-0 btn_add"><a style="color: #fff;" href="{{URL::to('apcreate')}}"><i class="fas fa-plus mr-1"></i>Add</a>  </button> 
            </ol>
          </div>
          
        </div>
      </div>


          <div class="card inc">
                           
              <div class="card-body ">

                <div class="input-group mb-2">

                  <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Apartment</label>
                              <div class="input-group-prepend">
                                
                                
                                {{ Form::select('apartment',$apartments_name , null, ['class' => 'form-control leb apartmentSelected', 'placeholder'=>'All Apartment']) }}

                        </div>
                    </div>
     
                </div> 
                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Apartment Details</th>
                    <th>Address Details</th>
                    <th>Action</th>
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    <th>Apartment Details</th>
                    <th>Address Details</th>
                    <th>Action</th>
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>
</div>


<section>

<!-- Modal View Details-->
<div class="modal fade" id="flat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLabel">Flat List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card">
                    <div class="header">
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="form-group">
                                <div id="flatShow">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        
        
      </div>
    </div>
  </div>
</div>
</section>

<section>

<!-- Modal Delete-->
<div class="modal fade" id="ap" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
       {{ Form::open(array('url' => 'apdelete', 'id'=>'delete_form', 'method' => 'POST')) }}
    <div class="modal-body">
     
      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="ap_id"  id="delete">
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
        "url": "{{URL::to('apdata')}}",
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
                
                {"data": "apartment_details"}, 
                {"data": "address_details"},
                {"data": "action"},
            ]
    });


    


// Delete Form
     $('#jsTable').on('click', '.aptdel', function() {
      
           var id = $(this).attr('href');
           $('#delete').val(id);
        });


   $('.apartmentSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var apartmentSelected = $('.apartmentSelected').val();
            if (apartmentSelected != "") {
                filterables.name = apartmentSelected;
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

