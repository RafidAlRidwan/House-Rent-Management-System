<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Apartment;
use App\Models\Renter;
use App\Models\Flat;
use App\Models\FlatRentHistory;
use App\Models\RenterRentPayHistory;
use App\Models\Utility;
use Session;
use Redirect;
use DB;
use URL;
use File;
use Intervention\Image\Facades\Image;

class ApartmentController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
  }
    public function view_apartment(){

        $data['apartments_name'] = Apartment::pluck('apartment_name', 'id');


    	return view("admin/apartment.index" ,$data);

    }

    public function create(){
    	$data = Division::all()->sortBy('div_name')->pluck('div_name', 'div_name' );
    	return view("admin/apartment.create" , compact('data'));
    }


    public function get_district(Request $request) {
        $divId = $request->divId;
        $d_id = Division::all()->sortBy('div_name')->where('div_name', $divId)->pluck('id');
        $districts = District::where('division_id', $d_id)->orderBy('dis_name')
                            ->get();
            
           
        $data['districts'] = $districts;

        return $data;
    }


    public function get_thana(Request $request) {
        $disId = $request->disId;
        $ds_id = District::all()->sortBy('dis_name')->where('dis_name', $disId)->pluck('id');
        $thanas = Upazila::where('district_id', $ds_id)->orderBy('up_name')
                            ->get();
            
           
        $data['thanas'] = $thanas;

        return $data;
    }



    public function store(Request $request){
       
    	$this->validate($request, [
            'apartment_name' => ['required', 'string', 'max:100', 'unique:apartments,apartment_name'],
            'total_floor' => ['required'],
            'house_number' => ['required'],
            'division_name' => ['required'],
            'district_name' => ['required'],
            'upazilla_name' => ['required'],
            'area_name' => ['required'],
            'address' => ['required']

          ]);

    	DB::beginTransaction();
        try {
        	$input = new Apartment;
        	$input->apartment_name = $request->apartment_name;
        	$input->floor_count = $request->total_floor;
        	$input->house_number = $request->house_number;
        	$input->division_name = $request ->division_name;
        	$input->district_name = $request->district_name;
        	$input->thana_name = $request->upazilla_name;
        	$input->post_name = $request->post_name;
        	$input->post_code = $request->post_code;
        	$input->area_name = $request->area_name;
        	$input->address = $request->address;

        	if ($request->hasFile('photo')) {
                    $image = $request->file('photo');
                    $unique_date = date_timestamp_get(date_create());
                    $filename = $unique_date . $image->getClientOriginalName();
                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(320, 560);
                    $image_resize->save('admin/image/apartment/' . $filename);
                    $input['photo'] = $filename;

          }

          if($input->save()){
            $k = 0;
            foreach($request->flat_count as $key => $flat_loop){
              for($i = 0; $i < $flat_loop; $i++){
                $flatInfo = new Flat;
                $flatInfo->apartment_id = $input->id;
                $flatInfo->floor_number = $key + 1;
                $flatInfo->flat_name = $request->flat_name[$k];
                $flatInfo->flat_rent = $request->flat_rent[$k];
                $flatInfo->save();

                $flatRent = new FlatRentHistory;
                $flatRent->apartment_id = $input->id;
                $flatRent->flat_id = $flatInfo->id;
                $flatRent->current_rent = $flatInfo->flat_rent;
                $flatRent->rent_start_month = date('Y-m-01', strtotime($request->rent_start_month[$k]));
                $flatRent->save();
                $k++;
              }
            }
          }
          DB::commit();
          return Redirect::route('ap_list')
                              ->with('success', 'Apartment & Flats are Added Successfully!');
        } catch (Exception $ex) {
            DB::rollback();
            return Redirect::route('ap_list')->with('error', 'ERROR Please try again!!!');
        }
}

     public function data_datatable(Request $request)
     {
         $ap_data = Apartment::orderBY('id', 'DESC');
         
         if (isset($request->name) && $request->name > 0) {
            $ap_data->where('id', $request->name);
        }

           $searchStr = $request->search['value'];
            if ($searchStr != "") {
                
            }

            $data['recordsTotal'] = $ap_data->count();
            $data['recordsFiltered'] = $ap_data->count();

            $ap_data->limit($request->length)->offset($request->start);

            $ap_dataList = $ap_data->get();
            $data['draw'] = $request->draw;


           $data['data'] = array();
           $sl=0;
           

           foreach($ap_dataList as $ap){

            $post_n = $ap->post_name ? $ap->post_name : "n/a";
            $post_c = $ap->post_code ? $ap->post_code : "n/a";

            $id = $ap->id;
            $flat_count = Flat::all()->where('apartment_id' , $id)->count();
            $free_flat = Flat::where(array('apartment_id' => $id, 'flat_status' => 0))->count();
            $booked_flat = Flat::where(array('apartment_id' => $id, 'flat_status' => 1))->count();

             $flat_t = $ap->flat;
             $total_flat ="<b style='color: green' >" .'Total Flat: '."</b>"."$flat_count ".'<br>';
             $editURL = URL::to('apedit'.'/'.$ap->id);
             $details = URL::to('apartmentdetails'.'/'.$ap->id);


             
            
            

            
            $data['data'][$sl]['apartment_details'] = '<b style="color: green">' ."Apartment Name: ".'</b>'. '<b class="text-danger">'."$ap->apartment_name".'</b>'.'<br>'. 
            '<b style="color: green">' ."House Number: ".'</b>'. "$ap->house_number" .'<br>'. '<b style="color: green">' ."Total Floor: " .'</b>'. "$ap->floor_count"  .'<br>'."$total_flat". 
             '<b style="color: green">' ."Flat For Rent: " .'</b>'."$free_flat"  .'<br>'.'<b style="color: green">' ."Booked Flat: " .'</b>'."$booked_flat"   .'<br>';
            
            $data['data'][$sl]['address_details'] = '<b style="color: green">' ."Area Name: ".'</b>'. "$ap->area_name" .'<br>'. 
            '<b style="color: green">' ."Address: ".'</b>'. "$ap->address" .'<br>'. '<b style="color: green">' ."Post name: " .'</b>'. "$post_n"  .'<br>' .
            '<b style="color: green">' ."Post Code: " .'</b>'. "$post_c" .'<br>'.
            '<b style="color: green">' ."Thana: " .'</b>'. "$ap->thana_name" .'<br>'.
            '<b style="color: green">' ."District: " .'</b>'. "$ap->district_name" .'<br>'.
            '<b style="color: green">' ."Division: " .'</b>'. "$ap->division_name" .'<br>';


            $data['data'][$sl]['action'] = "<a href='$editURL'>
                                                <i class='fa fa-edit btn_edit' style='font-size:14px; ''></i>
                                            </a> 
                                            | 
                                            <a class='aptdel btn_delete' href='$ap->id' data-toggle='modal' data-target='#ap' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a> | 

             <a href='$details' floor = '$ap->floor_count' style='margin: 0px;' ><button class='floor_count btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Flat Details</button></a>"."<br>" ;
                                            
                                              
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }


 

    public function edit($id){

        $data['division'] = Division::all()->pluck('div_name', 'div_name');
        $data['district'] = District::all()->pluck('dis_name' , 'dis_name');
        $data['upzila'] = Upazila::all()->pluck('up_name' , 'up_name');
        $data['apartments'] = Apartment::findOrFail($id);
        return view("admin/apartment.edit", $data);
    
    }

    public function update(Request $request){

        $id = $request->id;
        $this->validate($request, [
            'apartment_name' => 'required| string | max:100 | unique:apartments,apartment_name,' . $id,
            'house_number' => ['required'],
            'division_name' => ['required'],
            'district_name' => ['required'],
            'upazilla_name' => ['required'],
            'area_name' => ['required'],
            'address' => ['required']

          ]);


        $input = Apartment::findOrFail($id);
        $input->apartment_name = $request->apartment_name;
        $input->house_number = $request->house_number;
        $input->division_name = $request->division_name;
        $input->district_name = $request->district_name;
        $input->thana_name = $request->upazilla_name;
        $input->area_name = $request->area_name;
        $input->address = $request->address;

        if ($request->hasFile('photo')) {
            $path = public_path("admin/image/apartment/".$input->photo);
            if (File::exists($path)) {
                File::delete($path);
            }
                    $image = $request->file('photo');
                    $unique_date = date_timestamp_get(date_create());
                    $filename = $unique_date . $image->getClientOriginalName();
                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(320, 560);
                    $image_resize->save('admin/image/apartment/' . $filename);
                    $input['photo'] = $filename;

          }
          if($input->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('ap_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('ap_list');
         }

    }

    public function delete(Request $request){

       
       $id = $request->ap_id;
       $flat_rental_check = Flat::where(array('apartment_id'=>$id, 'flat_status'=>1))->count();


       $flat_rent_paid_check = RenterRentPayHistory::where('apartment_id',$id)->count();


       $flat_rent_history = FlatRentHistory::where('apartment_id',$id);

       if($flat_rental_check>0 || $flat_rent_paid_check>0){

              Session::flash('error', 'Apartment Flat is already in Rent!');
              return Redirect::route('ap_list');
       }
       else{ 

        if($flat_rent_history->delete()){
        
        $flat = Flat::where('apartment_id',$id);
        }

        if($flat->delete()){

        $input = Apartment::findOrFail($id);
          }
        

        if($input->delete()){

            $path = public_path("admin/image/apartment/".$input->photo);
            File::delete($path);

             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('ap_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('ap_list');
         }
        }
       
    }

    public function apartment_show($id){

        $data['id'] = $id;
        $data['apartments'] = Apartment::where('id' , $id)->first();
        return view("admin/apartment.flat_details", $data);


    }

    public function apartment_data(Request $request){
        $id = $request->apartmentId;

           $flat_data = Flat::where(array('apartment_id'=> $id, 'deleted'=>0 ));

           if (isset($request->floor) && $request->floor > 0) {
            $flat_data->where('floor_number', $request->floor);
             }
             if (isset($request->status) && $request->status >= 0) {
            $flat_data->where('flat_status', $request->status);
             }


           $searchStr = $request->search['value'];
            if ($searchStr != "") {
                
            }

            $data['recordsTotal'] = $flat_data->count();
            $data['recordsFiltered'] = $flat_data->count();

            $flat_data->limit($request->length)->offset($request->start);

            $flat_dataList = $flat_data->get();
            $data['draw'] = $request->draw;



           $data['data'] = array();
           $sl=0;
           

           foreach($flat_dataList as $flat){
            $renter_name = Renter::where('flat_id' , $flat->id)->first();
            $flat_utility_bill_history = URL::to('flatutilitybill'.'/'.$flat->id);
            $flat_payment_history = URL::to('flatpayhistory'.'/'.$flat->id);

            if($flat['flat_status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Hired';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'To Let';
              }

              $rent_start_month = $flat->flat_rent_history->rent_start_month;
              $flat_advance = $flat->flat_rent_history->flat_advance;

            
         if($flat['flat_status'] == 1){  
            $data['data'][$sl]['flat_details'] = '<b style="color: green">' ."Flat Name: ".'</b>'. "$flat->flat_name" .'<br>'. 
            '<b style="color: green">' ."Floor Number: ".'</b>'. "$flat->floor_number" .'<br>'. '<b style="color: green">' ."Flat Rent: " .'</b>'. "$flat->flat_rent".'<br>'.'<b style="color: green">' ."Flat Hired By: " .'</b>'. "$renter_name->renter_name".'<br>'.'<b style="color: green">' ."Advanced Paid: " .'</b>'. "$flat_advance".'<br>';
          }
          else{
            $data['data'][$sl]['flat_details'] = '<b style="color: green">' ."Flat Name: ".'</b>'. "$flat->flat_name" .'<br>'. 
            '<b style="color: green">' ."Floor Number: ".'</b>'. "$flat->floor_number" .'<br>'. '<b style="color: green">' ."Flat Rent: " .'</b>'. "$flat->flat_rent"." Tk"  .'<br>';
          }
            
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>".'<br>';


            $data['data'][$sl]['action'] = "<a class='edit_flat_details ' data-toggle='modal' data-target='#flat_edit_modal'  href='$flat->id' flatName='$flat->flat_name' flatStatus='$flat->flat_status' flatRent='$flat->flat_rent' rent_date='$rent_start_month'><i class='fa fa-edit btn_edit' style='font-size:14px;'></i></a> 
                                            | 
                                            <a class='delete_flat btn_delete' href='$flat->id' data-toggle='modal' data-target='#deleteflat' style='border: none;'><i class='fa fa-trash '></i> </a>
                                            |
                                            <a class='flat_utility_bill_history' href='$flat_utility_bill_history' ><button class='delete btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Utility Bill History</button> </a> 
                                            |
                                            <a class='payment_history' href='$flat_payment_history' ><button class='delete btn btn-info btn_details'  type='submit' value='submit' style='font-size:10px; padding:4px;' >Payment History</button> </a>"
                                             ;
                                            
                                              
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function flat_update(Request $request)
    {
         
        $id = $request->id;
        $this->validate($request, [
            'flat_name' => ['required'],
            'flat_status' => ['required'],
            'flat_rent' => ['required'],
            
          ]);
         

         $checkFlat = Flat::findOrFail($id);
         $flat_rent_history = FlatRentHistory::where('flat_id', $id)->orderBy('id', 'DESC')->first();

      if($request->flat_rent != $checkFlat->flat_rent && $request->start_month == $flat_rent_history->rent_start_month || empty($request->start_month)){
            
              return Redirect::back()->with('error', 'Please select New Month!');
          
        }

        else{

        if($checkFlat->flat_rent != $request->flat_rent)
        {
            
            $month = $request->start_month;
            $timestamp = strtotime ("-1 month",strtotime ($month));
            $end_month  =  date("Y-m-t",$timestamp);

           

            $flat_rent_history->rent_end_month = $end_month;
            
            if($flat_rent_history->save()){

            $flat_rent_new_history = new FlatRentHistory;
            $flat_rent_new_history->apartment_id = $flat_rent_history->apartment_id;
            $flat_rent_new_history->flat_id = $id;
            $flat_rent_new_history->current_rent = $request->flat_rent;
            $flat_rent_new_history->rent_start_month = $request->start_month;

               if($flat_rent_new_history->save()){
                  $flat_rent = Flat::findOrFail($id);
                  $flat_rent->flat_name = $request->flat_name;
                  $flat_rent->flat_status = $request->flat_status;
                  $flat_rent->flat_rent = $request->flat_rent;

             if($flat_rent->save()){
              
              return Redirect::back()->with('success', 'Data Saved Successfully!');
          }else{
              return Redirect::back()->with('error', 'Failed!');
          }
         }
            
       }
    }

    else{
        
        $input = Flat::findOrFail($id);
        $input->flat_name = $request->flat_name;
        $input->flat_status = $request->flat_status;

        if($input->save()){
              return Redirect::back()->with('success', 'Data Saved Successfully!');
          }else{
              return Redirect::back()->with('error', 'Failed!');
          }
    


}
}

}
   public function flat_add(Request $request){
        
        $this->validate($request, [
            'floor_number' => ['required'],
   
          ]);
            $k = 0;
            
              for($i = 0; $i < $request->flat_count; $i++){
                $flatInfo = new Flat;
                $flatInfo->apartment_id = $request->apartment_id;
                $flatInfo->floor_number = $request->floor_number;
                $flatInfo->flat_name = $request->flat_name[$k];
                $flatInfo->flat_rent = $request->flat_rent[$k];
                $flatInfo->save();

                $flatRent = new FlatRentHistory;
                $flatRent->apartment_id = $flatInfo->apartment_id;
                $flatRent->flat_id = $flatInfo->id;
                $flatRent->current_rent = $flatInfo->flat_rent;
                $flatRent->rent_start_month = date('Y-m-01', strtotime($request->rent_start_month[$k]));
                $flatRent->save();
                $k++;
              }

               Session::flash('success', 'Flat insert Successfully!');
               return Redirect::route('ap_list');;
              
        }

        public function flat_delete(Request $request){

            

            $this->validate($request, [
            'flat_comment' => ['required'],
            'rent_end_month' => ['required'],
   
          ]);
            $id = $request->flat_id;
            $checkFlatStatus = Flat::where('id' , $id)->first();
            if($checkFlatStatus->flat_status > 0 ){
                return Redirect::back()->with('error', 'Flat is in Rent!');
            }

            else{
                $end_month  = date('Y-m-t', strtotime($request->rent_end_month));
                $flat_rent_end_month = FlatRentHistory::where('flat_id',$id)->first();
                $flat_rent_end_month->rent_end_month = $end_month;

                if($flat_rent_end_month->save()){
                    $checkFlatStatus->deleted = 1;
                    $checkFlatStatus->flat_comment = $request->flat_comment;
                    if($checkFlatStatus->save()){
                       Session::flash('success', 'Flat Deleted Successfully!');
                       return Redirect::route('ap_list');
                       }else{
                             Session::flash('error', 'Failed!');
                             return Redirect::route('ap_list');
                   }
                }
            }
        }

        public function floor_add(Request $request){
            

            $this->validate($request, [
            'floor_count' => ['required']
            ]);

           $id = $request->apartment_id;
           $apartment = Apartment::where('id' , $id)->first();
           $final_floor_count = $request->last_floor_number + $request->floor_count;
           $apartment->floor_count = $final_floor_count;

           $k = 0;
            foreach($request->flat_count as $key => $flat_loop){
              for($i = 0; $i < $flat_loop; $i++){
                $flatInfo = new Flat;
                $flatInfo->apartment_id = $id;
                $flatInfo->floor_number = $key + 1 + $request->last_floor_number;
                $flatInfo->flat_name = $request->flat_name[$k];
                $flatInfo->flat_rent = $request->flat_rent[$k];
                $flatInfo->save();

                $flatRent = new FlatRentHistory;
                $flatRent->apartment_id = $id;
                $flatRent->flat_id = $flatInfo->id;
                $flatRent->current_rent = $flatInfo->flat_rent;
                $flatRent->rent_start_month = date('Y-m-01', strtotime($request->rent_start_month[$k]));
                $flatRent->save();
                $k++;
              }
            }

           if($apartment->save()){
                       Session::flash('success', 'Floor added Successfully!');
                       return Redirect::route('ap_list');
                       }else{
                             Session::flash('error', 'Failed!');
                             return Redirect::route('ap_list');
                   }
            
        }

        public function flat_utility_bill($id){
           
           $flat_id = $id;
           return view('admin/apartment.flat_utility_bill_history', compact('flat_id'));
        }


    public function utility_dataTable(Request $request){

      $flat_id = $request->flat_id;

      $utility = Utility::where('flat_id', $flat_id)->orderByDesc('id');

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
               $total = $r->total_utility_bill;


            $data['data'][$sl]['electricity_bill'] = $r->electricity_bill;

            $data['data'][$sl]['gas_bill'] = $r->gas_bill;

            $data['data'][$sl]['water_bill'] = $r->water_bill;

            $data['data'][$sl]['security_bill'] = $r->security_bill;

            $data['data'][$sl]['garage_bill'] = $r->garage_bill;

            $data['data'][$sl]['others_bill'] = $r->others_bill;

            $data['data'][$sl]['others_utility_bill'] = $r->others_utility_bill;

            $data['data'][$sl]['month'] = $d;

            $data['data'][$sl]['total_bill'] = '<b class="text-danger">'.$total.'</b>';
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
             $month = date('m', strtotime($r->utility_month));
            $year = date('Y' , strtotime($r->utility_month));
            
            if($r->paid_status == 0){
              $data['data'][$sl]['action'] = "<a href='$r->id' electricity_bill='$r->electricity_bill' gas_bill='$r->gas_bill' water_bill='$r->water_bill' security_bill='$r->security_bill' garage_bill='$r->garage_bill' others_bill='$r->others_bill' others_utility_bill='$r->others_utility_bill' month='$month' year='$year' class='edit_utility btn_edit'  data-toggle='modal' data-target='#edit_utility_bill'>
                                                <i class='fa fa-edit btn_edit' style='font-size:14px;'></i>
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

    public function flat_payment_history($id){

      $data['flat_id'] = $id;
      return view('admin/apartment.flat_rent_paid_history' , $data);
    }

    public function flat_payment_datatable(Request $request){

      $flat_id = $request->flat_id;
      $paid_history = RenterRentPayHistory::where('flat_id' , $flat_id )->orderBY('id', 'DESC');
     
      $data['recordsTotal'] = $paid_history->count();
      $data['recordsFiltered'] = $paid_history->count();
      $paid_history->limit($request->length)->offset($request->start);
      $rent_paid_history = $paid_history->get();

      
      $data['draw'] = $request->draw;
      
      $data['data'] = array();
      $sl = 0;

      foreach($rent_paid_history as $r){

        
       
        

        $data['data'][$sl]['flat_name'] = ($r->flat)? $r->flat['flat_name'] : NULL;
        $data['data'][$sl]['renter_name'] = ($r->renter)? $r->renter['renter_name'] : NULL;
        $data['data'][$sl]['total_rent_amount'] = $r->total_amount;
        $data['data'][$sl]['rent_paid'] = $r->paid_amount;
        $data['data'][$sl]['month'] = date('F, Y', strtotime($r->paid_for_month));
        $data['data'][$sl]['paid_by'] = $r->paid_by;
        

        $rent_details = URL::to('rentdetails'.'/'.$r->id);

        $data['data'][$sl]['action'] = "<a  class='pay_details' href='$rent_details' target='_blank' ><button class='btn btn-info'  type='submit' value='submit' style='font-size:10px; background:#7677ff; padding:4px; border:2px;' >Payment Details</button> </a>";
       
       $sl++;
      }
      
      echo json_encode($data);
           die();

    }
}
