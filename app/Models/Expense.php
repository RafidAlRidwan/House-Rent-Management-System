<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expense';

    public function apartment()
    {
	return $this->hasOne('App\Models\Apartment' , 'id' , 'apartment_id');
    }
    public function flat()
    {
	return $this->hasOne('App\Models\Flat' , 'id' , 'flat_id');
    }
    public function renter()
    {
	return $this->hasOne('App\Models\Renter' , 'id' , 'renter_id');
    }
    public function cost()
    {
	return $this->hasOne('App\Models\CostSector' , 'id' , 'cost_sector_id');
    }
}
