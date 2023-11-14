<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bx bx-home-circle mr-2"></i><span>Trang chủ</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tv-system-introductions.system-introduction') }}">
                            <i class="bx bx-info-circle mr-2"></i><span>Giới thiệu hệ thống truyền hình</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-document" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-calendar mr-2"></i><span key="t-apps">Quản lý</span> 
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a class="dropdown-item" href="{{ route('station.system-tree') }}">Quản lý trạm</a>
                            @can('Xem danh sách phân vùng')
                            <a class="dropdown-item" href="{{ route('regions.index') }}">Quản lý phân vùng</a>
                            @endcan
                            @can('Xem danh sách lịch hội nghị')
                            <a class="dropdown-item" href="{{ route('conferences.index') }}">Quản lý lich hội nghị</a>
                            @endcan
                            @can('Xem danh sách giới thiệu hệ thống truyền hình')
                            <a class="dropdown-item" href="{{ route('tv-system-introductions.index') }}">Giới thiệu hệ thống truyền hình</a>
                            @endcan
                        </div>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('station.system-tree') }}">
                            <i class="bx bx-calendar mr-2"></i>
                            <span>Quản lý trạm</span>
                        </a>
                    </li> --}}

                    {{-- @can('Xem danh sách phân vùng')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('regions.index') }}">
                                <i class="bx bx-calendar mr-2"></i>
                                <span>Quản lý phân vùng</span>
                            </a>
                        </li>
                    @endcan --}}

                    {{-- @can('Xem danh sách đơn vị BĐKT')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('units.index') }}">
                                <i class="bx bx-calendar mr-2"></i>
                                <span>Quản lý đơn vị</span>
                            </a>
                        </li>
                    @endcan --}}

                    {{-- @can('Xem danh sách lịch hội nghị')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('conferences.index') }}">
                                <i class="bx bx-calendar mr-2"></i>
                                <span>Quản lý lich hội nghị</span>
                            </a>
                        </li>
                    @endcan --}}

                    @can('Xem danh sách phần mềm hỗ trợ')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('softwares.index') }}">
                            <i class="bx bx-grid-alt mr-2"></i>
                            <span>Phần mềm hỗ trợ</span>
                        </a>
                    </li>
                    @endcan

                    @can('Xem danh sách tài liệu')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-document" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-customize mr-2"></i><span key="t-apps">Tài liệu</span> 
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <a class="dropdown-item" href="{{ route('document.video') }}">Tài liệu video</a>
                            <a class="dropdown-item" href="{{ route('document.read') }}">Tài liệu đọc</a>
                            <a class="dropdown-item" href="{{ route('document.english') }}">Tiếng anh chuyên ngành</a>
                        </div>
                    </li>
                    @endcan

                    @can('Xem danh sách tài khoản', 'Xem danh sách vai trò', 'Xem danh sách quyền')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-document" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-cog mr-2"></i><span key="t-apps">Cài đặt</span> 
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="topnav-document">
                            @can('Xem danh sách tài khoản')
                            <a class="dropdown-item" href="{{ route('users.index') }}">Tài khoản</a>
                            @endcan
                            @can('Xem danh sách vai trò')
                            <a class="dropdown-item" href="{{ route('roles.index') }}">Vai trò</a>
                            @endcan
                            @can('Xem danh sách quyền')
                            <a class="dropdown-item" href="{{ route('permissions.index') }}">Quyền</a>
                            @endcan
                        </div>
                    </li>
                    @endcan

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('transmission_streams.index') }}">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng truyền dẫn</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tv_streams.index') }}">
                            <i class="bx bx-calendar"></i>
                            <span>Luồng TH-TSL</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </nav>
    </div>
</div>