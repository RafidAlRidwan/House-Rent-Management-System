<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;
    protected $table ='utilities';

    public function flat(){
    	return $this->hasOne('App\Models\Flat', 'id', 'flat_id' );
    }

    public function apartments(){
    	return $this->hasOne('App\Models\Apartment', 'id', 'apartment_id' );
    }
}
