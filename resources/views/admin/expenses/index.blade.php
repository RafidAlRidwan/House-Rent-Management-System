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
       font-size:13px;
       display: 100%;
    }
    .leb{
      width: 100%;
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
            <h1 class="font_s">Cost Sector</h1>


           
           </div>


          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0 btn_add" data-toggle="modal" data-target="#cost_add_modal"  style=""><i class="fas fa-plus mr-1"></i> Add </button> 
            </ol>
          </div>

        </div>
      </div>
  
         <div class="card inc ">
                            
              <div class="card-body">

                <div class="input-group mb-2">

                    

                            
                      </div>
                <table id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tfoot>
                    <tr>
      
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
        
                  </tr>
                  </tfoot>

</table>
</div>

<!--User_Add  Modal -->
<section>

<div class="modal fade" id="cost_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Add Cost Sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'addcostsector', 'id'=>'user_add_form', 'autocomplete'=>'off', 'method' =>'POST'))}}
         
           <div class="form-group input-group">
            <div class="leb">
                <label for="name">Name</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-user-circle" style="font-size: 18px;"></i> </span>
             </div>

               <input name="name" class="form-control"  type="text" required>
             </div>

             <div class="form-group input-group">
            <div class="leb">
                <label for="status">Status</label>
              </div>
               <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-toggle-on"></i> </span>
              </div>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('status', $status, null, ['class' => 'form-control', 'id' =>'status_data', 'placeholder'=>'Select Status'  ]) !!}
             
              </div> 

            

                                         
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit" style=""> Create  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
     </div> 
    </div>
   </div>
  </div>
</div>
</section>



<!--Edit Modal -->
<section>

<div class="modal fade" id="cost_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Edit Cost Sector</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'editcost', 'id'=>'user_edit_form',  'method' =>'POST'))}}
         

         <input type="hidden" name="id" id="cost_id">
         <div class="leb">
                <label for="name">Name</label>
              </div>
           <div class="form-group input-group">
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
               <input name="name" id="name" class="form-control"  type="text">
             </div>

           <div class="form-group input-group">
            <div class="leb">
                <label for="status">Status</label>
              </div>
               <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-toggle-on"></i> </span>
              </div>
  
                         <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                 {!! Form::select('status', $status, null, ['class' => 'form-control', 'id' =>'cstatus' ]) !!}
             
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
</div>
</section>


<!--Delete Modal -->
<section>

<div class="modal fade" id="cost_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
{{ Form::open(array('url' => 'delcost', 'id'=>'user_delete_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_cost_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submitdl" class="btn btn-primary border-0 btn_submit">Yes</button>
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


// DataTable
     window.csrfToken = '<?php echo csrf_token(); ?>';
     var postData = {};
     postData._token = window.csrfToken;
     var table = $('#jsTable').DataTable({
        "processing":true,
        "serverSide":true,
        "lengthMenu":[5,10,25,50,100],
        "pagelength":25,
        "ajax":{
        "url": "{{URL::to('costdata')}}",
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
                
                {"data": "name"},
                {"data": "status"},
                {"data": "action"},
            ]
    });

// Update user
    table.on('click' , '.cost_edit' , function(){
      var id = $(this).attr('href');
      var name = $(this).attr('name');
      var statuss = $(this).attr('c_status');
      $('#cost_id').val(id);
      $('#name').val(name);
      $('#cstatus').val(statuss);

    });

     
  // User Delete
    table.on('click' , '.cost_delete' , function(){
      var id = $(this).attr('href');
            $('#del_cost_id').val(id);
          });


    

});
  


</script>


<script type="text/javascript">
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