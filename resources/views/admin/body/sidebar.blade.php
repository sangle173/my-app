<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        <li class="menu-label">Manage</li>

        @if (Auth::user()->can('category.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cart'></i>
                    </div>
                    <div class="menu-title">Manage Category</div>
                </a>
                <ul>
                    @if (Auth::user()->can('category.all'))
                        <li><a href="{{ route('all.category') }}"><i class='bx bx-radio-circle'></i>All Category </a>
                        </li>
                    @endif
                    @if (Auth::user()->can('subcategory.all'))
                        <li><a href="{{ route('all.subcategory') }}"><i class='bx bx-radio-circle'></i>All SubCategory
                            </a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif


        @if (Auth::user()->can('instructor.menu'))
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Manage Instructor</div>
                </a>
                <ul>
                    <li><a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>All Instructor</a>
                    </li>


                </ul>
            </li>
        @endif

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Task</div>
            </a>
            <ul>
                <li><a href="{{ route('admin.all.task') }}"><i class='bx bx-radio-circle'></i>All Task </a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Category</div>
            </a>
            <ul>
                <li><a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team </a>
                </li>
                <li><a href="{{ route('all.action') }}"><i class='bx bx-radio-circle'></i>All Action </a>
                </li>
                <li><a href="{{ route('all.workingstatus') }}"><i class='bx bx-radio-circle'></i>All Working Status </a>
                </li>
                <li><a href="{{ route('all.ticketstatus') }}"><i class='bx bx-radio-circle'></i>All Ticket Status </a>
                </li>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Report</div>
            </a>
            <ul>
                <li><a href="{{ route('report') }}"><i class='bx bx-radio-circle'></i>Filter Task </a>
                </li>
                <li><a href="{{ route('report.generate') }}"><i class='bx bx-radio-circle'></i>Generate Report</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage All QA</div>
            </a>
            <ul>
                <li><a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>All QA</a>
                </li>


            </ul>
        </li>


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Blog</div>
            </a>
            <ul>
                <li><a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category </a>
                </li>
                <li><a href="{{ route('blog.post') }}"><i class='bx bx-radio-circle'></i>Blog Post</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
