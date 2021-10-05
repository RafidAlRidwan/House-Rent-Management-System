@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
  
   
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
      <div class="container-fluid">
        
        
        <div class="row">
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="num">{{$flat}}</h3>

                <p>Total Flat</p>
              </div>
              <div class="icon">
                
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="num">{{$flat_rent}}</h3>

                <p>Total Flat in Rent</p>
              </div>
              <div class="icon">
                
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="num">{{$income}}</h3>

                <p>Total Income</p>
              </div>
              <div class="icon">
                
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>

          </div>
          
          <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
              <div class="inner">
            <h3 class="num">{{$expense}}</h3>

                <p>Total Expense</p>
              </div>
              <div class="icon">
                
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          
      </div>
    </section>


</div>

@endsection

@section('scripts')



<script type="text/javascript">
  $(".num").counterUp({delay:10, time:1500});
</script>


<!-- FLASH MESSAGE -->

<script> 
  $(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 6000
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
   <?php if($message = Session::get('info')): ?>
      Toast.fire({
        icon: 'info',
        title: '<?php echo "&nbsp; $message" ?>',
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
@endsection