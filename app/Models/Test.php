<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'test';

    protected $fillable = [
    	'station_id',
        'region_id',
        'ip_address',
        'subnet',
        'gateway',
        'vlan',
        'swl2_transmission',
        'swl2_security',
        'swl3',
        'coordinates_origin',
        'coordinates_remote',
        'level',
    ];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function tranmissionStream()
    {
        return $this->hasMany(TransmissionStream::class);
    }

    public function getTranmissionStreamUsedAttribute()
    {
        return $this->tranmissionStream->where('thread_label', '!=', NULL)->count();
    }

    public function tvStream()
    {
        return $this->hasMany(TvStream::class);
    }

    public function getTvStreamUsedAttribute()
    {
        return $this->tvStream->where('thread_label', '!=', NULL)->count();
    }
}
