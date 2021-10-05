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
            <h1 class="font_s">Add Renter</h1>


             
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0" style="background: #454545;"><a style="color: #fff;" href="{{URL::to('renterlist')}}"><i class="fas fa-arrow-circle-left mr-2"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>

{{ Form::open(array('url' => 'flatstore', 'id'=>'renter_add_form', 'method' =>'POST', 'autocomplete'=>'off', 'enctype' => 'multipart/form-data' )) }}

      <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Renter Details</h5>
                    </div>
                    <div class="body m-3"   >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Renter Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="renter_name" name="renter_name" class="form-control" required placeholder="" value="{{ old('renter_name') }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('renter_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Renter Type</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <select name="renter_type" class="form-control">
                                          <option value="1">Family</option>
                                          <option value="2">Bechalor</option>
                                          <option value="3">Office</option>
                                        </select>
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('renter_type') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Apartment</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        {!! Form::select('apartment_id',$apartments,null, ['class'=>'form-control changeAp','placeholder'=>'Select Apartment','required'])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('apartment_id') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Flat</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <select name="flat_id" disabled="disabled" class="form-control changeFlat">
                                           <option value="">Select Flat</option>
                                        </select>
                                    <span class="help-block text-danger">{{ $errors->first('flat_id') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label cfont">Flat Rent</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <select name="flat_rent" disabled="disabled" class="form-control changeRent">
                                           <option value="">Rent</option>
                                        </select>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label cfont">Advance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="advance" name="advance" class="form-control" required placeholder="" value="{{ old('advance') }}">
                                    
                                </div>
                            </div>
                        </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Start Month</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-calendar" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <div class="form-group">
                  
                    <input name="start_month" id='datepicker' data-date-autoclose="true" required
                                               class="form-control" data-date-format="yyyy-mm-dd" >
                </div>
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('start_month') }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Renter Address Details</h5>
                    </div>
                    <div class="body m-3"   >
                        <div class="row">

                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Division</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>

                                        {!! Form::select('division_name',$division,null, ['class'=>'form-control changeDivision','placeholder'=>'Select Division','required'])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('division_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">District</label>
                                    <div class="input-group ">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                                        <select name="district_name" disabled="disabled" class="form-control changeDistrict">
                                           <option value="">Select District</option>
                                        </select>
                                
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('district_name') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Thana</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <select name="thana_name" disabled="disabled" class="form-control changeUpazilla">
                                           <option value="">Select Thana</option>
                                        </select>
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
                                               class="form-control" placeholder="">
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
                                               class="form-control" placeholder="" >
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('post_code') }}</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Village Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="village_or_are_name" name="village_or_are_name" required
                                               class="form-control" placeholder="" >
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('village_or_are_name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ng-binding">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-address-card" style="line-height: 100px; background: #e5e5e5; padding: 11px;"></i></span>
                                        <textarea id="address" name="address" rows="3" class="form-control" placeholder="Full Address"></textarea>
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('address') }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Renter Personal Information</h5>
                    </div>
                    <div class="body m-3" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Mobile No</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-mobile-alt" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="mobile" name="mobile" required
                                               class="form-control" placeholder="" >
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('mobile') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Occupation</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-briefcase" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="occupation" name="occupation" required
                                               class="form-control" placeholder="" >
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('occupation') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Work Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-address-card" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="work_address" name="work_address" required
                                               class="form-control" placeholder="">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('work_address') }}</span>
                                </div>
                            </div>

                            

                            

                            
                            
                            
                            
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Renter Photo Section</h5>
                    </div>
                    
                        
                            

                            

                            
                    <div class="body m-3" >
                        <div class="row">
                    
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group">
                                    <div class="tower-file">
                                      <input type="file" id="demoInput1" name="renter_photo" />
                                      <label for="demoInput1" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter Photo
                                      </label>
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img style="width: 100px;" id="demo11-image-preview" />
                                    </div> 
                               </div>
                       </div>
                  </div>
              </div>
              
                 <div class="body m-3" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group">
                                    <div class="tower-file">
                                      
                                      <label for="demoInput2" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter NID Photo
                                      </label>
                                      <input type="file" id="demoInput2" name="nid_photo" />
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img style="width: 100px;" id="demo22-image-preview" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="body m-3" >
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group">
                                    <div class="tower-file">
                                      
                                      <label for="demoInput3" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter PoliceInfo Photo
                                      </label>
                                      <input type="file" id="demoInput3" name="renter_policeinfo_photo" />
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img style="width: 100px;" id="demo33-image-preview" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                            
                            
                            
                        </div>

                    </div>
                </div>
            </div>

            


      <div class=" float-right form-g m-2">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Submit  </button>
      </div> 

           
                                                                     
  {{ Form::close() }}



  </section>
</div>



@endsection




@section('scripts')




<!-- Image Uploaded -->
<script type="text/javascript">
    $(document).ready(function (){


    $('#datepicker').datepicker();


   // Photo Section 1

   $('#demoInput1').fileInput({
          iconClass: 'mdi mdi-fw mdi-upload'
         });
        $('#demo11-image-preview').fileInput({

           imgPreviewClass:null
       });




   // Photo Section 2
   $('#demoInput2').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
    }); 
   $('#demo22-image-preview').fileInput({

           imgPreviewClass:null
       });

   


   // Photo Section 3
   $('#demoInput3').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
    });
   $('#demo33-image-preview').fileInput({

           imgPreviewClass:null
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
                        // select.append('<option value="All">All District</option>');
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


       // Flat Selection
  $('.changeAp').on('change', function () {
            var flId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-flat') }}",
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
                        select.append('<option value="">Select Flat</option>'); 
                        $.each(res['flat'], function (k, v) {
                            select.append('<option value=' + v.id + '>' + v.flat_name + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Select Flat</option>');
                    }
                }
            });
        });


    $('.changeFlat').on('change', function () {
            var flId = $(this).val();
            $.ajax({
                url: "{{ URL::to('get-rent-amount') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    'flId': flId,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (res) {
                    var select = $('.changeRent');
                    select.find('option').remove();
                    if (res['flat_rent'].length > 0) {
                        select.attr('disabled', true);
                        // select.append('<option value="">Flat Rent</option>'); 
                        $.each(res['flat_rent'], function (k, v) {
                            select.append('<option value=' + v.flat_rent + '>' + v.flat_rent + '</option>'); 
                        });
                    } else {
                        select.attr('disabled', true);
                        select.append('<option value="">Flat Rents</option>');
                    }
                }
            });
        });


       

       
  });

</script>

@endsection

