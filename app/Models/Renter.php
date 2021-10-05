<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;
    protected $table = 'renter';

    
    public function apartments(){
    	return $this->hasOne('App\Models\Apartment', 'id' , 'apartment_id');
    }
    public function flat(){
        return $this->hasOne('App\Models\Flat', 'id' , 'flat_id');
    }
    public function utilities(){
       return $this->hasOne('App\Models\Utility', 'renter_id' , 'id');
       
    }
    public function renter_rent_paid_history(){
       return $this->hasOne('App\Models\RenterRentPayHistory', 'flat_id' , 'flat_id')->orderByDesc('id')->latest();
       
    }
}
