<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenterRentPayHistory extends Model
{
    use HasFactory;
    protected $table ='renter_rent_paid_history';

    public function flat(){
        return $this->hasOne('App\Models\Flat', 'id' , 'flat_id');
    }
    
    public function renter(){
       return $this->hasOne('App\Models\Renter', 'id' , 'renter_id');
       
    }
    public function apartments(){
       return $this->hasOne('App\Models\Apartment', 'id' , 'apartment_id');
       
    }
}
