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
            <h1 class="font_s">Edit Renter</h1>

           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0" style="background: #454545;"><a style="color: #fff;" href="{{URL::to('renterlist')}}"><i class="fas fa-arrow-circle-left mr-2"></i>Back</a>  </button> 
            </ol>
          </div>
        </div>
      </div>

{{ Form::open(array('url' => 'renterupdate', 'id'=>'renter_edit_form', 'method' =>'POST', 'files' => true )) }}

    <input type="hidden" name="renter_id" value="{{$renter->id}}">
      <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Renter Details</h5>
                    </div>
                    <div class="body m-3">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Renter Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="renter_name" name="renter_name" class="form-control" required placeholder="" value="{{ $renter->renter_name }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('renter_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Renter Type</label>
                                    <div class="input-group">
                                        @php
                                        $renterType = [
                                        1 => 'Family',
                                        2 => 'Bachalor',
                                        3 => 'Office'
                                        ]
                                        @endphp
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        {!! Form::select('renter_type', $renterType, $renter->renter_type, ['class'=>'form-control', 'placeholder'=>'Select Renter Type','required' ])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('renter_type') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Apartment</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        {!! Form::select('apartment_id', $apartments, $renter->apartment_id, ['class'=>'form-control changeAp','placeholder'=>'Select Apartment','required' ])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('apartment_id') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Flat</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-building" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        {!! Form::select('flat_id', $flat, $renter->flat_id, ['class'=>'form-control changeFlat','placeholder'=>'Select Flat','required' ])!!}
                                    <span class="help-block text-danger">{{ $errors->first('flat_id') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Advance Recieve</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="text" id="advance_amount" name="advance_amount" class="form-control" disabled="disabled" required placeholder="" value="{{$renter->advance_amount}}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('advance_amount') }}</span>

                                </div>
                            </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">New Advance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <input type="number" id="new_advance_amount" name="new_advance_amount" class="form-control" placeholder="">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('advance_amount') }}</span>

                                </div>
                            </div>

                            
                            </div>
                        </div>

                    </div>
                </div>
            
         <div class="col-lg-12"  >
                <div class="card">
                    <div class="header">
                        <h5 style="margin: 15px;">Select Month</h5>
                    </div>
                    <div class="body m-3"   >
                        <div class="row">

                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Start Month</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-calendar" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        <div class="form-group">
                  
                                        <input name="start_month" id='datepicker' data-date-autoclose="true" required
                                               class="form-control" data-date-format="yyyy-mm-dd" value="{{$renter->start_month}}">
                        
                        
                            
                        
                                     </div>
                                    </div>
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('start_month') }}</span>
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

                                        {!! Form::select('division_name', $division, $renter->division_name, ['class'=>'form-control changeDivision','placeholder'=>'Select Division','required'])!!}
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('division_name') }}</span>

                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">District</label>
                                    <div class="input-group ">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                  
                                        {!! Form::select('district_name',$district, $renter->district_name, ['class'=>'form-control changeDistrict','placeholder'=>'Select District','required'])!!}
                                
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('district_name') }}</span>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group required">
                                    <label class="control-label cfont">Thana</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-city" style="background: #e5e5e5; padding: 11px;"></i></span>
                                        {!! Form::select('upazilla_name',$upzila, $renter->thana_name, ['class'=>'form-control changeUpazilla','placeholder'=>'Select Thana','required'])!!}
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
                                               class="form-control" placeholder="" value="{{ $renter->post_name }}">
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
                                               class="form-control" placeholder="" value="{{ $renter->post_code }}">
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
                                               class="form-control" placeholder="" value="{{ $renter->village_or_are_name }}">
                                    </div>
                                    <span class="help-block text-danger">{{ $errors->first('village_or_are_name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label ng-binding">Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-address-card" style="line-height: 100px; background: #e5e5e5; padding: 11px;"></i></span>
                                        <textarea id="address" name="address" rows="3" class="form-control" placeholder="Full Address">{{$renter->address }}</textarea>
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
                                               class="form-control" placeholder="" value="{{ $renter->mobile }}">
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
                                               class="form-control" placeholder="" value="{{ $renter->occupation }}">
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
                                               class="form-control" placeholder="" value="{{ $renter->work_address }}">
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
                                <div class="form-group required">
                                    <div class="tower-file">
                                      
                                      <label  for="demoInput1" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter Photo
                                      </label>
                                      <input type="file" id="demoInput1" name="renter_photo" value="{{ $renter->renter_photo }}" />
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img id="demo1-image-preview" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                          

                    <div class="body m-3" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group required">
                                    <div class="tower-file">
                                      
                                      <label for="demoInput2" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter NID Photo
                                      </label>
                                      <input type="file" id="demoInput2" name="nid_photo" value="{{ $renter->nid_photo }}" />
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img id="demo2-image-preview" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                         

                         
                    <div class="body m-3" >
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 cfont">
                                <div class="form-group required">
                                    <div class="tower-file">
                                      
                                      <label for="demoInput3" class="btn btn-primary">
                                      <span class="mdi mdi-upload"></span><i class="fas fa-images"></i> Renter PoliceInfo Photo
                                      </label>
                                      <input type="file" id="demoInput3" name="renter_policeinfo_photo" value="{{ $renter->renter_policeinfo_photo }}" />
                                      <button type="button" class="btn btn-secondary tower-file-clear align-top">
                                       Clear
                                     </button>
                                    </div>
                                    <div>
                                       <img id="demo3-image-preview" />
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

<section>

<div class="modal fade" id="user_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
   $('#demoInput1').fileInput({
                imgPreviewSelector: '#demo1-image-preview'
    });




   // Photo Section 2
   $('#demoInput2').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
    }); 
   $('#demoInput2').fileInput({
                imgPreviewSelector: '#demo2-image-preview'
    });

   


   // Photo Section 3
   $('#demoInput3').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
    });
   $('#demoInput3').fileInput({
                imgPreviewSelector: '#demo-image-preview'
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


       

       
  });

</script>

@endsection

