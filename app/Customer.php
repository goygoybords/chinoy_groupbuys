<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
     protected $fillable = [
        'firstname', 'lastname', 'contact_number' , 'shipping_address', 'city' ,'zip'
    ];


    protected $table = "customers";
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
