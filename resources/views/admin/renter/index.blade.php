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

    
    .cus{
      margin-left: 15px;
      margin-top: 5px;
      font-family:Arial, Helvetica, sans-serif; 
      font-size:14px;
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
            <h1 class="font_s">Renter List</h1>
           </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <button class=" breadcrumb-item  btn btn-info border-0 btn_add"><a style="color: #fff;" href="{{URL::to('rencreate')}}"><i class="fas fa-plus mr-1"></i>Add</a>  </button> 
            </ol>
          </div>
        </div>
      </div>


          <div class="card inc">
                            
              <div class="card-body">
              
              <div class="input-group mb-2">

                  <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Month</label>
                              <div class="input-group-prepend">
                                
                                <?php
                                $months = [
                                    '0' => 'Select Month',
                                    '1' => 'January',
                                    '2' => 'February',
                                    '3' => 'March',
                                    '4' => 'April',
                                    '5' => 'May',
                                    '6' => 'June',
                                    '7' => 'July',
                                    '8' => 'August',
                                    '9' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December'
                                ];

                                $monthSelected = date('m');
                                ?>
                                {{ Form::select('filter_month', $months, $monthSelected, ['class' => 'form-control leb monthSelected']) }}

                            </div>
                          </div>

                            <div class="leb input-daterange form-group col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Year</label>
                              <div class="input-group-prepend">
 
                                <?php
                                $selYear = date('Y');
                                $year = [
                                    '0' => 'Select Year',
                                    
                                    date('Y', strtotime('-5 years')) => date('Y', strtotime('-5 years')),
                                    date('Y', strtotime('-4 years')) => date('Y', strtotime('-4 years')),
                                    date('Y', strtotime('-3 years')) => date('Y', strtotime('-3 years')),
                                    date('Y', strtotime('-2 years')) => date('Y', strtotime('-2 years')),
                                    date('Y', strtotime('-1 years')) => date('Y', strtotime('-1 years')),
                                    date('Y') => date('Y'),
                                    date('Y', strtotime('+1 years')) => date('Y', strtotime('+1 years')),
                                    
                                ];
                                ?>
                                {{ Form::select('filter_year', $year, $selYear, ['class' => 'form-control leb yearSelected']) }}

                            </div>

                        </div>
                      </div>


                <table  id="jsTable" class="table table-bordered table-striped" >
                  <thead class="tbl_color">
                  <tr>
      
                    <th>Renter Personal Info</th>
                    <th>Apartment Details</th>
                    <th>Renter Address Details</th>
                    <th>Rent Start Date</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
               <tfoot>
                <tr>
      
                    <th>Renter Personal Info</th>
                    <th>Apartment Details</th>
                    <th>Renter Address Details</th>
                    <th>Rent Start Date</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 60px;">Action</th>
                    
                  </tr>
              </tfoot>
             </table>
          </div>
  </section>
</div>

<section>

<div class="modal fade" id="renter_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
{{ Form::open(array('url' => 'deleterenter', 'id'=>'renter_delete_form', 'method' => 'POST')) }}
    <div class="modal-body">

      <p>Are you sure?</p>
      <div class="modal-footer">
        <input type="hidden" name="id" id="renter_user_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submitdl" class="btn btn-primary border-0 btn_submit">Yes</button>
      </div>

    </div>
    {{ Form::close() }}
  </div>
 </div> 
</div>

</section>


<section>
  <div class="modal fade" id="renter_extra_bill_modal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <div style="display: block;">
              <h4 class="cus">Apartment Name: <span class="text-info apartment_name"></span> &nbsp</h4>
              <h4 class="cus">Flat Name: <span class="text-info flat_n"></span>&nbsp</h4>
              <h4 class="cus">Flat rent: <span class="text-info flat_rent"></span>&nbsp</h4>
            
              <h4 class="cus">Start Month: <span class="text-info rent_start_month"></span>&nbsp</h4>
              <h4 class="cus">Renter Name: <span class="text-info renter_name"></span>&nbsp</h4>
              </div>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'utility_bill', 'autocomplete'=>'off', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="flat_id" id="flat_id">
        <input type="hidden" name="apartment_id" id="apartment_id">
        <input type="hidden" name="renter_id" id="renter_id">

            
            <div class="header">
                        <div class="row leb input-group">
                          <div class="input-daterange form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Month</label>
                              <div class="input-group-prepend">
                                <span class="rounded-0 input-group-text" ><i class="fas fa-calendar-alt"></i></span>
                                <?php
                                $months = [
                                    '0' => 'Select Month',
                                    '1' => 'January',
                                    '2' => 'February',
                                    '3' => 'March',
                                    '4' => 'April',
                                    '5' => 'May',
                                    '6' => 'June',
                                    '7' => 'July',
                                    '8' => 'August',
                                    '9' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December'
                                ];

                                $monthSelected = date('m');
                                ?>
                                {{ Form::select('month', $months, $monthSelected, ['class' => 'rounded-0 form-control monthSelected']) }}

                            </div>
                          </div>

                            <div class="input-daterange form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                              <label>Select Year</label>
                              <div class="input-group-prepend">
                               <span class="rounded-0 input-group-text" ><i class="fas fa-calendar-alt"></i></span>
                       
                                
                                <?php
                                $selYear = date('Y');
                                $year = [
                                    '0' => 'Select Year',
                                    
                                    date('Y', strtotime('-5 years')) => date('Y', strtotime('-5 years')),
                                    date('Y', strtotime('-4 years')) => date('Y', strtotime('-4 years')),
                                    date('Y', strtotime('-3 years')) => date('Y', strtotime('-3 years')),
                                    date('Y', strtotime('-2 years')) => date('Y', strtotime('-2 years')),
                                    date('Y', strtotime('-1 years')) => date('Y', strtotime('-1 years')),
                                    date('Y') => date('Y'),
                                    date('Y', strtotime('+1 years')) => date('Y', strtotime('+1 years')),
                                    
                                ];
                                ?>
                                {{ Form::select('year', $year, $selYear, ['class' => 'rounded-0 form-control yearSelected']) }}

                            </div>

                        </div>
                      </div>



              <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Electricity Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text" ><i class="fas fa-money-check-alt"></i></span>
                       
                    <input type="number" name="electricity_bill" class="rounded-0 form-control" required>

                    </div> 
                  </div>
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Water Bill</label>
                  <div class="input-group-prepend">
                    
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="water_bill" class="rounded-0 form-control" required>
                  </div>
                  </div>
                </div>
             

           <div class="leb input-group mb-3 row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <label>Gas Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                       
                    <input type="number" name="gas_bill" class="rounded-0 form-control" required>
                </div>
              </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Security Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="security_bill" class="rounded-0 form-control" required>
              </div>
            </div>
          </div>


              <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Others Utility Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="others_utility_bill" class="rounded-0 form-control" required>
                  </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Others Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="others_bill" class="rounded-0 form-control" required>
              </div>
            </div>
          </div>
             

    
                  
              <div class="leb input-group mb-3 row ">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label>Garage Bill</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="garage_bill" class="rounded-0 form-control" required>
                  </div>
                </div>
             </div>
                                
                           
                                   
                                         
           <div class="form-group">
             <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Submit  </button>
          </div>      
                                                                     
         {{ Form::close() }}
       </article>
            </div>
            <!-- <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</section>

<!-- REGULAR PAYMENT -->

<section>
<div class="modal fade" id="pay_bill_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="letter-spacing: 2px; text-transform: uppercase;" class= "modal-title" id="exampleModalLabel">
           Rent Pay Month:
          
           <span class="text-danger rent_pay_month_pay_bill"></span></h5>

        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>



      </div>
 
      <div class="row mb-4">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs-new2">
                            <li class="nav-item " style="width: 50%">
                                <a class="nav-link license active show text-center" onMouseOver="this.style.backgroundColor='#EBF5FB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" data-toggle="tab" style="font-size: 15px; letter-spacing: 2px; text-transform: uppercase;" href="#regular">Regular Billing</a>
                            </li>

                            <li class="nav-item" style="width: 50%"><a style="font-size: 15px; letter-spacing: 2px; text-transform: uppercase;" onMouseOver="this.style.backgroundColor='#EBF5FB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" class="nav-link text-center" data-toggle="tab" href="#partial">Partial Billing</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>

    <div class="tab-content">
      <div class="tab-pane show active" id="regular">
      <div class="ml-4 mt-2" style="display: block;">
        <h4 class="cus">Amount Total: <span class="text-danger total_rent_popup"></span>&nbsp</h4>
        <h4 class="cus">Current Flat rent: <span class="text-info flat_rent_pay_bill"></span>&nbsp</h4>
        <h4 style="width: 90%" class="cus">Total Utility Bill: <span class="text-info utility_bill_pay_bill"></span>= (Electricity Bill: <span class="text-info electricity_bill"></span> + Water Bill: <span class="text-info water_bill"></span> + Gas Bill: <span class="text-info gas_bill"></span> + Security Bill: <span class="text-info security_bill"></span> + Garage Bill: <span class="text-info garage_bill"></span> + Others Utility Bill: <span class="text-info others_utility_bill"></span> + Others Bill: <span class="text-info others_bill"></span>)</h4>
        <h4 class="cus">Apartment Name: <span class="text-info apartment_name_pay_bill"></span> &nbsp</h4>
        <h4 class="cus">Flat Name: <span class="text-info flat_name_pay_bill"></span>&nbsp</h4>
        <h4 class="cus">Renter Name: <span class="text-info renter_name_pay_bill"></span>&nbsp</h4>
      </div>
      

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'RentPay', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="flat_id" id="flat_id_pay_bill">
        <input type="hidden" name="apartment_id" id="apartment_id_pay_bill">
        <input type="hidden" name="renter_id" id="renter_id_pay_bill">
        <input type="hidden" name="flat_rent_amount" id="flat_rent_amount_pay_bill">
        <input type="hidden" name="utility_bill_amount" id="utility_bill_amount_pay_bill">
        <input type="hidden" name="paid_for_month" id="paid_for_month_pay_bill">
        <input type="hidden" name="utility_bill_total_rent" id="total_amount_pay_bill">
        <input type="hidden" name="amount" id="amount">
        <input type="hidden" name="utility_id" id="utility_id">


          <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label for="discount">Discount</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="discount" class="rounded-0 form-control">
                  </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                <label for="additional">Additional Amount</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text" ><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="additional" class="rounded-0 form-control">
              </div>
            </div>
          </div>


       <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label for="paid_from_advance">Deduct from Advance</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="paid_from_advance" class="rounded-0 form-control">
                  </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="additional">Select Date</label>
                  <div class="text-center input-group-prepend">
                    <span class=" rounded-0 input-group-text" style="width: 50px;" ><i class="fas fa-calendar"></i></span>
                  
                   <input id="datepicker" name="payment_date" class="rounded-0 form-control" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" required>
              </div>
            </div>
          </div>

          <div class="leb input-group mb-3 row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label for="comments">Comment</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-comments-dollar"></i></span>
                        
                    <input style="height: 70px;" type="text" name="comments" class="rounded-0 form-control">
                  </div>
                </div>
               
              </div>

                                         
               <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Pay Rent  </button>
              </div>      
                                                                         
             {{ Form::close() }}
           </article>
          </div>
        </div>
  


  <!-- PARTIAL PAYMENT -->

     <div class="tab-pane" id="partial">
       <div class="ml-4 mt-2" style="display: block;">
        <h4 class="cus">Amount Total: <span class="text-danger total_rent_popup"></span>&nbsp</h4>
        <h4 class="cus">Current Flat rent: <span class="text-info flat_rent_pay_bill"></span>&nbsp</h4>
        <h4 style="width: 90%" class="cus">Total Utility Bill: <span class="text-info utility_bill_pay_bill"></span>= (Electricity Bill: <span class="text-info electricity_bill"></span> + Water Bill: <span class="text-info water_bill"></span> + Gas Bill: <span class="text-info gas_bill"></span> + Security Bill: <span class="text-info security_bill"></span> + Garage Bill: <span class="text-info garage_bill"></span> + Others Utility Bill: <span class="text-info others_utility_bill"></span> + Others Bill: <span class="text-info others_bill"></span>)</h4>


        <h4 class="cus">Apartment Name: <span class="text-info apartment_name_pay_bill"></span> &nbsp</h4>
        <h4 class="cus">Flat Name: <span class="text-info flat_name_pay_bill"></span>&nbsp</h4>
        <h4 class="cus">Renter Name: <span class="text-info renter_name_pay_bill"></span>&nbsp</h4>
      </div>
      

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'RentPay', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="flat_id" id="flat_id_pay_bill_partial">
        <input type="hidden" name="apartment_id" id="apartment_id_pay_bill_partial">
        <input type="hidden" name="renter_id" id="renter_id_pay_bill_partial">
        <input type="hidden" name="flat_rent_amount" id="flat_rent_amount_pay_bill_partial">
        <input type="hidden" name="utility_bill_amount" id="utility_bill_amount_pay_bill_partial">
        <input type="hidden" name="paid_for_month" id="paid_for_month_pay_bill_partial">
        <input type="hidden" name="utility_bill_total_rent" id="total_amount_pay_bill_partial">
        <input type="hidden" name="utility_id" id="utility_id">

          
          <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label class="text-success" for="amount">Payment Amount</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="amount" class="rounded-0 form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label for="discount">Discount</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="discount" class="rounded-0 form-control">
                  </div>
                </div>
               
          </div>

          <div class="leb input-group mb-3 row">
                
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                <label for="additional">Additional Amount</label>
                  <div class="input-group-prepend">
                    <span class="rounded-0 input-group-text" ><i class="fas fa-money-check-alt"></i></span>
                  
                   <input  type="number" name="additional" class="rounded-0 form-control">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label for="paid_from_advance">Deduct from Advance</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="paid_from_advance" class="rounded-0 form-control">
                  </div>
                </div>
          </div>


       <div class="leb input-group mb-3 row">
                
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="additional">Select Date</label>
                  <div class="text-center input-group-prepend">
                    <span class=" rounded-0 input-group-text" style="width: 50px;" ><i class="fas fa-calendar"></i></span>
                  
                   <input id="datepicker_partial" name="payment_date" class="rounded-0 form-control" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" required>
              </div>
            </div>
          </div>

          <div class="leb input-group mb-3 row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label for="comments">Comment</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-comments-dollar"></i></span>
                        
                    <input style="height: 70px;" type="text" name="comments" class="rounded-0 form-control">
                  </div>
                </div>
               
              </div>

                                         
               <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Pay Rent  </button>
              </div>      
                                                                         
             {{ Form::close() }}
           </article>
          </div>
    </div>
    </div>
  </div>
</div>
</section>
 

 

  <!-- Due PAYMENT -->
  <section>
  <div class="modal fade" id="pay_due_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mb-2">
        <h5 style="letter-spacing: 2px; text-transform: uppercase;" class= "modal-title" id="exampleModalLabel">
           Due Rent Payment: <span class="text-danger due_amount_month"></span></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
            
       <div class="ml-4 mt-2" style="display: block;">
        <h4 class="cus">Due Amount: <span class="text-danger due_amount"></span>&nbsp</h4>


        <h4 class="cus">Apartment Name: <span class="text-info apartment_name_pay_bill"></span> &nbsp</h4>
        <h4 class="cus">Flat Name: <span class="text-info flat_name_pay_bill"></span>&nbsp</h4>
        <h4 class="cus">Renter Name: <span class="text-info renter_name_pay_bill"></span>&nbsp</h4>
      </div>
      

      <div class="modal-body">
        <article class="card-body mx-auto" style="max-width: 800px;">


         
        {{ Form::open(array('url' => 'RentPay', 'id'=>'flat_edit_form', 'method' =>'POST'))}}
         

        <input type="hidden" name="flat_id" id="flat_id_pay_bill_due">
        
        <input type="hidden" name="renter_id" id="renter_id_pay_bill_due">


          
          <div class="leb input-group mb-3 row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <label for="due_amount">Amount</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-money-check-alt"></i></span>
                        
                    <input type="number" name="due_amount" class="rounded-0 form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label for="additional">Select Date</label>
                  <div class="text-center input-group-prepend">
                    <span class=" rounded-0 input-group-text" style="width: 50px;" ><i class="fas fa-calendar"></i></span>
                  
                   <input id="datepicker_due" name="payment_date" class="rounded-0 form-control" data-date-autoclose="true" autocomplete="off" data-date-format="yyyy-mm-dd" required>
              </div>
            </div>
                
               
          </div>



          <div class="leb input-group mb-3 row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label for="comments">Comment</label>
                  <div class="input-group-prepend">

                    <span class="rounded-0 input-group-text"><i class="fas fa-comments-dollar"></i></span>
                        
                    <input style="height: 70px;" type="text" name="comments" class="rounded-0 form-control">
                  </div>
                </div>
               
              </div>

                                         
               <div class="form-group">
                 <button type="submit" class="btn btn-primary btn-block border-0 btn_submit"> Pay Rent  </button>
              </div>      
                                                                         
             {{ Form::close() }}
           </article>
          </div>
    </div>
    </div>
  </div>
</div>
</section>

@endsection

@section('scripts')
<script type="text/javascript">

  $('#datepicker').datepicker();
  $('#datepicker_partial').datepicker();
  $('#datepicker_due').datepicker();

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
        "url": "{{URL::to('redata')}}",
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
                
                {"data": "renter_basic_info"},
                {"data": "apartment_info"},
                {"data": "address_details"},
                {"data": "start_month"},
                {"data": "status"},
                {"data": "action"}
            ]
    });

     // Renter Delete
    table.on('click' , '.renter_delete' , function(){
      var id = $(this).attr('href');
            $('#renter_user_id').val(id);
          });


    $('#jsTable').on('click', '.renter_extra_bill', function() {
      
           var flat_id = $(this).attr('href');
           var renter_id = $(this).attr('renter_id');
           var apartment_id = $(this).attr('apartment_id');
           var apartment_name = $(this).attr('apartment_name');
           var flat_name = $(this).attr('flat_name');
           var flat_rent = $(this).attr('flat_rent');
           var renter_name = $(this).attr('renter_name');
           var rent_start_month = $(this).attr('rent_start_month');

           $('#flat_id').val(flat_id);
           $('#renter_id').val(renter_id);
           $('#apartment_id').val(apartment_id);
           $('span.apartment_name').text(apartment_name);
           $('span.flat_n').text(flat_name);
           $('span.flat_rent').text(flat_rent);
           $('span.renter_name').text(renter_name);
           $('span.rent_start_month').text(rent_start_month);
        });


    $('.monthSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var monthSelected = $('.monthSelected').val();
            if (monthSelected != "") {
                filterables.month = monthSelected;
                $('#jsTable').data('dt_params', filterables);
                $('#jsTable').DataTable().draw();
            }
        });

    $('.yearSelected').on('change', function () {

            var previousFilter = $('#jsTable').data('dt_params');
            var filterables = {};
            if (previousFilter != undefined) {
                filterables = $('#jsTable').data('dt_params');
            }

            var yearSelected = $('.yearSelected').val();
            if (yearSelected != "") {
                filterables.year = yearSelected;
                $('#jsTable').data('dt_params', filterables);
                $('#jsTable').DataTable().draw();
            }
        });


    $('#jsTable').on('click', '.pay_bill', function() {
      
           var renter_id = $(this).attr('href');
           var utility_bill = $(this).attr('utility_bill');
           var total_rent = $(this).attr('total_rent');
           var flat_rent = $(this).attr('flat_rent');
           var flat_name = $(this).attr('flat_name');
           var apartment_name = $(this).attr('apartment_name');
           var renter_name = $(this).attr('renter_name');
           var rent_pay_month = $(this).attr('rent_pay_month');
           var apartment_id = $(this).attr('apartment_id');
           var flat_id = $(this).attr('flat_id');
           var paid_status = $(this).attr('paid_status');

           var u_id = $(this).attr('u_id');
           var electricity_bill = $(this).attr('electricity_bill');
           var water_bill = $(this).attr('water_bill');
           var gas_bill = $(this).attr('gas_bill');
           var security_bill = $(this).attr('security_bill');
           var garage_bill = $(this).attr('garage_bill');
           var others_utility_bill = $(this).attr('others_utility_bill');
           var others_bill = $(this).attr('others_bill');

           var due_amount = $(this).attr('due_amount');
           var due_amount_month = $(this).attr('due_amount_month');
           $('span.due_amount').text(due_amount);
           $('span.due_amount_month').text(due_amount_month);


           $('#renter_id_pay_bill').val(renter_id);
           $('#total_amount_pay_bill').val(total_rent);
           $('#flat_id_pay_bill').val(flat_id);
           $('#apartment_id_pay_bill').val(apartment_id);
           $('#flat_rent_amount_pay_bill').val(flat_rent);
           $('#utility_bill_amount_pay_bill').val(utility_bill);
           $('#paid_for_month_pay_bill').val(rent_pay_month);

           $('#renter_id_pay_bill_partial').val(renter_id);
           $('#total_amount_pay_bill_partial').val(total_rent);
           $('#flat_id_pay_bill_partial').val(flat_id);
           $('#apartment_id_pay_bill_partial').val(apartment_id);
           $('#flat_rent_amount_pay_bill_partial').val(flat_rent);
           $('#utility_bill_amount_pay_bill_partial').val(utility_bill);
           $('#paid_for_month_pay_bill_partial').val(rent_pay_month);
           $('#utility_id').val(u_id);

           $('#renter_id_pay_bill_due').val(renter_id);
           $('#flat_id_pay_bill_due').val(flat_id);


           $('span.paid_status_pay_bill').text(paid_status);
           $('span.utility_bill_pay_bill').text(utility_bill);
           $('span.total_rent_popup').text(total_rent);
           $('span.flat_rent_pay_bill').text(flat_rent);
           $('span.flat_name_pay_bill').text(flat_name);
           $('span.apartment_name_pay_bill').text(apartment_name);
           $('span.renter_name_pay_bill').text(renter_name);
           $('span.rent_pay_month_pay_bill').text(rent_pay_month);
           $('span.apartment_id_pay_bill').text(apartment_id);
           $('span.flat_id_pay_bill').text(flat_id);

           $('span.electricity_bill').text(electricity_bill);
           $('span.water_bill').text(water_bill);
           $('span.gas_bill').text(gas_bill);
           $('span.security_bill').text(security_bill);
           $('span.garage_bill').text(garage_bill);
           $('span.others_utility_bill').text(others_utility_bill);
           $('span.others_bill').text(others_bill);

           $('input[name = discount]').val(0);
           $('input[name = additional]').val(0);
           $('input[name = paid_from_advance]').val(0);
           $('input[name = amount]').val(0);
           $('input[name = due_amount]').val(0);

           
        });
    

    $('input[name = discount]').on('keyup', function () {
            var price = $('#total_amount_pay_bill').val();
            var discount = ($(this).val()) ? $(this).val() : 0;
            var additional = ($('input[name = additional]').val()) ? $('input[name = additional]').val() : 0;
            var collectableBill = parseInt(price) - parseInt(discount) + parseInt(additional);
            var due_rent_popup = parseInt(price) - parseInt(amount) - parseInt(discount);
            $('.total_rent_popup').text(collectableBill);


            
        });

    $('input[name = additional]').on('keyup', function () {
            var price = $('#total_amount_pay_bill').val();;
            var discount = ($('input[name = discount]').val()) ? $('input[name = discount]').val() : 0;
            var additional = ($(this).val()) ? $(this).val() : 0;
            var collectableBill = parseInt(price) - parseInt(discount) + parseInt(additional);
            $('.total_rent_popup').text(collectableBill);
            
        });
    
    $('input[name = paid_from_advance]').on('keyup', function () {
            var price = $('#total_amount_pay_bill').val();;
            var discount = ($('input[name = discount]').val()) ? $('input[name = discount]').val() : 0;
            var additional = ($('input[name = additional]').val()) ? $('input[name = additional]').val() : 0;
            var paid_from_advance = ($(this).val()) ? $(this).val() : 0;
            var collectableBill = parseInt(price) - parseInt(discount) + parseInt(additional) -parseInt(paid_from_advance);
            $('.total_rent_popup').text(collectableBill);
            
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
      timer: 10000
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

