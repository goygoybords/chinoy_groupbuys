<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer()
    {
         return $this->hasOne(Customer::class);
    }
    public function addCustomer(Customer $customer , User $user)
    {
        //$customer->user_id = $user_id;
        return $this->customer()->save($customer);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) 
        {
            $user->token = str_random(30);
        });
    }

    public function updateStatus()
    {
        $this->status = 1;
        $this->token = null;
        $this->save();
    }
}
