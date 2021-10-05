@extends('layouts.admin')

@section('styles')

<link rel="stylesheet" href="{{asset('admin/tower-file-input.css')}}">
<style type="text/css">

  .cfont{
    font-family:Arial, Helvetica, sans-serif;
    font-size:13px;
  }

  .form-g{
   width: 90px;
  
  }
</style>
@endsection

@section('content')

<div class="content-wrapper">
<section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font_s">EDIT Apartment</h1>


             
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0" style="background: #454545;"><a style="color: #fff;" href="{{URL::to('aplist')}}"><i class="fas fa-arrow-circle-left mr-2"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>

{{ Form::open(array('url' => 'apupdate', 'id'=>'user_add_form', 'method' =>'POST', 'enctype' => 'multipart/form-data' )) }}
 <input type="hidden" name="id" value="{{ $apartments->id }}">

      <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Apartment Details</h5>
                    </div>
                    <div class="body m-3"   >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Apartment Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="apartment_name" name="apartment_name" class="form-control" required placeholder="" value="{{ $apartments->apartment_name }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('apartment_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Apartment/House Number</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="house_number" name="house_number" class="form-control" required placeholder="" value="{{ $apartments->house_number }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('house_number') }}</span>

                                </div>
                            </div>
                            
                        </div>
                        </div>
                </div>
            </div>



            <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Address Details</h5>
                    </div>
                    <div class="body m-3"   >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Division</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>

                                        {!! Form::select('division_name',$division, $apartments->division_name, ['class'=>'form-control changeDivision','placeholder'=>'Select Division','required'])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('division_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">District</label>
                                    <div class="input-group ">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                                        
                                        {!! Form::select('district_name',$district, $apartments->district_name, ['class'=>'form-control changeDistrict','placeholder'=>'Select District','required'])!!}
                                        
                                
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('district_name') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Thana</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        
                                        {!! Form::select('upazilla_name', $upzila, $apartments->thana_name, ['class'=>'form-control changeUpazilla','placeholder'=>'Select Thana'])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('upazilla_name') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Post Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="post_name" name="post_name" 
                                               class="form-control" placeholder="" value="{{ $apartments->post_name }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('post_name') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Post Code</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="post_code" name="post_code" 
                                               class="form-control" placeholder="" value="{{ $apartments->post_code }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('post_code') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Area Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="area_name" name="area_name" required
                                               class="form-control" placeholder="" value="{{ $apartments->area_name }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('area_name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ng-binding">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-address-card" style="line-height: 100px; background: #e5e5e5; padding: 11px;"></i></span>
                                        <textarea id="address" name="address" rows="3" class="form-control" placeholder="Full Address">{{ $apartments->address }}</textarea>
                                    </div>
                                    <span class="help-block text-danger"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Apartment Photo</h5>
                    </div>
                    <div class="body m-3" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group required">
                                    <div class="tower-file">
                                      <input type="file" id="demoInput5" name="photo" />
                                      <label for="demoInput5" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Select Image
                                      </label>
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img id="demo6-image-preview" />
                                    </div>

                                </div>
                            </div>
                            
                            
                            
                        </div>

                    </div>
                </div>
            </div>

      <div class=" float-right form-g m-2">
             <button type="submit" class="btn btn-primary btn-block border-0" style="background-image: linear-gradient(to right, #7677ff,#b126f0);"> Submit  </button>
      </div>      
                                                                     
  {{ Form::close() }}



  </section>
</div>



@endsection




@section('scripts')


<script src="{{URL::to('admin/tower-file-input.js')}}"></script>


<!-- Image Uploaded -->
<script type="text/javascript">
    $(document).on('focus', ".datepicker", function() {
  $(this).datepicker();
});
    $(document).ready(function (){
        $('#demoInput6').fileInput({
          iconClass: 'mdi mdi-fw mdi-upload'
         });
        $('#demoInput5').fileInput({
                imgPreviewSelector: '#demo6-image-preview'
         });

    
  


// District Selection
  $('.changeDivision').on('change', function () {
            var divId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-district') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'divId': divId,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    var select = $('.changeDistrict');
                    select.find('option').remove();
                    if (res['districts'].length > 0) {
                        select.attr('disabled', false);
                        select.append('<option value="">Select District</option>'); 
                        
                        $.each(res['districts'], function (k, v) {
                            select.append('<option value=' + v.dis_name + '>' + v.dis_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Select District</option>');
                    }
                }
            });
        });


// Thana Selection
  $('.changeDistrict').on('change', function () {
            var disId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-thana') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'disId': disId,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    var select = $('.changeUpazilla');
                    select.find('option').remove();
                    if (res['thanas'].length > 0) {
                        select.attr('disabled', false);
                        select.append('<option value="">Select Thana</option>'); 
                        // select.append('<option value="All">All Thana</option>');
                        $.each(res['thanas'], function (k, v) {
                            select.append('<option value=' + v.up_name + '>' + v.up_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Select Thana</option>');
                    }
                }
            });
        });

        
  });

</script>

@endsection

