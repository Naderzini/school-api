<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Model\Claims;
use App\Model\Children;


class ChildParent extends Authenticatable implements JWTSubject
{
    use Notifiable;
    // protected $dateFormat = 'U';
   protected $guard = 'child_parent';
   public function childrens(){
    return  $this->hasMany(Children::Class);
    }

    public function claims(){
        return  $this->hasMany(Claims::Class);
        }

    public function messages(){
        return  $this->hasMany(Message::Class);
        }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'cin','email', 'password','device_token'
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
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setPassword(string $password):void 
    {
        $this->password = bcrypt($password);
        $this->save();
    }
}
