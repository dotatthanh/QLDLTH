<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Region;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Http\Requests\StoreStationRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TestImport;
use Exception;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $stations = Station::query();

        if (!$user->hasRole('Admin')) {
            $stations = $stations->where('region_id', $user->region_id);
        }

        if ($request->search) {
            $stations = $stations->where('name', 'like', '%'.$request->search.'%')
            ->orWhere('phone_number', 'like', '%'.$request->search.'%')
            ->orWhereHas('region', fn($query) =>
                $query->where('name', 'like', '%'.$request->search.'%')
            );
            // if ($stations->count() == 0) {
            //     $stations = $stations->orWhere('phone_number', 'like', '%'.$request->search.'%');

            //     if ($stations->count() == 0) {
            //         $stations = $stations->orWhereHas('region', fn($query) =>
            //             $query->where('name', 'like', '%'.$request->search.'%')
            //         );
            //     }
            // }
        }
        $stations = $stations->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'stations' => $stations
        ];

        return view('station.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            $regions = Region::where('id', $user->region_id)->get();
        }
        else {
            $regions = Region::all();
        }

        $data = [
            'regions' => $regions,
        ];

        return view('station.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStationRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Station::create([
                'name' => $request->name,
                'region_id' => $request->region_id,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Thêm trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm trạm thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        $data = [
            'station' => $station
        ];
        
        return view('station.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        // $stations = Station::getTreeStation([auth()->user()->unit_id])->get();

        $data = [
            'data_edit' => $station,
            // 'stations' => $stations,
        ];

        return view('station.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStationRequest $request, Station $station)
    {
        try {
            DB::beginTransaction();

            $station->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            
            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Sửa trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa trạm thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        try {
            DB::beginTransaction();

            $station->devices()->delete();
            $station->tranmissionStream()->delete();
            $station->tvStream()->delete();
            $station->destroy($station->id);

            DB::commit();
            return redirect()->route('stations.index')->with('alert-success','Xóa trạm thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa trạm thất bại!');
        }
    }

    public function systemTree(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('Admin')) {
            $dataNorth = Region::select(['id','name','type',])->where('type', getConst('region.north.key'))->get();
            $dataCentralRegion = Region::select(['id','name','type',])->where('type', getConst('region.central_region.key'))->get();
            $dataSouthern = Region::select(['id','name','type',])->where('type', getConst('region.southern.key'))->get();
            $dataTest = Test::query();
            if (isset($request->station_id)) {
                $dataTest = $dataTest->where('region_id', $request->station_id);
            }

            if (isset($request->search)) {
                $dataTest = $dataTest
                ->whereHas('station', function ($query) use ($request) {
                    $query->where('name', 'like', '%'.$request->search.'%');
                });
            }

            $dataTest = $dataTest->paginate(100)->appends([
                'station_id' => $request->station_id,
                'search' => $request->search,
            ]);
        }
        else {
            $regionId = $user->region_id;
            $dataNorth = Region::select(['id','name','type',])->where([
                'type' => getConst('region.north.key'),
                'id' => $user->region_id
            ])->get();
            $dataCentralRegion = Region::select(['id','name','type',])->where([
                'type' => getConst('region.central_region.key'),
                'id' => $user->region_id
            ])->get();
            $dataSouthern = Region::select(['id','name','type',])->where([
                'type' => getConst('region.southern.key'),
                'id' => $user->region_id
            ])->get();
            $dataTest = Test::where('region_id', $regionId)->paginate(100)->appends([
                'search' => $request->search,
            ]);
        }

        $data = [
            'dataNorth' => $dataNorth,
            'dataCentralRegion' => $dataCentralRegion,
            'dataSouthern' => $dataSouthern,
            'request' => $request,
            'dataTest' => $dataTest
        ];

        return view('station.system-tree', $data);
    }

    public function getStationChildList(Request $request){
        $parents = Station::where([
            'parent_id' => $request->id
        ])->get();

        $dataList = [];
        if(!empty($parents)){
            foreach($parents as $parent) {
                $count_child = DB::table('stations as station')
                ->where('station.parent_id', $parent['id'])
                ->count();
                array_push($dataList,[
                    'id' => $parent->id,
                    'parent_id' => $parent->parent_id,
                    'name' => $parent->name,
                    'count_child' => $count_child,
                ]);
            }
        }

        return \response()->json([
            'status'=> 1,
            'data_unit' => $dataList,
        ]);
    }

    public function getStationByRegion(Request $request){
        $parents = Station::where([
            'region_id' => $request->id,
            'parent_id' => null
        ])->get();

        $dataList = [];
        if(!empty($parents)){
            foreach($parents as $parent) {
                $count_child = DB::table('stations as station')
                ->where('station.parent_id', $parent['id'])
                ->count();
                array_push($dataList,[
                    'id' => $parent->id,
                    'parent_id' => $parent->parent_id,
                    'name' => $parent->name,
                    'count_child' => $count_child,
                ]);
            }
        }

        return \response()->json([
            'status'=> 1,
            'data_unit' => $dataList,
        ]);
    }

    public function importExcel(Request $request) 
    {
        try {
            DB::beginTransaction();
            $import = new TestImport();
            $import->import($request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

            DB::commit();
            return back()->with('alert-success', 'Nhập excel thành công.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            DB::rollback();
            $failures = collect($e->failures());
            return back()->with('failures', $failures);
        }

    }
}
