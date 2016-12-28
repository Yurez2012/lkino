<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $fillable = [
        'name',
        'email',
        'law',
        'password',
        'remember_token'
    ];




}
