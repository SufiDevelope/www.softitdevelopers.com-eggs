<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $guard = 'customer';

     protected $fillable = [
        'first_name',
        'email',
        'password',
    ];

    static public function getSingle($id){
        return self::find($id);
    }
}
