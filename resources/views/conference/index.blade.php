@extends('layouts.default')

@section('title') Quản lý lịch hội nghị @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-100 mb-5">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách lịch hội nghị</h4>

                            {{-- <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">Cài đặt</li>
                                    <li class="breadcrumb-item"><a href="{{ route('conferences.index') }}" title="Quản lý lịch hội nghị" data-toggle="tooltip" data-placement="top">lịch hội nghị</a></li>
                                    <li class="breadcrumb-item active">Danh sách lịch hội nghị</li>
                                </ol>
                            </div> --}}
                        </div>

                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('conferences.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên lịch hội nghị" value="{{ request('search') }}">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>


                                        @can('Thêm lịch hội nghị')
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('conferences.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm lịch hội nghị</a>
                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 20px;">STT</th>
                                                <th>Ngày</th>
                                                <th>Hội nghị</th>
                                                <th>Đơn vị tổ chức</th>
                                                <th>Số điểm cầu</th>
                                                <th>Chủ trì</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($sttConference = 1) @endphp
                                            @foreach ($conferences as $conference)
                                            <tr>
                                                <td class="text-center">{{ $sttConference++ }}</td>
                                                <td>{{ $conference->date }}</td>
                                                <td>{{ $conference->title }}</td>
                                                <td>{{ $conference->unit }}</td>
                                                <td>{{ $conference->bridge_point }}</td>
                                                <td>{{ $conference->preside }}</td>
                                                <td class="text-center">
                                                    <ul class="list-inline font-size-20 contact-links mb-0">
                                                        @can('Chỉnh sửa lịch hội nghị')
                                                        <li class="list-inline-item px">
                                                            <a href="{{ route('conferences.edit', $conference->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                        </li>
                                                        @endcan

                                                        @can('Xóa lịch hội nghị')
                                                        <li class="list-inline-item px">
                                                            <form method="post" action="{{ route('conferences.destroy', $conference->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                
                                                                <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                            </form>
                                                        </li>
                                                        @endcan
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $conferences->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
@endsection