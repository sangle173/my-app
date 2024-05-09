@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<header class="header-menu-area bg-light">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                    class="la la-phone mr-1"></i><a href="tel:00123456789"> 0905 123 346</a></li>
                            <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a
                                    href="mailto: sang.le@agest.vn">sonos-qateam</a></li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">

                            @auth
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-sign-in mr-1"></i><a href="{{ route('dashboard') }}"> Dashboard</a>
                                </li>
                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                        href="{{ route('user.logout') }}"> Logout</a></li>

                            @else

                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-sign-in mr-1"></i><a href="{{ route('instructor.login') }}"> Login</a>
                                </li>
                                {{--    <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="{{ route('register') }}"> Đăng ký</a></li>--}}

                            @endauth


                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-top -->
    <div class="header-menu-content pr-150px pl-150px" style="background: #bac0c6">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ url('/') }}" class="logo">
{{--                                <img src="{{ asset('frontend/images/logo2.png') }}"--}}
{{--                                                                       width="250px" height="60px" alt="logo">--}}
                                <h1 style="font-family: bold,'Bookman Old Style'; color: black"><b>SONOS</b></h1>
                            </a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                     data-toggle="tooltip" data-placement="top" title="Tìm kiếm">
                                    <i class="la la-search"></i>
                                </div>
                                <div
                                    class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Danh mục">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div
                                    class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Menu chính">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->

                    @php
                        $teams = App\Models\Team::orderBy('team_name','ASC')->get();
                    @endphp

                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a href="#">Team <i class="la la-angle-down fs-12"></i></a>
                                        <ul class="cat-dropdown-menu">

                                            @foreach ($teams as $cat)
                                                <li>
                                                    <a href="{{ url('category/'.$cat->id.'/'.$cat->team_slug) }}">{{ $cat->team_name }}
                                                        <i class="la la-angle-right"></i></a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- end menu-category -->
                            <form method="post">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search"
                                           placeholder="Search ...">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="{{ url('/')}}">Homepage</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog') }}">Post </a>
                                    </li>
                                </ul><!-- end ul -->
                            </nav><!-- end main-menu -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
             data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="{{url('/')}}">Homepage</a>
            </li>
        </ul>
        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">

            @auth
                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                        class="la la-sign-in mr-1"></i><a href="{{ route('dashboard') }}"> Dashboard</a>
                </li>
                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                        href="{{ route('user.logout') }}"> Logout</a></li>

            @else

                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                        class="la la-sign-in mr-1"></i><a href="{{ route('instructor.login') }}"> Login</a>
                </li>
                {{--    <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a href="{{ route('register') }}"> Đăng ký</a></li>--}}

            @endauth


        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip"
             data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div><!-- end off-canvas-menu-close -->
        @php
            $teams = App\Models\Team::all();
        @endphp
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="#" class="text-secondary">Team</a>
            </li>
            @foreach ($teams as $cat)
                <li>
                    <a href="{{ url('category/'.$cat->id.'/'.$cat->team_slug) }}">{{ $cat->team_name }}</a>
                </li>
            @endforeach
        </ul>
    </div><!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search"
                           placeholder="Tìm kiếm ...">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div><!-- end off-canvas-menu-close -->
        </div>
    </div><!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header><!-- end header-menu-area -->
