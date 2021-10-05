<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $table = 'apartments';

    public function flat(){
        return $this->hasOne('App\Models\Flat' , 'apartment_id' , 'id');
    }
}
