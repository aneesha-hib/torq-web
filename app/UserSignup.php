<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSignup extends Model
{
    protected $fillable = [
        'first_name','last_name', 'code','phone','email','password','confirm_password'
    ];
}
