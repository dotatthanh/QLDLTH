<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
    	'region_id',
    	'parent_id',
    	'name',
    	'phone_number',
    	'address',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
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

    public function getTranmissionStreamDeviceAttribute()
    {
        return $this->devices->where('type', 1)->count();
    }

    public function tvStream()
    {
        return $this->hasMany(TvStream::class);
    }

    public function getTvStreamUsedAttribute()
    {
        return $this->tvStream->where('thread_label', '!=', NULL)->count();
    }

    public function getTvStreamDeviceAttribute()
    {
        return $this->devices->where('type', 2)->count();
    }

    public static function getTreeStation($station_id) 
    {
        if (auth()->user()->hasRole('Admin')) {
            $stations = Station::query();
        }
        else {
            $parentArr = Station::whereIn('id', $station_id)->pluck('id')->toArray();
            $parentId = $parentArr;
            $data = $parentArr;
            while (count($parentId) > 0){
                $childs = Station::selectRaw("stations.*")
                    ->whereIn('stations.parent_id', $parentId)
                    ->get();
       
                $parentId = [];
                if(!empty($childs)) {
                    foreach($childs as $child){
                        array_push($parentId, $child->id);
                        array_push($data, $child->id);
                    }
                }
            } 

            $stations = Station::whereIn('id', $data);
        }

        return $stations;
    }
}
