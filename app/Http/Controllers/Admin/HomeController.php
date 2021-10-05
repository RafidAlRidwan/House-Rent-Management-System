<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Flat;
use App\Models\TotalOutstanding;
use Illuminate\Support\Facades\Hash;
use URL;
use Session;
use Redirect;
use validate;

class HomeController extends Controller
{
    public function __construct(){
    $this->middleware('if.admin')->except('index' , 'view_user' , 'data_datatable');
  }

    public function index(){

      $flat = Flat::all();
      $data['flat'] = $flat->count('flat_name');
      $data['flat_rent'] = $flat->where('flat_status' , 1)->count();
      $totalOutstanding = TotalOutstanding::all();
      $data['income'] = $totalOutstanding->sum('income');
      $data['expense'] = $totalOutstanding->sum('expense');

      $data['month'] = TotalOutstanding::all('month');
      $data['in'] = TotalOutstanding::all('income');
      
      
    	return view('admin/home.index' , $data);
    }


    public function view_user(){
        
        $data['users'] = User::where('role', 1)->first();

    	return view('admin/home.view' , $data);

    }

    public function data_datatable(Request $request){

           $user_data = User::orderBY('id', 'DESC')->where('role',1);

           if (isset($request->status) && $request->status >= 0) {
            $user_data->where('status', $request->status);
        }


            $data['recordsTotal'] = $user_data->count();
            $data['recordsFiltered'] = $user_data->count();
            $user_data->limit($request->length)->offset($request->start);
            $user_data_list = $user_data->get();
           $data['draw'] = $request->draw;


           $data['data'] = array();
           $sl=0;
           

           foreach($user_data_list as $user){

            if($user['status'] == 1){
                    $class = 'badge badge-success';
                    $status = 'Active';
                }else{
                   $class = 'badge badge-danger';
                   $status = 'Inactive';
              }
            
            $data['data'][$sl]['username'] = $user->username;
            $data['data'][$sl]['full_name'] = $user->full_name;
            $data['data'][$sl]['mobile'] = $user->mobile;
            $data['data'][$sl]['email'] = $user->email;
            $data['data'][$sl]['role'] = "Admin";
            $data['data'][$sl]['status'] = "<span class='$class'>$status</span>";

            if($user['deleted'] == 0){
              $data['data'][$sl]['action'] = "<a class='user_edit' href='$user->id' data-toggle='modal' data-target='#user_edit_modal' email=' $user->email ' full_name=' $user->full_name ' 
                mobile=' $user->mobile ' user_status='$user->status' username=' $user->username '
                password = ' $user->password'><button class='edit btn_edit' style=' border: none; background: none; 'type='button'><i class='fa fa-edit' style='font-size:14px;''></i></button> </a> 
                | 
                <a class='user_delete' href=' $user->id ' data-toggle='modal' data-target='#user_delete_modal'><button class='delete btn_delete'  type='submit' value='submit' style='border: none; background: none;' ><i class='fa fa-trash'></i> </button> </a>";
            }
            else{
              $data['data'][$sl]['action'] = "<b class='badge badge-danger'>Deleted</b> </a>";
            }
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function store_user(Request $request){


          $this->validate($request, [
            'username' => ['required', 'string', 'max:20', 'unique:users,username'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'full_name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'max:11'],

          ]);

          $input = new User;
          $input->username = $request->username;
          $input->email = $request->email;
          $input->password = Hash::make($request['password']);
          $input->role = 1;
          $input->status = 1;
          $input->full_name = $request->full_name;
          $input->mobile = $request->mobile;

          if($input->save()){
             Session::flash('success', 'User added Successfully!');
             return Redirect::route('user_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user_list');
         }
    }

    public function update_user(Request $request){
        
      $id = $request->id;
    	$this->validate($request,[
    		    'username' => 'required|string|max:20|unique:users,username,' . $id,
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|max:11',
    	]);
    	$input= User::findOrFail($id);
    	$input->username = $request->username;
      $input->email = $request->email;
      $input->status = $request->status;
      $input->full_name = $request->full_name;
      $input->mobile = $request->mobile;
    	if($input->save()){
             Session::flash('success', 'Data Updated!');
             return Redirect::route('user_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user_list');
         }
    }

    public function delete_user(Request $request){
    
      $id = $request->id;
      $input = User::find($id);
      $input->status = 0;
      $input->deleted = 1;
      if($input->save()){
             Session::flash('success', 'Data Deleted Successfully!');
             return Redirect::route('user_list');
         }else{
             Session::flash('error', 'Failed!');
             return Redirect::route('user_list');
         }
}
}
