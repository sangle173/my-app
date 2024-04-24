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
            <h4 class="logo-text">QA Board</h4>
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
                <a href="{{ route('all.task') }}">
                    <div class="parent-icon"><i class="text-success lni lni-bookmark"></i>
                    </div>
                    <div class="menu-title">My Tasks</div>
                </a>
            </li>

            <li>
                <a href="{{ route('report.generate') }}">
                    <div class="parent-icon"><i class="text-primary lni lni-medall-alt"></i>
                    </div>
                    <div class="menu-title">Report</div>
                </a>
            </li>
            <li>
                <a href="{{ route('all.file') }}">
                    <div class="parent-icon"><i class="text-info lni lni-files"></i>
                    </div>
                    <div class="menu-title">My Files</div>
                </a>
            </li>
            <li>
                <a href="{{ route('share.file') }}">
                    <div class="parent-icon"><i class="text-info lni lni-share"></i>
                    </div>
                    <div class="menu-title">Team Share Files</div>
                </a>
            </li>
            <li>
                <a href="{{ route('instructor.blog.post') }}">
                    <div class="parent-icon"><i class="text-danger lni lni-postcard"></i>
                    </div>
                    <div class="menu-title">Posts</div>
                </a>
            </li>
        @else

        @endif
    </ul>
    <!--end navigation-->
</div>
