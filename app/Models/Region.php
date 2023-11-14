<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'type',
    ];

    public function getCountStationAttribute() {
        return $this->stations->count();
    }

    public function stations()
    {
        return $this->hasMany(Station::class, 'region_id', 'id');
    }
}
