<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $table = 'flat';


    public function flat_rent_history()
    {
	return $this->hasOne('App\Models\FlatRentHistory' , 'flat_id' , 'id');
    }
}
