<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>

  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/admin_all_button.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('admin/custom_font.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/plugins/toastr/toastr.min.css')}}">
  <style>
      .preloader {
  background-color: #f7f7f7;
  width: 100%;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 999999;
  -webkit-transition: .6s;
  -o-transition: .6s;
  transition: .6s;
  margin: 0 auto;
}

/* line 611, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.preloader .preloader-circle {
  width: 100px;
  height: 100px;
  position: relative;
  border-style: solid;
  border-width: 1px;
  border-top-color: #ff3e3f;
  border-bottom-color: transparent;
  border-left-color: transparent;
  border-right-color: transparent;
  z-index: 10;
  border-radius: 50%;
  -webkit-box-shadow: 0 1px 5px 0 rgba(35, 181, 185, 0.15);
  box-shadow: 0 1px 5px 0 rgba(35, 181, 185, 0.15);
  background-color: #fff;
  -webkit-animation: zoom 2000ms infinite ease;
  animation: zoom 2000ms infinite ease;
  -webkit-transition: .6s;
  -o-transition: .6s;
  transition: .6s;
}

/* line 633, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.preloader .preloader-circle2 {
  border-top-color: #0078ff;
}

/* line 636, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.preloader .preloader-img {
  position: absolute;
  top: 50%;
  z-index: 200;
  left: 0;
  right: 0;
  margin: 0 auto;
  text-align: center;
  display: inline-block;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  padding-top: 6px;
  -webkit-transition: .6s;
  -o-transition: .6s;
  transition: .6s;
}

/* line 654, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.preloader .preloader-img img {
  max-width: 55px;
}

/* line 657, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.preloader .pere-text strong {
  font-weight: 800;
  color: #dca73a;
  text-transform: uppercase;
}
@-webkit-keyframes zoom {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .6s;
    -o-transition: .6s;
    transition: .6s;
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
    -webkit-transition: .6s;
    -o-transition: .6s;
    transition: .6s;
  }
}

@keyframes zoom {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: .6s;
    -o-transition: .6s;
    transition: .6s;
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
    -webkit-transition: .6s;
    -o-transition: .6s;
    transition: .6s;
  }
}

/* line 697, C:/Users/HP/Desktop/jun-2020/278.Internet_service/assets/scss/_common.scss */
.slick-initialized .slick-slide {
  outline: 0;
}

  </style>
   @yield('styles')
  <style>
    #demo6-image-preview{
      width: 400px;
    }

  

  </style>

  
 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('img/favicon.ico') }}" alt="">
                </div>
            </div>
        </div>
    </div>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown ">
        
          <button style="font-size: 20px;" class="text-dark btn dropdown-toggle border-0 btn_admin" style="background: none;"   type="button" id="dropdownMenuButton" data-toggle="dropdown"   aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
         </button>
          
        </a>
        {{ Form::open(array('url' => 'logout', 'method' =>'POST')) }}
          
          <div class="dropdown-menu tbl_color" aria-labelledby="dropdownMenuButton">
            
            <button class="dropdown-item text-center text-light logout" style="background: none;" type="submit"><span><i class="fas fa-sign-out-alt"></i> Logout  </span></button>
         </div>
       {{ Form::close() }}
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="">T</i>
        </a> -->
      </li>
    </ul>
  </nav>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="{{URL::to('admin.home')}}" class="brand-link text-center bg-light">
      
      <span class="brand-text font-weight-light x_font " style="font-size: 22px;">House Rent</span>
    </a>

    
    <div class="sidebar">
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li  class="nav-item has-treeview menu-open">
            <a style="background-image: linear-gradient(to right, #7677ff,#b126f0); color: #fff;" href="{{URL::to('admin.home')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="x_font">
                Dashboard
                <i class="right "></i>
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="{{URL::to('userlist')}}" class="nav-link btn_home_l">
              <i class=" nav-icon fas fa-users"></i>
              <p>Users List
                
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>

          <li class="nav-item has-treeview">
            <a href="{{URL::to('aplist')}}" class="nav-link btn_home_r">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Apartment
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>


          <li class="nav-item has-treeview">
            <a href="{{URL::to('renterlist')}}" class="nav-link btn_home_l">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Renter
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>

          <li class="nav-item has-treeview">
            <a href="{{URL::to('rentpaidhistory')}}" class="nav-link btn_home_r">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Rent Paid History
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link btn_home_l">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('costsector')}}" class="nav-link btn_home_r">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cost Sector </p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="{{URL::to('expense')}}" class="nav-link btn_home_l">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense </p>
                </a>
              </li>       
            </ul>
          </li>
        


         
          
         
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
   

            @yield('content')
          
  </div>
     </div>
  </div>
  
  

  
  <aside class="control-sidebar control-sidebar-dark">
    
  </aside>
  
</div>



<script src="{{asset('admin/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<script src="{{asset('admin/dist/js/demo.js')}}"></script>

<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::to('admin/tower-file-input.js')}}"></script>

<script src="{{URL::to('admin/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('admin/jquery.counterup.js')}}"></script>
<script src="{{asset('admin/jquery.waypoints.js')}}"></script>
<script>
    $(window).on('load', function () {
      $('#preloader-active').delay(450).fadeOut('slow');
      $('body').delay(450).css({
        'overflow': 'visible'
      });
    });
</script>
@yield('scripts')
</body>
</html>
