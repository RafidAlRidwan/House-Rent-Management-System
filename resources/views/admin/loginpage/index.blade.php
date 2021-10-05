<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{asset('admin/login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('admin/login/css/main.css')}}">

  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
<!--===============================================================================================-->
</head>
<body>

  
  <div class="limiter">
    <div class="container-login100 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-image: url('{{asset('admin/login/images/bg-01.jpg')}}');">
    
      <div class="wrap-login100">

        {{ Form::open(array('url' => 'login', 'method' =>'POST' )) }}
          <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
          </span>

          <span class="login100-form-title p-b-34 p-t-27">
            Log in
          </span>
          <!-- <span class="help-block text-warning text-center p-2">{{ $errors->first('username') }}</span> -->
   
          <div class="wrap-input100 validate-input" data-validate = "Enter username">
            <input class="input100" type="text" autocomplete="off" name="username" required placeholder="Username">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
          </div>
          

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" autocomplete="off" name="password" required placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
          </div>



          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>

          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Login
            </button>
          </div>
        

          <div class="text-center p-t-90">
            <a class="txt1" href="">
              
            </a>
            
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('admin/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('admin/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('admin/login/js/main.js')}}"></script>
  <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>

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
        title: '<?php echo"<li> $error </li>" ?>',
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
</script>

  

</body>
</html>
