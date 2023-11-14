<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegionRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = Region::paginate(100);

        if ($request->search) {
            $regions = Region::where('name', 'like', '%'.$request->search.'%')->paginate(100);
            $regions->appends(['search' => $request->search]);
        }

        $data = [
            'regions' => $regions
        ];

        return view('region.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = getConst('region');
        unset($regions['system']);

        $data = [
            'regions' => $regions,
        ];

        return view('region.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        try {
            DB::beginTransaction();
            
            Region::create([
                'name' => $request->name,
                'type' => $request->type,
            ]);
            
            DB::commit();
            return redirect()->route('regions.index')->with('alert-success','Thêm phân vùng thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm phân vùng thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $regions = getConst('region');
        unset($regions['system']);
        
        $data = [
            'regions' => $regions,
            'data_edit' => $region,
        ];

        return view('region.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRegionRequest $request, Region $region)
    {
        try {
            DB::beginTransaction();

            $region->update([
                'name' => $request->name,
                'type' => $request->type,
            ]);
            
            DB::commit();
            return redirect()->route('regions.index')->with('alert-success','Sửa phân vùng thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa phân vùng thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        try {
            DB::beginTransaction();

            $region->destroy($region->id);
            
            DB::commit();
            return redirect()->route('regions.index')->with('alert-success','Xóa phân vùng thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa phân vùng thất bại!');
        }
    }
}
