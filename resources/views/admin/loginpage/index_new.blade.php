<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Admin | Login</title>
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
  <link href="{{asset('admin/login/newlogin/font_loginpage_new.css')}}" rel="stylesheet"><link rel="stylesheet" href="{{asset('admin/login/newlogin/style.css')}}">

  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  

</head>

<body style="background:url('{{asset('admin/login/newlogin/bg-02.jpg')}}') " >

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

{{ Form::open(array('url' => 'login', 'method' =>'POST', 'class' =>'login' )) }}
 
 <div><h2>House Rent</h2></div>
  <input type="text" autocomplete="off" name="username" required placeholder="Username">
  <input type="password" type="password" autocomplete="off" name="password" required placeholder="Password">
  <button type="submit">Login</button>
<div style="text-align: center; color: white; background-color: #f24353; background-color: #f24353; display: block; border-radius: 5px;"><span>{{ $errors->first('username') }} </span></div>

@if ($message = Session::get('warning'))
<div style="text-align: center; color: #828282; background-color: #A3E4D7; display: block; border-radius: 5px;">
   <span>{{ $message }}</span>
</div>
@endif
{{ Form::close() }}

</div>

<!-- <script src="{{asset('admin/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 7000
    });
    

   <?php if($errors->any()): ?>
      Toast.fire({
        icon: 'error',
        <?php foreach ($errors->all() as $error): ?>
        title: '<?php echo "&nbsp; $error" ?>',
       <?php endforeach; ?>
    
      })
      
   <?php endif ?>
   <?php if($message = Session::get('warning')): ?>
      Toast.fire({
        icon: 'warning',
        title: '<?php echo "&nbsp; $message" ?>',
      })
      
   <?php endif ?>
   });
</script> -->
</body>
</html>