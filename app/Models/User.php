<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;


class User extends Model implements Authenticatable {

    use AuthenticableTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'hash'
    ];

    protected $hidden = [
        'password'
    ];


    public function localization() {

        return $this->hasMany('App\Models\Localization', 'user_id');

    }

}