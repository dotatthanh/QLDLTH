<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransmissionStream;
use App\Models\TvStream;
use App\Models\Station;
use App\Models\Device;
use App\Models\Unit;
use App\Models\Conference;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $startOfYear = Carbon::now()->startOfYear()->toDateString();
        $startOfSixMonths = Carbon::now()->startOfYear()->addMonths(6);
        if (Carbon::now()->lt($startOfSixMonths)) {
            $startOfSixMonths = Carbon::now()->startOfYear();
        }
        $startOfSixMonths = $startOfSixMonths->toDateString();

        $timeNameWeek = 'Tuần';
        $statisticWeek = $this->test($startOfWeek, $timeNameWeek);

        $timeNameMonth = 'Tháng';
        $statisticMonth = $this->test($startOfMonth, $timeNameMonth);

        $timeNameSixMonth = 'Sáu tháng';
        $statisticSixMonth = $this->test($startOfSixMonths, $timeNameSixMonth);

        $timeNameYear = 'Năm';
        $statisticYear = $this->test($startOfYear, $timeNameYear);

        $conferences = Conference::orderBy('date', 'desc')->paginate(10);

        $data = [
            'statistics' => [
                $statisticWeek,
                $statisticMonth,
                $statisticSixMonth,
                $statisticYear
            ],
            'conferences' => $conferences,
        ];

    	return view('dashboard.dashboard', $data);
    }

    public function test($startDate, $timeName) {
        $today = Carbon::now()->toDateString();
        $data = Conference::select([
            DB::raw('COALESCE(SUM(bridge_point), 0) as total_bridge_point'),
            DB::raw('COUNT(*) as total_conference'),
            DB::raw("'" . $timeName . "' as time")
        ])
        ->whereBetween('date', [$startDate, $today])
        ->first()
        ->toArray();

        return $data;
    }

    public function search(Request $request)
    {
        $transmission_streams = TransmissionStream::query();
        $tv_streams = TvStream::query();

        if (isset($request->station_id)) {
            $station = Station::find($request->station_id);
            $transmission_streams = $transmission_streams->where('station_id', $request->station_id);
            $tv_streams = $tv_streams->where('station_id', $request->station_id);
        }
        else {
            $station = Station::find(0);
        }

        if (isset($request->device_id)) {
            $transmission_streams = $transmission_streams->where('device_id', $request->device_id);
            $tv_streams = $tv_streams->where('device_id', $request->device_id);
        }

        if (isset($request->name_card)) {
            $transmission_streams = $transmission_streams->where('name_card', 'like', '%'.$request->name_card.'%');
            $tv_streams = $tv_streams->where('name_card', 'like', '%'.$request->name_card.'%');
        }

        if (isset($request->coordinates_origin)) {
            $transmission_streams = $transmission_streams->where('coordinates_origin', 'like', '%'.$request->coordinates_origin.'%');
            $tv_streams = $tv_streams->where('coordinates_origin', 'like', '%'.$request->coordinates_origin.'%');
        }

        if (isset($request->port_origin)) {
            $transmission_streams = $transmission_streams->where('port_origin', $request->port_origin);
            $tv_streams = $tv_streams->where('port_origin', $request->port_origin);
        }

        if (isset($request->thread_label)) {
            $transmission_streams = $transmission_streams->where('thread_label', 'like', '%'.$request->thread_label.'%');
            $tv_streams = $tv_streams->where('thread_label', 'like', '%'.$request->thread_label.'%');
        }

        $transmission_streams = $transmission_streams->get();
        $tv_streams = $tv_streams->get();

        $data = [
            'station' => $station,
            'tv_streams' => $tv_streams,
            'transmission_streams' => $transmission_streams,
        ];

        return view('dashboard.search', $data);
    }

    public function statistic()
    {
        $units = Unit::getTreeUnit([auth()->user()->unit_id])->pluck('id')->toArray();
        $stations = Station::whereIn('unit_id', $units)->paginate(10);

        // $stations = Station::with('tranmissionStream', 'tvStream')->paginate(10);
        
        $data = [
            'stations' => $stations,
        ];

        return view('dashboard.statistic', $data);
    }
}
