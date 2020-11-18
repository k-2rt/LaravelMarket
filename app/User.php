<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'kana', 'phone', 'email', 'password', 'avatar',
        'zip_code', 'prefectures', 'address1', 'address2',
        'provider', 'provider_id',
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

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function newsletters()
    {
        return $this->hasMany('App\Models\Admin\Newsletter');
    }

    public function countAllUsers()
    {
        return $this->all()->count();
    }

    public function getHyphenZipAttribute()
    {
        return substr($this->zip_code,0,3) . " - " . substr($this->zip_code,3);
    }

    public function getPrefNameAttribute()
    {
        $prefs = config('pref');

        foreach ($prefs as $index => $pref) {
            if ($index == $this->prefectures) {
                return $pref;
            }
        }
    }

    public function checkUserAddress()
    {
        if ($this->zip_code || $this->prefectures || $this->address1) {

        }
    }

}
