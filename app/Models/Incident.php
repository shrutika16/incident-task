<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category_id', 'comments', 'incident_date', 'created_at', 'updated_at'
    ];

    protected $table = 'incident';

    public function people()
    {
        return $this->hasMany('App\Models\People' , 'incident_id');
    }

    public function location()
    {
        return $this->hasOne('App\Models\Location', 'incident_id');
    }
}
