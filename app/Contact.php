<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    // public $timestamps = false;
    // protected $dateFormat = 'U';
    protected $fillable = ['name', 'email'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'activated' => 'boolean',
    ];
    /**
     * Accessors
     *
     */
    protected $appends = ['full_name'];
    protected function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }
    /**
     * Mutators
     *
     */
    public function setWorkGroupNameAttribute($value)
    {
        return $this->attributes['email'] = "$value@lehulum.com";
    }
    /**
     * RelationShip with user model
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     *Relationship with phoneNumber model
     */
    public function phoneNumber()
    {
        return $this->hasOne('App\PhoneNumber');
    }
    public function stars()
    {
        return $this->morphMany('App\Star', 'starrable');
    }
}
