<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Station;
use App\Models\Region;
use App\Models\Test;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Exception;

class TestImport implements ToCollection, WithHeadingRow, WithValidation
{
	use Importable;
    /**
    * @param Collection $collection
    */

    public function  __construct()
    {
    }

    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();

            foreach ($collection as $row) {
	            $regionId = Region::where('name', $row['region_name'])->first()->id;
                
                $station = Station::create([
                    'name' => $row['station_name'],
                    'region_id' => $regionId,
                ]);

                Test::create([
                    'station_id' => $station->id,
                    'region_id' => $regionId,
                    'ip_address' => $row['ip_address'],
                    'subnet' => $row['subnet'],
                    'gateway' => $row['gateway'],
                    'vlan' => $row['vlan'],
                    'swl2_transmission' => $row['swl2_transmission'],
                    'swl2_security' => $row['swl2_security'],
                    'swl3' => $row['swl3'],
                    'coordinates_origin' => $row['coordinates_origin'],
                    'coordinates_remote' => $row['coordinates_remote'],
                    'level' => $row['level'],
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function rules(): array
    {
        $checkRegion = '';
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            $checkRegion = '|in:'.$user->region->name;
        }
        return [
        	'*.region_name' => 'required|exists:regions,name'.$checkRegion,
        	'*.station_name' => 'required|unique:stations,name',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'region_name.required' => 'Phân vùng là trường bắt buộc.',
            'region_name.exists' => 'Phân vùng không tồn tại.',
            'region_name.in' => 'Phân vùng không được quyền quản lý.',
            'station_name.required' => 'Tên trạm là trường bắt buộc.',
            'station_name.unique' => 'Tên trạm đã tồn tại.',
        ];
    }
}
