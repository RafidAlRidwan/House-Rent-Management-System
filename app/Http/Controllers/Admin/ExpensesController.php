<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CostSector;
use App\Models\Expense;
use App\Models\Apartment;
use App\Models\Renter;
use App\Models\Flat;
use App\Models\TotalOutstanding;
use Auth;

use URL;
use Session;
use Redirect;
use validate;

class ExpensesController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
  }

  public function index(){

    	return view('admin/expenses.index');

    }

   public function store_cost_sector(Request $request){


          $this->validate($request, [
            'name' => ['required', 'string', 'max:20', 'unique:cost_sector,name'],
            'status' => ['required'],

          ]);

          $input = new CostSector;
          $input->name = $request->name;
          $input->status = $request->status;
          

          if($input->save()){
             Session::flash('success', 'Data Added!');
             return Redirect::route('cost_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('cost_list');
         }
    }

    public function data_datatable(Request $request){

           $cost_data = CostSector::orderBY('id', 'DESC');


            $data['recordsTotal'] = $cost_data->count();
            $data['recordsFiltered'] = $cost_data->count();
            $cost_data->limit($request->length)->offset($request->start);
            $cost_data_list = $cost_data->get();
           $data['draw'] = $request->draw;


           $data['data'] = array();
           $sl=0;
           

           foreach($cost_data_list as $cost){

            if($cost['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }
            
            $data['data'][$sl]['name'] = $cost->name;
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";
 
		  if($cost->status == 1){

		  		$data['data'][$sl]['action'] = "<a class='cost_edit' href='$cost->id' data-toggle='modal' data-target='#cost_edit_modal' name='$cost->name'      c_status='$cost->status'><button class='edit btn_edit' style=' border: none; background: none; 'type='button'><i class='fa fa-edit'style='font-size:14px;''></i></button> </a> 
                | 
                <a class='cost_delete' href=' $cost->id ' data-toggle='modal' data-target='#cost_delete_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><i class='fa fa-trash'></i> </button> </a>";

		  }
		  else{

		  	$data['data'][$sl]['action'] = "<a class='cost_edit' href='$cost->id' data-toggle='modal' data-target='#cost_edit_modal' name='$cost->name'      c_status='$cost->status'><button class='edit btn_edit' style=' border: none; background: none; 'type='button'><i class='fa fa-edit'style='font-size:14px;''></i></button> </a>";
		  }
		            
            
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }


    public function update_cost_sector(Request $request){

      $id = $request->id;
    	$this->validate($request,[
    		'name' => 'required|string|max:20|unique:cost_sector,name,' . $id,
            'status' => 'required',
    	]);
    	$input= CostSector::findOrFail($id);
    	$input->name = $request->name;
	      $input->status = $request->status;
	    	if($input->save()){
	             Session::flash('success', 'Data Updated!');
	             return Redirect::route('cost_list');
	         }else{
	             Session::flash('error', 'Failed!');
	             return Redirect::route('cost_list');
	         }
	    }

	public function delete_cost(Request $request){

      $id = $request->id;
      $input = CostSector::find($id);
      $input->status = 0;
      if($input->save()){
             Session::flash('success', 'Data Removed!');
             return Redirect::route('cost_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('cost_list');
         }
}



   public function expense_index(){

    $data['cost_sector'] = CostSector::all();
    $data['apartment'] = Apartment::pluck('apartment_name','id');
    return view('admin/expenses.expense_index' , $data);
   }

   public function get_flat(Request $request) {
        
        $flId = $request->flId;
        
        $flat = Flat::where('apartment_id' , $flId )->get();
            
           
        $data['flat'] = $flat;

        return $data;
    }

   public function get_renter(Request $request) {
        
        $flId = $request->flId;
        
        $flat_renter = Renter::where('flat_id', $flId)->get();
            
           
        $data['flat_renter'] = $flat_renter;

        return $data;
    }

    
    public function store_expense(Request $request){

     // return $request->all();
          $this->validate($request, [
            'month' => ['required'],
            'year' => ['required'],
            'cost_sector_id' => ['required'],
            'amount' => ['required'],
            'transaction_date' => ['required'],


          ]);

          $input = new Expense;
          $input->month_for = date('Y-m-d', strtotime($request->year."-".$request->month."-".'01')); 
          if($request->cost_sector_id == 0){
            $input->cost_sector_id = 0;
            $input->others_cost = $request->others_cost;
          } else{
            $input->cost_sector_id = $request->cost_sector_id;
            $input->others_cost = "NULL";
          }
          $input->amount = $request->amount;
          $input->transaction_date = date('Y-m-d', strtotime($request->transaction_date));
          $input->remarks = $request->remarks ? $request->remarks : 'None';
          $input->created_by = Auth::user()->full_name;
          $input->apartment_id = $request->apartment_id;
          $input->flat_id = $request->flat_id;
          $input->renter_id = $request->renter_id;

          if($input->save())
          {
              $total_outstanding_month = date('F,Y', strtotime($input->transaction_date));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->expense += $input->amount;
                $check->save();
                Session::flash('success', 'Data Added!');
                return Redirect::route('expense');
              }
              else{
                
                $total = new TotalOutstanding;
                $total->income = 0;
                $total->expense = $input->amount;
                $total->discount = 0;
                $total->month = date('F,Y', strtotime($input->transaction_date));
                $total->save();
                Session::flash('success', 'Data Added!');
                return Redirect::route('expense');
              }
            
            

          }

          
    }

    public function data_datatable_expense(Request $request){
   
      $filterMonth = ($request->month) ? $request->month : date('m');
      $filterYear = ($request->year) ? $request->year : date('Y');
      $monthName = date('F Y', strtotime($filterYear . '-' . $filterMonth));

          
           $expense_data = Expense::orderByDesc('id')->where(function($query) use ($filterMonth, $filterYear) {
                        $query->WhereRaw('MONTH(transaction_date) = ?', [$filterMonth])
                                ->WhereRaw('year(transaction_date) = ?', [$filterYear]);
                    });

           if (isset($request->cost) && $request->cost != 'all') {
            $expense_data->where('cost_sector_id', $request->cost);
        }
        else{

        }

        
            
            $data['recordsTotal'] = $expense_data->count();
            $data['recordsFiltered'] = $expense_data->count();
            $expense_data->limit($request->length)->offset($request->start);
            $expense_data_list = $expense_data->get();
            $data['draw'] = $request->draw;


           $data['data'] = array();
           $sl=0;

           $total = $expense_data_list->sum('amount');
           $data['total'] = number_format($total, 2);
           

           foreach($expense_data_list as $ex){

            $apartment_name = $ex->apartment ? $ex->apartment['apartment_name'] : 'None';
            $flat_name = $ex->flat ? $ex->flat['flat_name'] : 'None';
            $renter_name = $ex->renter ? $ex->renter['renter_name'] : 'None';

            
            $data['data'][$sl]['cost_details'] = '<b style="color: green">' ."Apartment Name: ".'</b>'."$apartment_name".'</b>'.'<br>'. 
            '<b style="color: green">' ."Flat Name: ".'</b>'. "$flat_name" .'<br>'. '<b style="color: green">' ."Renter Name: " .'</b>'. "$renter_name"  .'<br>';

            $data['data'][$sl]['cost_sector'] = $ex->cost_sector_id ? $ex->cost['name'] : 'Other'.'<br>'.'('.$ex->others_cost.')';
            $data['data'][$sl]['amount'] = '<b style="color: red">'."$ex->amount".'</b>'.'</b>'.'<br>' ;
            $data['data'][$sl]['month'] = date('F Y', strtotime($ex->month_for));
            $data['data'][$sl]['remarks'] = $ex->remarks;
            $data['data'][$sl]['submitted_by'] = $ex->created_by;
            
 
      

          $data['data'][$sl]['action'] = "<a href='$ex->id' class='expense_revert' data-toggle='modal' data-target='#ex_revert' style='margin: 0px;' ><button class='expend_id btn btn-info btn_details_danger' type='submit' value='submit' style='font-size:10px; padding:4px;' >Revert</button></a>"."<br>";

      
      
                
            
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }
    public function ex_delete(Request $request){
     
     $id = $request->ex_revert_id;

     $pay = Expense::findOrFail($id);


     if($pay->delete()){

             $total_outstanding_month = date('F,Y', strtotime($pay->transaction_date));
              $check = TotalOutstanding::where('month', $total_outstanding_month)->first();
 
              if(isset($check->id)){
                $check->expense = $check->expense - $pay->amount;
                $check->save();
              }
              
             Session::flash('success', 'Revert Successfully!');
             return Redirect::route('expense');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('expense');
         }

    }
}
