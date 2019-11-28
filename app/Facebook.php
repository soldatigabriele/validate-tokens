<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $table = 'facebook';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payload',
    ];
    
    protected $casts= ['payload' => 'array'];
}
