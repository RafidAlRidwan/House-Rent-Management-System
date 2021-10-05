<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Apartment;
use App\Models\Flat;
use App\Models\RenterFlatRentHistory;
use App\Models\RenterRentPayHistory;
use App\Models\FlatRentHistory;
use App\Models\Utility;
use App\Models\District;
use App\Models\Renter;
use App\Models\Account;
use App\Models\AccountJournal;
use App\Models\AccountType;
use App\Models\AccountJournalSets;
use App\Models\Upazila;
use App\Models\TotalOutstanding;
use App\Models\Expense;
use Auth;
use Session;
use validate;
use URL;
use Redirect;
use File;
use concat;
use Intervention\Image\Facades\Image;

class RenterController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
  }
    public function view_renter(){

    	return view('admin/renter.index');
    }

    public function create(){
        $data['division'] = Division::all()->sortBy('div_name')->pluck('div_name', 'div_name' );
        $data['apartments'] = Apartment::all()->sortBy('apartment_name')->pluck('apartment_name' , 'id');
    	return view('admin/renter.create', $data);
    }



    public function get_flat(Request $request) {
        
        $flId = $request->flId;
        
        $flat = Flat::where(array('apartment_id' => $flId , 'flat_status' => 0, 'deleted' => 0 ))->get();
            
           
        $data['flat'] = $flat;

        return $data;
    }


    public function get_rent_amount(Request $request) {
        
        $flId = $request->flId;
        
        $flat_rent = Flat::where(array('id' => $flId , 'flat_status' => 0, 'deleted' => 0 ))->get();
            
           
        $data['flat_rent'] = $flat_rent;

        return $data;
    }

    public function store(Request $request){

      $this->validate($request, [
        'renter_name' => ['required', 'unique:renter,renter_name', 'string', 'max:100'],
        'renter_type' => ['required'],
        'apartment_id' => ['required'],
        'flat_id' => ['required'],
        'advance' => ['required'],
        'start_month' => ['required'],
        'mobile' => ['required'],
        'division_name' => ['required'],
        'district_name' => ['required'],
        'thana_name' => ['required'],
        'village_or_are_name' => ['required'],
        'address' => ['required'],
        'occupation' => ['required'],
        
      ]);

      

      $input = new Renter;
      $input->renter_name = $request->renter_name;
      $input->renter_type = $request->renter_type;
      $input->apartment_id = $request->apartment_id;
      $input->flat_id = $request->flat_id;
      $input->advance_amount = $request->advance;
      $input->start_month = date('Y-m-01', strtotime($request->start_month));
      $input->mobile = $request->mobile;
      $input->division_name = $request->division_name;
      $input->district_name = $request->district_name;
      $input->thana_name = $request->thana_name;
      $input->post_name = $request->post_name;
        $input->post_code = $request->post_code;
        $input->village_or_are_name = $request->village_or_are_name;
        $input->address = $request->address;
        $input->occupation = $request->occupation;
        $input->work_address = $request->work_address;
        $input->status = 1;
        $input->deleted = 0;

              $total_outstanding_month = date('F,Y', strtotime($request->start_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->income += $request->advance;
                $check->save();
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = $request->advance;
                $total->expense = 0;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($request->start_month));
                $total->save();
              }

      
        if ($request->hasFile('renter_photo')) {
           
                $image = $request->file('renter_photo');
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(120, 80);
                $image_resize->save('admin/image/renter/' . $filename);
                $input['renter_photo'] = $filename;

                $image2 = $request->file('nid_photo');
                $unique_date2 = date_timestamp_get(date_create());
                $filename2 = $unique_date . $image2->getClientOriginalName();
                $image_resize2 = Image::make($image2->getRealPath());
                $image_resize2->resize(120, 80);
                $image_resize2->save('admin/image/renter/' . $filename2);
                $input['nid_photo'] = $filename2;

                $image3 = $request->file('renter_policeinfo_photo');
                $unique_date3 = date_timestamp_get(date_create());
                $filename3 = $unique_date . $image3->getClientOriginalName();
                $image_resize3 = Image::make($image3->getRealPath());
                $image_resize3->resize(120, 80);
                $image_resize3->save('admin/image/renter/' . $filename3);
                $input['renter_policeinfo_photo'] = $filename3;


    
    }
    if($input->save()){
      $renter_flat_rent_history = new RenterFlatRentHistory;
      $renter_flat_rent_history->renter_id = $input->id;
      $renter_flat_rent_history->flat_id = $input->flat_id;
      $flat = Flat::where('id',$input->flat_id)->first();     
      $renter_flat_rent_history->flat_rent = $flat->flat_rent;
      $renter_flat_rent_history->rent_start_month =date('Y-m-01', strtotime($input->start_month)); 
    
      
      }
    if($renter_flat_rent_history->save()){
    
      $flat->flat_status = 1;
    }

    if($flat->save()){
    
      $flat_rent = FlatRentHistory::where('flat_id', $input->flat_id)->first();
      $flat_rent->flat_advance = $request->advance;

  }
    
         

    if($flat_rent->save()){
              Session::flash('success', 'New Renter Added Successfully!');
              return Redirect::route('rent_list');
          }else{
              Session::flash('error', 'Failed!');
              return Redirect::route('rent_list');
          }
        
        
        
        
      }

    

         
    	

        
      
    

    public function data_dataTable(Request $request){

      $filterMonth = ($request->month) ? $request->month : date('m');
      $filterYear = ($request->year) ? $request->year : date('Y');
      $monthName = date('F Y', strtotime($filterYear . '-' . $filterMonth . '-' . '01'));

      $renter = Renter::where('deleted', 0)->orderByDesc('id')->with(array('apartments', 'flat', 'utilities' => function($query) use ($filterMonth, $filterYear) {
                        $query->WhereRaw('MONTH(utility_month) = ?', [$filterMonth])
                                ->WhereRaw('year(utility_month) = ?', [$filterYear]);
                    }));
      

      $data['recordsTotal'] = $renter->count();
      $data['recordsFiltered'] = $renter->count();
      $renter->limit($request->length)->offset($request->start);
      $renter_list = $renter->get();

      
      $data['draw'] = $request->draw;
    	
    	$data['data'] = array();
    	$sl = 0;

    	foreach($renter_list as $r){

    		$post_n = $r->post_name ? $r->post_name : "n/a";
            $post_c = $r->post_code ? $r->post_code : "n/a";
            $up_name = $r->thana_name;
            $dis_name = $r->district_name;
            $div_name = $r->division_name;
             $apartment_name = $r->apartments['apartment_name'];
             $flat_name = $r->flat['flat_name'];
             $fl_rent = $r->flat['flat_rent'];
             $floor_number = $r->flat['floor_number'];
             
             $utility_bill_id = ($r->utilities)? $r->utilities['id'] : 0;
             $electricity_bill = ($r->utilities)? $r->utilities['electricity_bill'] : 0;
             $water_bill = ($r->utilities)? $r->utilities['water_bill'] : 0;
             $gas_bill = ($r->utilities)? $r->utilities['gas_bill'] : 0;
             $security_bill = ($r->utilities)? $r->utilities['security_bill'] : 0;
             $garage_bill = ($r->utilities)? $r->utilities['garage_bill'] : 0;
             $others_utility_bill = ($r->utilities)? $r->utilities['others_utility_bill'] : 0;
             $others_bill = ($r->utilities)? $r->utilities['others_bill'] : 0;
             $paid_status = ($r->utilities)? $r->utilities['paid_status'] : 0;
             $utility_amount = ($r->utilities)? $r->utilities['total_utility_bill'] : 0;
             $total_rent = $fl_rent + $utility_amount;

             $due_amount = ($r->renter_rent_paid_history)? $r->renter_rent_paid_history['due_amount'] : 0;
             $due_amount_month = ($r->renter_rent_paid_history)? date('F, Y', strtotime($r->renter_rent_paid_history['paid_for_month']))  : 0; 
              


            if($r['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }

              if($r['renter_type'] == 1){
              	$renter_type = "Family"; }
              elseif($r['renter_type'] == 2){
              	$renter_type = "Bachalor";
              }else{
              	$renter_type = "Office";
              }

               $dte = $r->start_month;
               $d= date('F, Y', strtotime($dte)); 

               $editURL =URL::to('reedit'.'/'.$r->id);
               $renter_utility_bill_history = URL::to('utilitybillhistory'.'/'.$r->id);
              

            $data['data'][$sl]['renter_basic_info'] = '<b style="color: green">' ."Renter Name: ".'</b>'.'<b class="text-danger">'. "$r->renter_name" .'</b>'.'<br>'. 
            '<b style="color: green">' ."Renter Type: ".'</b>'. "$renter_type" .'<br>'. '<b style="color: green">' ."Mobile no.: " .'</b>'. "$r->mobile"  .'<br>' .
            '<b style="color: green">' ."Occupation: " .'</b>'. "$r->occupation" .'<br>'.
            '<b style="color: green">' ."Work Address: " .'</b>'. "$r->work_address" .'<br>';

            $data['data'][$sl]['apartment_info'] = '<b style="color: green">' ."Flat Name: ".'</b>'."$flat_name". '<br>'. 
            '<b style="color: green">' ."Flat Rent: ".'</b>'."$fl_rent".'<br>'.'<b style="color: green">' ."Advance Paid: ".'</b>'."$r->advance_amount". '<br>'.'<b style="color: green">' ."Floor Number: ".'</b>'."$floor_number". '<br>'.'<b style="color: green">' ."Apartment Name: ".'</b>'."$apartment_name". '<br>';

            // $data['data'][$sl]['start_month'] = $check ? $check : 'NULL';
            $data['data'][$sl]['start_month'] = $d;

            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>".'<br>'."<a class='renter_extra_bill' href='$r->flat_id ' renter_id='$r->id' apartment_id = '$r->apartment_id' apartment_name ='$apartment_name' flat_name = '$flat_name' flat_rent= '$fl_rent' renter_name = '$r->renter_name' rent_start_month = '$r->start_month' data-toggle='modal' data-target='#renter_extra_bill_modal'><button class='mb-1 delete btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Add Utility Bill</button> </a>" .'<br>'.
            
             "<a class='renter_utility_bill_history' href='$renter_utility_bill_history' ><button class='delete btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Utility Bill History</button> </a>";

            $data['data'][$sl]['address_details'] = '<b style="color: green">' ."Area Name: ".'</b>'. "$r->village_or_are_name" .'<br>'. 
            '<b style="color: green">' ."Address: ".'</b>'. "$r->address" .'<br>'. '<b style="color: green">' ."Post name: " .'</b>'. "$post_n"  .'<br>' .
            '<b style="color: green">' ."Post Code: " .'</b>'. "$post_c" .'<br>'.
            '<b style="color: green">' ."Thana: " .'</b>'. "$up_name" .'<br>'.
            '<b style="color: green">' ."District: " .'</b>'. "$dis_name" .'<br>'.
            '<b style="color: green">' ."Division: " .'</b>'. "$div_name" .'<br>';

            if($due_amount == 0){

              $data['data'][$sl]['action'] = "<a href='$editURL'>
                                                <i class='fa fa-edit btn_edit' style='font-size:14px;'></i>
                                            </a> 
                                            | 
                                            <a class='renter_delete' href='$r->id' data-toggle='modal' data-target='#renter_delete_modal' style='font-size:14px; border: none; background: none; '>
                                             <i class='fa fa-trash btn_delete'></i></a>
                                             
                                            " .'<br>'."<a data-toggle='modal' data-target='#pay_bill_modal' class='pay_bill ' href='$r->id' u_id = '$utility_bill_id' utility_bill ='$utility_amount' total_rent = '$total_rent' flat_rent='$fl_rent' apartment_name = '$apartment_name' flat_name ='$flat_name' renter_name = '$r->renter_name' rent_pay_month ='$monthName' apartment_id ='$r->apartment_id' flat_id ='$r->flat_id' paid_status = '$paid_status' electricity_bill='$electricity_bill' water_bill='$water_bill' gas_bill='$gas_bill' security_bill='$security_bill' garage_bill='$garage_bill' others_utility_bill='$others_utility_bill' others_bill='$others_bill' ><button class='btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Pay Rent</button> </a>";
            }

            else{

              $data['data'][$sl]['action'] = "<a href='$editURL'>
                                                <i class='fa fa-edit btn_edit' style='font-size:14px;'></i>
                                            </a> 
                                            | 
                                            <a class='renter_delete' href='$r->id' data-toggle='modal' data-target='#renter_delete_modal' style='font-size:14px; border: none; background: none; '>
                                             <i class='fa fa-trash btn_delete'></i></a>
                                             
                                            " .'<br>'."<a data-toggle='modal' data-target='#pay_due_bill' class='pay_bill ' href='$r->id' utility_bill ='$utility_amount' total_rent = '$total_rent' flat_rent='$fl_rent' apartment_name = '$apartment_name' flat_name ='$flat_name' renter_name = '$r->renter_name' rent_pay_month ='$monthName' apartment_id ='$r->apartment_id' flat_id ='$r->flat_id' paid_status = '$paid_status' due_amount='$due_amount' due_amount_month='$due_amount_month' ><button class='btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Pay Rent</button> </a>";
            }
            
            
            
             $sl++;
            }
            echo json_encode($data);
           die();


    }

    public function edit($id){

    	  $data['division'] = Division::all()->pluck('div_name', 'div_name');
        $data['district'] = District::all()->pluck('dis_name' , 'dis_name');
        $data['upzila'] = Upazila::all()->pluck('up_name' , 'up_name');

        $data['apartments'] = Apartment::pluck('apartment_name' , 'id');
        $data['flat'] = Flat::pluck('flat_name' , 'id');
        $data['renter'] = Renter::findOrFail($id);
        
        

    	return view('admin/renter.edit', $data);
    }

    
   public function update(Request $request)
   {
     
    $id = $request->renter_id;
    $this->validate($request, [
        'renter_name' => 'required|unique:renter,renter_name,' .$id,
        'renter_type' => 'required',
        'apartment_id' => 'required',
        'flat_id' => 'required',
        'start_month' => 'required',
        'mobile' => 'required',
        'division_name' => 'required',
        'district_name' => 'required',
        'upazilla_name' => 'required',
        'village_or_are_name' => 'required',
        'address' => 'required',
        'occupation' => 'required',
        
      ]);
      $input = Renter::findOrFail($id);

      if($request->renter_name != NULL){
              $payable_name = 'Payable_'.$input->renter_name;
              $account_payable = Account::where('name' , $payable_name)->first();
              $account_payable->name = 'Payable_'.$request->renter_name;
            }
              
         if($account_payable->save()){
                $recieveable_name = 'Recieveable_'.$input->renter_name;
                $account_recieveable = Account::where('name' , $recieveable_name)->first();
                $account_recieveable->name = 'Recieveable_'.$request->renter_name;
              }

       
          if($account_recieveable->save()){
            
            $input->renter_name = $request->renter_name;
            $input->renter_type = $request->renter_type;
            $input->apartment_id = $request->apartment_id;
            $input->flat_id = $request->flat_id;
            $input->advance_amount = $input->advance_amount + $request->new_advance_amount;
            $input->start_month = date('Y-m-01', strtotime($request->start_month));
            $input->mobile = $request->mobile;
            $input->division_name = $request->division_name;
            $input->district_name = $request->district_name;
            $input->thana_name = $request->upazilla_name;
            $input->post_name = $request->post_name;
              $input->post_code = $request->post_code;
              $input->village_or_are_name = $request->village_or_are_name;
              $input->address = $request->address;
              $input->occupation = $request->occupation;
              $input->work_address = $request->work_address;

                $total_outstanding_month = date('F,Y', strtotime($request->start_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->income += $request->new_advance_amount;
                $check->save();
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = $request->new_advance_amount;
                $total->expense = 0;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($request->start_month));
                $total->save();
              }
            }
            

            
              if($request->hasFile('renter_photo')) {

                 $path1 = public_path("admin/image/renter/".$input->renter_photo);
                  if (File::exists($path1)) {
                      File::delete($path1);}
                 
                      $image = $request->file('renter_photo');
                      $unique_date = date_timestamp_get(date_create());
                      $filename = $unique_date . $image->getClientOriginalName();
                      $image_resize = Image::make($image->getRealPath());
                      $image_resize->resize(120, 80);
                      $image_resize->save('admin/image/renter/' . $filename);
                      $input['renter_photo'] = $filename;
                    

                    if($request->hasFile('nid_photo')) {

                      $path2 = public_path("admin/image/renter/".$input->nid_photo);
                        if (File::exists($path2)) {
                         File::delete($path2);}

                      $image2 = $request->file('nid_photo');
                      $unique_date2 = date_timestamp_get(date_create());
                      $filename2 = $unique_date . $image2->getClientOriginalName();
                      $image_resize2 = Image::make($image2->getRealPath());
                      $image_resize2->resize(120, 80);
                      $image_resize2->save('admin/image/renter/' . $filename2);
                      $input['nid_photo'] = $filename2;
                    }
                     
                     if($request->hasFile('renter_policeinfo_photo')) {

                        $path3 = public_path("admin/image/renter/".$input->renter_policeinfo_photo);
                          if (File::exists($path3)) {
                           File::delete($path3);}

                      $image3 = $request->file('renter_policeinfo_photo');
                      $unique_date3 = date_timestamp_get(date_create());
                      $filename3 = $unique_date . $image3->getClientOriginalName();
                      $image_resize3 = Image::make($image3->getRealPath());
                      $image_resize3->resize(120, 80);
                      $image_resize3->save('admin/image/renter/' . $filename3);
                      $input['renter_policeinfo_photo'] = $filename3;

                   }
                   } 


                   if($input->save()){

                    $flat_rent = FlatRentHistory::where('flat_id', $input->flat_id)->first();
                    $flat_rent->flat_advance = $flat_rent->flat_advance + $request->new_advance_amount;

                   
                   if($flat_rent->save()){

                    Session::flash('success', 'Renter Information Updated Successfully!');
                    return Redirect::route('rent_list');
                }
                else{
                    Session::flash('error', 'Failed!');
                    return Redirect::route('rent_list');
                }
              }
              }
 


 public function delete_renter(Request $request){
    
      $id = $request->id;
      $input = Renter::findOrFail($id);
      $input->status = 0;
      $input->deleted = 1;

      if($input->save()){
      $flat_status = Flat::where('id', $input->flat_id)->first();
      $flat_status->flat_status = 0;
       }

      
       if($flat_status->save()){

            $path1 = public_path("admin/image/renter/".$input->renter_photo);
            File::delete($path1);
            $path2 = public_path("admin/image/renter/".$input->nid_photo);
            File::delete($path2);
            $path3 = public_path("admin/image/renter/".$input->renter_policeinfo_photo);
            File::delete($path3);

             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('rent_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('rent_list');
         }
    }

     
     public function utility_bill_store(Request $request){
       
        $this->validate($request, [
        'electricity_bill' => ['required'],
        'water_bill' => ['required'],
        'gas_bill' => ['required'],
        'security_bill' => ['required'],
        'others_utility_bill' => ['required'],
        'others_bill' => ['required'],
        'garage_bill' => ['required'],
        'month' => ['required'],
        'year' => ['required']
        
      ]);
        $date = date('Y-m-01', strtotime($request->year."-".$request->month."-".'01'));
        
        $unique_month = Utility::where(array('renter_id'=>$request->renter_id , 'flat_id'=>$request->flat_id , 'utility_month'=>$date))->first();

        if($unique_month != NULL && $unique_month->utility_month == $date){
          Session::flash('error', 'Please Select Another Month! Utility Bill Already Added!!');
             return Redirect::route('rent_list');
        }
        else
        {

        $utility = new Utility;
        
        $utility->renter_id = $request->renter_id;
        $utility->apartment_id = $request->apartment_id;
        $utility->flat_id = $request->flat_id;

        $utility->utility_month = $date;
        $utility->electricity_bill = $request->electricity_bill;
        $utility->water_bill = $request->water_bill;
        $utility->gas_bill = $request->gas_bill;
        $utility->security_bill = $request->security_bill;
        $utility->garage_bill = $request->garage_bill;
        $utility->others_bill = $request->others_bill;
        $utility->others_utility_bill = $request->others_utility_bill;
        $utility->total_utility_bill = $request->electricity_bill + $request->water_bill + $request->gas_bill + $request->security_bill + $request->garage_bill + $request->others_bill + $request->others_bill + $request->others_utility_bill;

      

        if($utility->save()){




             Session::flash('success', 'Utility Bill Added Successfully!');
             return Redirect::route('rent_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('rent_list');
         }
         }


     }

     public function utility_bill_update(Request $request){
           

       

        $this->validate($request, [
        'electricity_bill' => ['required'],
        'water_bill' => ['required'],
        'gas_bill' => ['required'],
        'security_bill' => ['required'],
        'others_utility_bill' => ['required'],
        'others_bill' => ['required'],
        'garage_bill' => ['required'],
        'month' => ['required'],
        'year' => ['required']
        
      ]);

        $unique_month = Utility::where('id', $request->utility_id)->first();

        $date = date('Y-m-01', strtotime($request->year."-".$request->month."-".'01'));



        if($unique_month != NULL && $unique_month->utility_months == $date){
          
          Session::flash('error', 'Please Select Another Month! Utility Bill Already Added.');
             return Redirect::route('rent_list');
        }
        else
        {
        
        $utility = Utility::findOrFail($request->utility_id);
      
        $utility->utility_month = $date;
        $utility->electricity_bill = $request->electricity_bill;
        $utility->water_bill = $request->water_bill;
        $utility->gas_bill = $request->gas_bill;
        $utility->security_bill = $request->security_bill;
        $utility->garage_bill = $request->garage_bill;
        $utility->others_bill = $request->others_bill;
        $utility->others_utility_bill = $request->others_utility_bill;
        
            $utility->total_utility_bill = $request->electricity_bill + $request->water_bill + $request->gas_bill + $request->security_bill + $request->garage_bill + $request->others_bill + $request->others_bill + $request->others_utility_bill;

        if($utility->save()){

            return Redirect::back()->with('success', 'Utility Bill Updated Successfully!'); 
         }else{
             
             return Redirect::back()->with('error', 'Failed!');
         }
         }


     }

     public function utility_bill_delete(Request $request){
      
        $utility = Utility::findOrFail($request->id);

              
              

        if($utility->delete()){


             return Redirect::back()->with('success', 'Utility Bill Deleted Successfully!');
         }else{
             return Redirect::back()->with('error', 'Failed!');
         }
         }


     

     public function utility_bill_history($id){
      
      $data['renter_id'] = $id;
      $data['renter'] = Renter::where('id' , $id)->first();
     
      return view('admin/renter.renter_utility_bill_history' , $data);
     }



     public function bill_dataTable(Request $request){

      $bill_renter_id = $request->renter_id;

      $utility = Utility::where('renter_id', $bill_renter_id)->orderByDesc('id');

      $data['recordsTotal'] = $utility->count();
      $data['recordsFiltered'] = $utility->count();
      $utility->limit($request->length)->offset($request->start);
      $utility_list = $utility->get();

      
      $data['draw'] = $request->draw;
      
      $data['data'] = array();
      $sl = 0;

      foreach($utility_list as $r){

      	if($r->paid_status == 1){
                    $class = 'badge badge-success';
                    $status = 'Paid';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Due';
              }

               $dte = $r->utility_month;
               $d= date('F, Y', strtotime($dte));
               $flat_name = $r->flat['flat_name'];
               $apartment_name = $r->apartments['apartment_name'];

               $total = $r->total_utility_bill;


            $data['data'][$sl]['electricity_bill'] = $r->electricity_bill;

            $data['data'][$sl]['gas_bill'] = $r->gas_bill;

            $data['data'][$sl]['water_bill'] = $r->water_bill;

            $data['data'][$sl]['security_bill'] = $r->security_bill;

            $data['data'][$sl]['garage_bill'] = $r->garage_bill;

            $data['data'][$sl]['others_bill'] = $r->others_bill;

            $data['data'][$sl]['others_utility_bill'] = $r->others_utility_bill;

            $data['data'][$sl]['month'] ='<b class="text-success">'.$apartment_name.'-'.$flat_name .'</b>'.'<br>'. $d;

            $data['data'][$sl]['total_bill'] = '<b class="text-danger">'.$total.'</b>';
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";

            $month = date('m', strtotime($r->utility_month));
            $year = date('Y' , strtotime($r->utility_month));
            
            if($r->paid_status == 0){
              $data['data'][$sl]['action'] = "<a href='$r->id' electricity_bill='$r->electricity_bill' gas_bill='$r->gas_bill' water_bill='$r->water_bill' security_bill='$r->security_bill' garage_bill='$r->garage_bill' others_bill='$r->others_bill' others_utility_bill='$r->others_utility_bill' month='$month' year='$year' class='edit_utility'  data-toggle='modal' data-target='#edit_utility_bill'>
                                                <i class='fa fa-edit btn_edit' style='font-size:14px; '></i>
                                            </a> 
                                            | 
                                            <a class='utility_delete' href='$r->id ' data-toggle='modal' data-target='#utility_delete_modal' style='border: none; background: none;' >
                                            <i class='fa fa-trash btn_delete'></i></a>
                                             
                                            ";
            }
            else{
              $data['data'][$sl]['action'] = NULL;
            }
            
            
             $sl++;
            }
            echo json_encode($data);
           die();


    }


    public function rent_payment(Request $request){
          
       
        
        
        // First Condition Start Due Amount Paid

        $unique_month = RenterRentPayHistory::where(array('renter_id'=>$request->renter_id , 'flat_id'=>$request->flat_id))->orderByDesc('id')->first();

        if(isset($request->due_amount) && $unique_month->due_amount > 0){
          if($request->due_amount < $unique_month->due_amount || $request->due_amount > $unique_month->due_amount){
             Session::flash('error', 'Wrong Amount of Pay Rent!!! Try Again!');
             return Redirect::route('rent_list');
          }
          if($request->due_amount == $unique_month->due_amount){
                 $unique_month->due_amount = $unique_month->due_amount - $request->due_amount;
               $unique_month->paid_amount += $request->due_amount;
               
               $unique_month->comments = $request->comments;
               $unique_month->payment_date = date('Y-m-d', strtotime($request->payment_date));
               

              if($unique_month->save()){

              $total_outstanding_month = date('F,Y', strtotime($unique_month->paid_for_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->income += $request->due_amount;
                $check->save();
                Session::flash('success', 'Due Rent Paid Successfully!');
                return Redirect::route('rent_list');
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = $request->due_amount;
                $total->expense = 0;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($unique_month->paid_for_month));
                $total->save();
                Session::flash('success', 'Due Rent Paid Successfully!');
                return Redirect::route('rent_list');
              }
            
          }
            }
          }
        // First Condition End

        
        
        // Second Condition Start Rent Already Paid

        $check_advance = FlatRentHistory::where('flat_id' , $request->flat_id)->orderByDesc('id')->first();
        $date = date('Y-m-01', strtotime($request->paid_for_month."-".'01'));
        if($unique_month != NULL && $unique_month->paid_for_month == $date){
          Session::flash('error', 'Rent Already paid!');
             return Redirect::route('rent_list');
        }

        // Second Condition End

        // Third Condition Start

        if($request->paid_from_advance > $check_advance->flat_advance){
          Session::flash('error', 'You do not have required blanace in Advance!');
             return Redirect::route('rent_list');
        }

        // Third Condition End

        // Last Condition Start

        if($request->renter_id > 0){

          $rent_pay = new RenterRentPayHistory;
          $rent_pay->apartment_id = $request->apartment_id;
          $rent_pay->renter_id = $request->renter_id;
          $rent_pay->flat_id = $request->flat_id;
          $rent_pay->flat_rent_amount = $request->flat_rent_amount;
          $rent_pay->utility_bill_amount = $request->utility_bill_amount;
          $rent_pay->paid_for_month = date('Y-m-01', strtotime($request->paid_for_month));
          $rent_pay->total_amount = $request->utility_bill_total_rent + $request->additional - $request->discount;
          $rent_pay->paid_from_advance = $request->paid_from_advance ? $request->paid_from_advance : 0;
          $rent_pay->additional = $request->additional;
          $rent_pay->discount = $request->discount;
          $rent_pay->payment_date = date('Y-m-01', strtotime($request->payment_date));
          $rent_pay->paid_by = Auth::user()->full_name;
          $rent_pay->comments = $request->comments;
          $rent_pay->utility_bill_id = $request->utility_id;

          if($request->amount == 0){
              $rent_pay->paid_amount = $request->utility_bill_total_rent + $request->additional - $request->discount - $request->paid_from_advance;
              $rent_pay->due_amount = 0;
             
              $total_outstanding_month = date('F,Y', strtotime($request->paid_for_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->income += $request->utility_bill_total_rent + $request->additional - $request->discount - $request->paid_from_advance;
                $check->save();
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = $request->utility_bill_total_rent + $request->additional - $request->discount - $request->paid_from_advance;
                $total->expense = 0;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($request->paid_for_month));
                $total->save();
              }
            
          
            }

            else{

              $rent_pay->paid_amount = $request->amount;
              $rent_pay->due_amount = $request->utility_bill_total_rent + $request->additional - $request->discount - $request->amount;

              $total_outstanding_month = date('F,Y', strtotime($request->paid_for_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
              if(isset($check->id)){
                $check->income += $request->amount;
                $check->save();
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = $request->amount;
                $total->expense = 0;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($request->paid_for_month));
                $total->save();
              }
            }
          

          if($rent_pay->save()){
            if($request->utility_id > 0 ){
            $utility = Utility::where(array('renter_id'=>$request->renter_id , 'flat_id'=>$request->flat_id , 'utility_month' => date('Y-m-01', strtotime($request->paid_for_month))))->first();
            $utility->paid_status = 1;
            $utility->save();
            }
          
          
            $advance = FlatRentHistory::where('flat_id' , $request->flat_id)->first();
            $advance_customise = $advance->flat_advance - $request->paid_from_advance;
            $advance->flat_advance = $advance_customise;
            $advance->advance_deduct += $request->paid_from_advance;
          }
          
          if($advance->save()){
             
             Session::flash('success', 'Rent Paid Successfully!');
             return Redirect::route('rent_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('rent_list');
         }
          
        }

        // Last Condition End
    }

    


    public function rent_paid_history_index()

    {
    	$data['renter'] = Renter::where('status' , 1)->pluck('renter_name','id');
    	$data['apartment'] = Apartment::pluck('apartment_name' , 'id');
      return view('admin/renter.rent_paid_history' , $data);
    }


    public function rent_paid_history_data(Request $request){

      
      $paid_history = RenterRentPayHistory::orderBY('id', 'DESC');
     
      if (isset($request->renter) && $request->renter > 0) {
            $paid_history->where('renter_id', $request->renter);
        }
        if (isset($request->apartment) && $request->apartment > 0) {
            $paid_history->where('apartment_id', $request->apartment);
        }
        if (isset($request->flat) && $request->flat > 0) {
            $paid_history->where('flat_id', $request->flat);
        }



      $data['recordsTotal'] = $paid_history->count();
      $data['recordsFiltered'] = $paid_history->count();
      $paid_history->limit($request->length)->offset($request->start);
      $rent_paid_history = $paid_history->get();

      
      $data['draw'] = $request->draw;
      
      $data['data'] = array();
      $sl = 0;


      foreach($rent_paid_history as $r){
        
       

        // if($r->utilities['paid_status'] == 1){
        //             $class = 'badge badge-success';
        //             $status = 'Paid';
        //         }else{
        //            $class = 'badge badge-danger';
        //            $status = 'Due';
        //       }
       
        

        $data['data'][$sl]['flat_name'] = ($r->flat)? $r->flat['flat_name'] : NULL;
        $data['data'][$sl]['total_rent_amount'] = $r->total_amount;
        $data['data'][$sl]['rent_paid'] = $r->paid_amount;
        $data['data'][$sl]['month'] = date('F, Y', strtotime($r->paid_for_month));
        $data['data'][$sl]['paid_by'] = $r->paid_by;
        // $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
        $rent_details = URL::to('rentdetails'.'/'.$r->id);

        $current_month = date('Y-m-01', strtotime($r->paid_for_month));
        if($current_month == date('Y-m-01')){
          $data['data'][$sl]['action'] = "<a  class='pay_details' href='$rent_details' target='_blank' ><button class='btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Payment Details</button> </a>
        |
        <a class='pay_revert' href='$r->id' style='margin: 0px;' data-toggle='modal' data-target='#p_revert' ><button class='expend_id btn btn-info btn_details_danger' type='submit' value='submit' style='font-size:10px; padding:4px;' > Revert</button></a>"."<br>";
        }
        else{
          $data['data'][$sl]['action'] = "<a  class='pay_details' href='$rent_details' target='_blank' ><button class='btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Payment Details</button>";
        }
        

        
       
       $sl++;
      }
      
      echo json_encode($data);
           die();

    }

    public function get_all_flat(Request $request) {
        
        $flId = $request->flId;
        
        $flat = Flat::get();
            
           
        $data['flat'] = $flat;

        return $data;
    }

    public function rent_details($id){
    	 
       $data['rent_pay_history'] = RenterRentPayHistory::where('id', $id)->first();

       return view('admin/renter.rent_details', $data);
    }

    public function print_preview($id){

      $data['rent_pay_history'] = RenterRentPayHistory::where('id', $id)->first();

       return view('admin/renter.print_preview', $data);

    }

    public function pay_delete(Request $request){
     
     $id = $request->pay_revert_id;

     $pay = RenterRentPayHistory::findOrFail($id);
     $pay_month = date('Y-m-01', strtotime($pay->paid_for_month));
    
     if($pay->paid_from_advance > 0){
      $find_flat_rent_advance = FlatRentHistory::where(array('apartment_id' => $pay->apartment_id , 'flat_id'=> $pay->flat_id))->first();
      $find_flat_rent_advance->flat_advance = $find_flat_rent_advance->flat_advance + $pay->paid_from_advance;
      $find_flat_rent_advance->advance_deduct = $find_flat_rent_advance->advance_deduct - $pay->paid_from_advance;
      $find_flat_rent_advance->save();
     }

     if($pay->utility_bill_id > 0){
      
      $utility_paid_status = Utility::where(array('apartment_id' => $pay->apartment_id , 'flat_id' => $pay->flat_id ,'renter_id' => $pay->renter_id , 'utility_month' => date('Y-m-01', strtotime($pay->paid_for_month)) ))->first();
      $utility_paid_status->paid_status = 0;
      $utility_paid_status->save();
     }
     

     if($pay->delete()){
             

             $total_outstanding_month = date('F,Y', strtotime($pay->paid_for_month));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->income = $check->income - $pay->paid_amount;
                $check->save();
              }
              
             Session::flash('success', 'Rent Revert Successfully!');
             return Redirect::route('rentpaidlist');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('rentpaidlist');
         }

    }
}
