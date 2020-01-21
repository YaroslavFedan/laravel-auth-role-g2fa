<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param $query
     * @param $params
     * @return mixed
     */
    public function scopeFilter($query, $params)
    {

        if ( isset($params['role']) && trim($params['role'] !== '') ) {

            $query->whereHas('roles', function ($q) use ($params){
                 $q->where('name', $params['role']);
            });
        }

        return $query;
    }



    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }


    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }

        return false;
    }


    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first()){
            return true;
        }

        return false;
    }


    public function passwordSecurity()
    {
        return $this->hasOne('App\PasswordSecurity');
    }


}
