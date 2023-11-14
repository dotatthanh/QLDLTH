<?php

namespace App\Http\Controllers;

use App\Models\TvSystemIntroduction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTvSystemIntroductionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class TvSystemIntroductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tvSystemIntroductions = TvSystemIntroduction::all();

        $data = [
            'tvSystemIntroductions' => $tvSystemIntroductions
        ];

        return view('tv-system-introduction.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvSystemIntroduction  $tvSystemIntroduction
     * @return \Illuminate\Http\Response
     */
    public function show(TvSystemIntroduction $tvSystemIntroduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TvSystemIntroduction  $tvSystemIntroduction
     * @return \Illuminate\Http\Response
     */
    public function edit(TvSystemIntroduction $tvSystemIntroduction)
    {
        $data = [
            'data_edit' => $tvSystemIntroduction,
        ];

        return view('tv-system-introduction.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TvSystemIntroduction  $tvSystemIntroduction
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTvSystemIntroductionRequest $request, TvSystemIntroduction $tvSystemIntroduction)
    {
        try {
            DB::beginTransaction();
            if ($request->file('file')) {
                $name = time().'_'.$request->file->getClientOriginalName();
                $file_path_file = 'uploads/software/file/'.$name;
                Storage::disk('public_uploads')->putFileAs('software/file', $request->file, $name);
                $data['file'] = $file_path_file;
                $tvSystemIntroduction->update($data);
            }

            DB::commit();
            return redirect()->route('tv-system-introductions.index')->with('alert-success','Cập nhật thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật thất bại!');
        }
    }

    public function systemIntroduction() {
        $items = TvSystemIntroduction::all();
        $data = [
            'items' => $items,
        ];

        return view('tv-system-introduction.system-introduction', $data);
    }
}
