<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\aCollection;

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
    // protected $visible = [
    //     'name', 'email'
    // ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $appends = ['full_name'];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Accessor
     */
    public function getFullNameAttribute(){
        return $this->name . "  " . $this->email;
    }
    /**
     * global scope
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('activated', function (Builder $builder){
            $builder->where('activated', true);
        });
    }

    /**
     * local scope
     */
    // public function scopeActivated($query)
    // {
    //     return $query->where('activated', true);
    // }
    /**
     * let's play with collection
     */
    public function newCollection(array $models = [])
    {
        return new aCollection($models);
    }
    /**
     * define a relation ship
     */
    public function contacts()
    {
        return $this->hasOne('App\Contact');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function phoneNumbers()
    {
        return $this->hasManyThrough('App\PhoneNumber', 'App\Contact');
    }
    public function starrable()
    {
        return $this->morphTo();
    }

}
