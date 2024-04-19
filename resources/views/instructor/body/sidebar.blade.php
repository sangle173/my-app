@php
    $id = Auth::user()->id;
    $instructorId = App\Models\User::find($id);
    $status = $instructorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Giảng Viên</h4>
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

        @if ($status === '1')

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="lni lni-graduation"></i>
                    </div>
                    <div class="menu-title">Khóa học</div>
                </a>
                <ul>
                    <li><a href="{{ route('all.course') }}"><i class='bx bx-radio-circle'></i>Danh sách khóa học </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-briefcase"></i>
                    </div>
                    <div class="menu-title">Danh mục</div>
                </a>
                <ul>
                    <li><a href="{{ route('instructor.all.category') }}"><i class='bx bx-radio-circle'></i>Tất cả danh
                            mục</a>
                    </li>
                    <li><a href="{{ route('instructor.all.subcategory') }}"><i class='bx bx-radio-circle'></i>Tất cả
                            danh mục con</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="lni lni-users"></i>
                    </div>
                    <div class="menu-title">Học viên</div>
                </a>
                <ul>
                    <li><a href="{{ route('instructor.all.user') }}"><i class='bx bx-radio-circle'></i>Tất cả học viên
                        </a>
                    </li>
                </ul>
            </li>

{{--            <li>--}}
{{--                <a class="has-arrow" href="javascript:;">--}}
{{--                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>--}}
{{--                    </div>--}}
{{--                    <div class="menu-title">Sếp học viên</div>--}}
{{--                </a>--}}
{{--                <ul>--}}
{{--                    <li><a href="{{ route('instructor.order.add') }}"><i class='bx bx-radio-circle'></i>Sếp lớp học viên</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-captions'></i>
                    </div>
                    <div class="menu-title">Bài viết </div>
                </a>
                <ul>
                    <li> <a href="{{ route('instructor.blog.post') }}"><i class='bx bx-radio-circle'></i>Danh sách bài viết</a>
                    </li>
                    <li> <a href="{{ route('instructor.blog.category') }}"><i class='bx bx-radio-circle'></i>Danh mục </a>
                    </li>
                </ul>
            </li>
        @else

        @endif
    </ul>
    <!--end navigation-->
</div>
