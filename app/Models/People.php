<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'incident_id', 'name', 'type'
    ];

    protected $table = 'people';
}
