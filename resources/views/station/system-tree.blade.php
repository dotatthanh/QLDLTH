@extends('layouts.default')

@section('title') Quản lý trạm @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Quản lý trạm</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('stations.index') }}" title="Quản lý trạm" data-toggle="tooltip" data-placement="top">Quản lý trạm</a></li>
                                    <li class="breadcrumb-item active">Quản lý trạm</li>
                                </ol>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <p class="parent">{{ getConst('region.north.value') }}</p>
                                        @foreach ($dataNorth as $regionNorth)
                                            <ul class="wtree">
                                                <li id="li-region-{{ $regionNorth->id }}" class="close-el">
                                                    <a href="?station_id={{ $regionNorth->id }}">
                                                        <span {{ request('station_id') == $regionNorth->id ? 'class=text-primary' : '' }}>
                                                            {{ $regionNorth->name }}
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach

                                        <p class="parent">{{ getConst('region.central_region.value') }}</p>
                                        @foreach ($dataCentralRegion as $regionCentralRegion)
                                            <ul class="wtree">
                                                <li id="li-region-{{ $regionCentralRegion->id }}" class="close-el">
                                                    <a href="?station_id={{ $regionCentralRegion->id }}">
                                                        <span {{ request('station_id') == $regionCentralRegion->id ? 'class=text-primary' : '' }}>
                                                            {{ $regionCentralRegion->name }}
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach

                                        <p class="parent">{{ getConst('region.southern.value') }}</p>
                                        @foreach ($dataSouthern as $regionSouthern)
                                            <ul class="wtree">
                                                <li id="li-region-{{ $regionSouthern->id }}" class="close-el">
                                                    <a href="?station_id={{ $regionSouthern->id }}">
                                                        <span {{ request('station_id') == $regionSouthern->id ? 'class=text-primary' : '' }}>
                                                            {{ $regionSouthern->name }}
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>

                                    <div class="col-lg-10">
                                        <div class="row">
                                            @can('Xem danh sách trạm')
                                            <div class="col-lg-3">
                                                <a href="{{ route('stations.index') }}" class="d-inline-block text-white btn btn-success btn-rounded waves-effect waves-light mt-2 mb-2">Danh sách trạm</a>
                                            </div>
                                            @endcan

                                            @can('Nhập excel trạm')
                                            <div class="col-lg-9 text-right">
                                                <form action="{{ route('stations.import-excel') }}" method="POST" enctype="multipart/form-data" class="mb-2 text-right">
                                                    @csrf

                                                    <input type="file" name="file" required>
                                                    <button type="submit" class="btn btn-success">Nhập excel</button>
                                                </form>
                                            </div>
                                            @endcan
                                        </div>

                                        <form method="GET" action="{{ route('station.system-tree') }}">
                                            <div class="row mb-2">
                                                <div class="col-sm-4">
                                                    <div class="search-box mr-2 mb-2">
                                                        <div class="position-relative">
                                                            <input type="text" name="search" class="form-control" placeholder="Nhập tên điểm cầu">
                                                            <i class="bx bx-search-alt search-icon"></i>

                                                            @if (request('station_id'))
                                                            <input type="text" hidden name="station_id" value="{{ request('station_id') }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                                        <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        @if (session()->has('failures'))
                                            <table class="table table-danger">
                                                <tr>
                                                    <th colspan="2" class="text-center font-weight-bold">Có một số lỗi xảy ra</th>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Hàng</td>
                                                    <td class="font-weight-bold">Lỗi</td>
                                                </tr>
                                                @foreach(session()->get('failures') as $validation)
                                                    <tr>
                                                        <td>{{ $validation->row() }}</td>
                                                        <td>
                                                            <ul>
                                                                @foreach($validation->errors() as $e)
                                                                    <li>{{ $e }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif
                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="width: 70px;" class="text-center">STT</th>
                                                        <th>Tên điểm cầu</th>
                                                        <th>Đơn vị BĐKT</th>
                                                        <th>Địa chỉ IP</th>
                                                        <th>Subnet</th>
                                                        <th>Gateway</th>
                                                        <th>Vlan</th>
                                                        <th>SWL2 truyền dẫn</th>
                                                        <th>SWL2 bảo mật</th>
                                                        <th>SWL3</th>
                                                        <th>Toạ độ đầu gần</th>
                                                        <th>Toạ độ đầu xa</th>
                                                        <th>Cấp</th>
                                                        {{-- <th class="text-center">Hành động</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php ($stt = 1)
                                                    @foreach ($dataTest as $test)
                                                        <tr>
                                                            <td class="text-center">{{ $stt++ }}</td>
                                                            <td>{{ $test->station ? $test->station->name : '' }}</td>
                                                            <td>{{ $test->region ? $test->region->name : '' }}</td>
                                                            <td>{{ $test->ip_address }}</td>
                                                            <td>{{ $test->subnet }}</td>
                                                            <td>{{ $test->gateway }}</td>
                                                            <td>{{ $test->vlan }}</td>
                                                            <td>{{ $test->swl2_transmission }}</td>
                                                            <td>{{ $test->swl2_security }}</td>
                                                            <td>{{ $test->swl3 }}</td>
                                                            <td>{{ $test->coordinates_origin }}</td>
                                                            <td>{{ $test->coordinates_remote }}</td>
                                                            <td>{{ $test->level }}</td>
                                                            {{-- <td class="text-center">
                                                                @if ($test->id != 1)
                                                                <ul class="list-inline font-size-20 contact-links mb-0">
                                                                    @can('Chỉnh sửa tài khoản')
                                                                    <li class="list-inline-item px">
                                                                        <a href="{{ route('users.edit', $test->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                                    </li>
                                                                    @endcan
        
                                                                    @can('Xóa tài khoản')
                                                                    <li class="list-inline-item px">
                                                                        <form method="post" action="{{ route('users.destroy', $test->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            
                                                                            <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                        </form>
                                                                    </li>
                                                                    @endcan
                                                                </ul>
                                                                @endif
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        {{-- @if (isset($request->device_id) || isset($request->device_id)) --}}
                                            <div class="mt-3">
                                                {{ $dataTest->links() }}
                                            </div>
                                        {{-- @endif --}}
                                    </div>
                                </div>

                                {{-- @foreach ($dataList as $region)
                                    <ul class="wtree">
                                        @if ($region['count'])
                                            @foreach ($region['childs'] as $item)
                                                <li id="li-region-{{ $item['id'] }}" class="close-el">
                                                    <span>{{ $item['name'] }}</span>

                                                    @if ($item['count_station'] > 0)
                                                        <i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="{{ $item['id'] }}" onclick="extendLevel({{ $item['id'] }})" id="icon-region-{{ $item['id'] }}"></i>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


       
    </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('js\pages\form-advanced.init.js') }}"></script>
    <script type="text/javascript">
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
        });

        function extendLevel(regionId) {
            var li = $("#li-region-" + regionId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (li.hasClass("close-el")) {
                $.ajax({
                    url: "/station/get-station-by-region",
                    type: "POST",
                    data: {
                        id: regionId,
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            $("#icon-region-" + regionId).addClass('fa-minus-circle').removeClass('fa-plus-circle');
                            $(li).addClass("open-el").removeClass("close-el");

                            var html = `<ul>`;
                            var button_extend = "";
                            $.each(data.data_unit, function( index, value ) {
                                if (value.count_child > 0) {
                                    button_extend = `<i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="`+ value.id +`" onclick="extendLevelChild(`+ value.id +`)" id="icon-station-`+ value.id +`"></i>`;
                                }
                                html += `<li id="li-station-`+ value.id +`" class="close-el">
                                    <a href="?station_id=${value.id}">`+ button_extend + ` ` + value.name + ` </a>
                                    </li>`;
                            });

                            html += `</ul>`;
                            $(`#li-region-${regionId}`).append(html);
                        }
                    },
                });
            } else {
                $("#icon-region-" + regionId).addClass('fa-plus-circle').removeClass('fa-minus-circle');
                $(li).addClass("close-el").removeClass("open-el");
                $("#li-region-" + regionId + " ul").remove();
            }
        }

        function extendLevelChild(stationParentId) {
            var li = $("#li-region-" + stationParentId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (li.hasClass("close-el")) {
                $.ajax({
                    url: "/station/get-station-child-list",
                    type: "POST",
                    data: {
                        id: stationParentId,
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            $("#icon-station-" + stationParentId).addClass('fa-minus-circle').removeClass('fa-plus-circle');
                            $(li).addClass("open-el").removeClass("close-el");

                            var html = `<ul>`;
                            var button_extend = "";
                            $.each(data.data_unit, function( index, value ) {
                                if (value.count_child > 0) {
                                    button_extend = `<i class="fa fa-plus-circle extend-level" aria-hidden="true" data-id="`+ value.id +`" onclick="extendLevelChild(`+ value.id +`)" id="icon-station-`+ value.id +`"></i>`;
                                }
                                html += `<li id="li-station-`+ value.id +`" class="close-el">
                                    <a href="?station_id=${value.id}">`+ button_extend + ` ` + value.name + ` </a>
                                    </li>`;
                            });

                            html += `</ul>`;
                            $(`#li-station-${stationParentId}`).append(html);
                        }
                    },
                });
            } else {
                $("#icon-station-" + stationParentId).addClass('fa-plus-circle').removeClass('fa-minus-circle');
                $(li).addClass("close-el").removeClass("open-el");
                $("#li-station-" + stationParentId + " ul").remove();
            }
        }
    </script>
@endpush

@push('css')
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">

    <style type="text/css">
        .extend-level {
            float: left;
            padding-right: 5px;
            margin-top: 2px;
            font-size: 18px;
            cursor: pointer;
            color: #4c4848 !important;
        }
        ul {
            padding-left: 20px;
        }
        .parent {
            display: block;
            padding-left: 10px;
            color: #4c4848;
            text-decoration: none;
            font-weight: bold;
        }

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }
        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
        }
        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #4c4848;
            border-top: 1px solid #4c4848;
            width: 20px;
            height: 100%;
        }
        .wtree li:last-child:after {
        display: none;
        }
        .wtree li a {
            display: block;
            color: #4c4848;
            text-decoration: none;
        }
        .wtree li span:hover + ul li:after, .wtree li span:hover + ul li:before, .wtree li span:focus + ul li:after, .wtree li span:focus + ul li:before {
            border-color: #4c4848;
        }
    </style>
@endpush