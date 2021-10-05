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
            <h1 class="font_s">User List</h1>


           
           </div>


          <div class="col-sm-6">
            
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0 btn_add" data-toggle="modal" data-target="#user_add_modal"  style=""><i class="fas fa-plus mr-1"></i> Add </button> 
            </ol>
          </div>

        </div>
      </div>
  
         <div class="card inc ">
                            
              <div class="card-body">

                <div class="input-group mb-2">

                  <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select User</label>
                              <div class="input-group-prepend">
                                <?php

                         $status =[
                         0=>'Inactive',
                         1=>'Active'
                       ]

                          ?>
                                
                                {{ Form::select('status',$status , null, ['class' => 'form-control leb statusSelected', 'placeholder'=>'All User']) }}

                        </div>
                    </div>

                    

                            
                      </div>
                <table id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tfoot>
                    <tr>
      
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>

</table>
</div>

<!--User_Add  Modal -->
<section>

<div class="modal fade" id="user_add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'adduser', 'id'=>'user_add_form', 'autocomplete'=>'off', 'method' =>'POST'))}}
         
           <div class="form-group input-group">
            <div class="leb">
                <label for="username">Username</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-user-circle" style="font-size: 18px;"></i> </span>
             </div>

               <input name="username" class="form-control"  type="text" required>
             </div> 


             <div class="form-group input-group">
              <div class="leb">
                <label for="full_name">Full Name</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
             
               <input name="full_name" class="form-control"  type="text" required>
             </div>

             <div class="form-group input-group">
              <div class="leb">
                <label for="mobile">Mobile</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-mobile" style="font-size: 20px;"></i> </span>
             </div>
             
               <input name="mobile" class="form-control"  type="text" required>
             </div>

             

               <div class="form-group input-group">
                <div class="leb">
                <label for="email">Email Address</label>
              </div>
                  <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
              </div>
                <input name="email" class="form-control"  type="email" required>
             </div>

              
    
    
             <div class="form-group input-group">
              <div class="leb">
                <label for="password">Password</label>
              </div>
               <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
             <input id="password" name="password" class="form-control "  type="password" required autocomplete="new-password">
             
             
             
           </div>

           <div class="form-group input-group">
            <div class="leb">
                <label for="password">Confirm Password</label>
              </div>
               <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
             <input id="confirm_password" name="password_confirmation" class="form-control "  type="password" required autocomplete="new-password">
             
             
            </div>
            <div class="form-group input-group">
              <span class="help-block" id="message"></span>
            </div> 
            

                                         
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit" style=""> Create Account  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
     </div> 
    </div>
   </div>
  </div>
</div>
</section>



<!-- User_Edit Modal -->
<section>

<div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'edituser', 'id'=>'user_edit_form',  'method' =>'POST'))}}
         

         <input type="hidden" name="id" id="user_id">
         <div class="leb">
                <label for="username">Username</label>
              </div>
           <div class="form-group input-group">
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
               <input name="username" id="username" class="form-control"  type="text">
             </div>

             <div class="form-group input-group">
              <div class="leb">
                <label for="full_name">Full Name</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fa fa-user"></i> </span>
             </div>
               <input name="full_name" id="full_name" class="form-control"  type="text">
             </div>

             <div class="form-group input-group">
              <div class="leb">
                <label for="mobile">Mobile</label>
              </div>
             <div class="input-group-prepend">
               <span class="input-group-text"> <i class="fas fa-mobile" style="font-size: 20px;"></i> </span>
             </div>
             
               <input name="mobile" id="mobile" class="form-control"  type="text">
             </div>


               <div class="form-group input-group">
                <div class="leb">
                <label for="email">Email Address</label>
              </div>
                  <div class="input-group-prepend">
                  <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
              </div>
                <input name="email" id="email" class="form-control"  type="email">
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
                 {!! Form::select('status', $status, null, ['class' => 'form-control', 'id' =>'status_data' ]) !!}
             
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


<!-- User_Delete Modal -->
<section>

<div class="modal fade" id="user_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
{{ Form::open(array('url' => 'deleteuser', 'id'=>'user_delete_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="del_user_id">
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
        "url": "{{URL::to('userdata')}}",
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
                
                {"data": "username"},
                {"data": "full_name"},
                {"data": "mobile"},
                {"data": "email"},
                {"data": "role"},
                {"data": "status"},
                {"data": "action"},
            ]
    });

// Update user
    table.on('click' , '.user_edit' , function(){
      var username = $(this).attr('username');
      var full_name = $(this).attr('full_name');
      var mobile = $(this).attr('mobile');
      var statuss = $(this).attr('user_status');
      var email = $(this).attr('email');
      var id = $(this).attr('href');
      $('#username').val(username);
      $('#full_name').val(full_name);
      $('#mobile').val(mobile);
      $('#status_data').val(statuss);
      $('#email').val(email);
      $('#user_id').val(id);

    });

// Password Matching
    $('#password, #confirm_password').on('keyup', function () {

            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else {
                $('#message').html('Password Does Not Match').css('color', 'red');
            }
        });
     
  // User Delete
    table.on('click' , '.user_delete' , function(){
      var id = $(this).attr('href');
            $('#del_user_id').val(id);
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