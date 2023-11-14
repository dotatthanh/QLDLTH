@extends('layouts.default')

@section('title') Giới thiệu hệ thống @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Giới thiệu hệ thống</h4>
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
                                        <ul class="wtree">
                                            @foreach ($items as $item)
                                                <li id="li-region-{{ $item->id }}" class="close-el">
                                                    <a href="{{ route('tv-system-introductions.system-introduction', ['region' => $item->type])}}">
                                                        @if (empty(request('region')))
                                                            @if ($item->type == 1)
                                                                <span class="text-primary">
                                                                    {{ getNameRegion($item->type) }}
                                                                </span>
                                                            @else
                                                                <span>
                                                                    {{ getNameRegion($item->type) }}
                                                                </span>
                                                            @endif
                                                        @elseif (request('region') == $item->type)
                                                            <span class="text-primary">
                                                                {{ getNameRegion($item->type) }}
                                                            </span>
                                                        @else
                                                            <span>
                                                                {{ getNameRegion($item->type) }}
                                                            </span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-lg-10">
                                        <embed src="{{ request('region') ? $items[request('region')-1]->file : $items->first()->file }}" width="100%" height="2100px" />
                                    </div>
                                </div>
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

@push('css')
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
            border: 1px solid #4c4848; 
            padding-left: 10px;
            color: #4c4848;
            text-decoration: none;
            font-size: 14px;
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