<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
// use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreConferenceRequest;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $conferences = Conference::paginate(10);

        if ($request->search) {
            $conferences = Conference::where('title', 'like', '%'.$request->search.'%')->paginate(10);
            $conferences->appends(['search' => $request->search]);
        }

        $data = [
            'conferences' => $conferences
        ];

        return view('conference.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $units = Unit::all();
        
        // $data = [
        //     'units' => $units,
        // ];

        return view('conference.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConferenceRequest $request)
    {
        $params = $request->all();
        $params['date'] = date("Y-m-d", strtotime($request->date));
        Conference::create($params);
        return redirect()->route('conferences.index')->with('alert-success','Thêm lịch hội nghị thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conference = Conference::findOrFail($id);
        // $units = Unit::all();

        $data = [
            'data_edit' => $conference,
            // 'units' => $units,
        ];

        return view('conference.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreConferenceRequest $request, $id)
    {
        $params = $request->all();
        $params['date'] = date("Y-m-d", strtotime($request->date));
        Conference::findOrFail($id)->update($params);

        return redirect()->route('conferences.index')->with('alert-success','Cập nhật lịch hội nghị thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->destroy($id);
        return redirect()->route('conferences.index')->with('alert-success','Xóa lịch hội nghị thành công!');
    }
}
