@extends('layouts.default')

@section('title') Trang chủ @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="carouselExampleCaption" class="carousel slide mt-5" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            {{-- <img src="images/small/img-7.jpg" alt="..." class="d-block img-fluid">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5>First slide label</h5>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div> --}}
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th style="width: 20px;">STT</th>
                                                            <th>Ngày</th>
                                                            <th>Hội nghị</th>
                                                            <th>Địa điểm tổ chức</th>
                                                            <th>Số điểm cầu</th>
                                                            <th>Chủ trì</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php ($sttConference = 1) @endphp
                                                        @foreach ($conferences as $conference)
                                                        <tr class="{{ $conference->date > date('Y-m-d') ? 'bg-conference-success' : 'bg-conference-primary' }}">
                                                            <td class="text-center">{{ $sttConference++ }}</td>
                                                            <td>{{ formatDate($conference->date, 'd-m-Y') }}</td>
                                                            <td>{{ $conference->title }}</td>
                                                            <td>{{ $conference->unit }}</td>
                                                            <td>{{ $conference->bridge_point }}</td>
                                                            <td>{{ $conference->preside }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{ $conferences->links() }}
                                        </div>
                                        <div class="carousel-item">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th style="width: 20px;">STT</th>
                                                            <th>Thời gian</th>
                                                            <th>Tổng số hội nghị</th>
                                                            <th>Số lượt điểm cầu</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php ($sttStatistic = 1) @endphp
                                                        @foreach ($statistics as $statistic)
                                                        <tr>
                                                            <td class="text-center">{{ $sttStatistic++ }}</td>
                                                            <td>{{ $statistic['time'] }}</td>
                                                            <td>{{ $statistic['total_conference'] }}</td>
                                                            <td>{{ $statistic['total_bridge_point'] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>
@endpush

@push('css')
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        .select2 {
            width: 100%!important;
        }
    </style>
@endpush