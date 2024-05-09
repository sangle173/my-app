<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                 data-bs-target="#SearchModal">
                <a href="{{ url('/') }}">Homepage</a>
            </div>
            <div class="position-relative search-bar d-lg-block d-none" data-bs-toggle="modal"
                 data-bs-target="#SearchModal">
                <input class="form-control px-5" disabled type="search" placeholder="Search">
                <span class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-5"><i
                        class='bx bx-search'></i></span>
            </div>


            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">
                    <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                        data-bs-target="#SearchModal">
                        <a class="nav-link" href="javascript:;"><i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                           data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
                        </a>

                    </li>
                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                        </a>
                    </li>

                    @php
                        $ncount = Auth::user()->unreadNotifications()->count();
                    @endphp

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           data-bs-toggle="dropdown"><span class="alert-count"
                                                           id="notification-count">{{ $ncount }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Thông báo</p>

                                </div>
                            </a>

                            @php
                                $user = Auth::user();
                            @endphp

                            <div class="header-notifications-list">
                                @forelse ($user->notifications as $notification)

                                    <a class="dropdown-item" href="javascript:;"
                                       onclick="markNotificationRead('{{ $notification->id }}')">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-danger text-danger">dc
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ $notification->data['message'] }} <span
                                                        class="msg-time float-end"> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} </span>
                                                </h6>
                                                <p class="msg-info">Đơn mới</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty

                                @endforelse


                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <button class="btn btn-primary w-100">Hiển thị tất cả thông báo</button>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                           role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">8</span>
                            <i class='bx bx-shopping-bag'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Giỏ hàng</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="mb-0">Tổng cộng</h5>
                                        <h5 class="mb-0 ms-auto">00.00vnd</h5>
                                    </div>
                                    <button class="btn btn-primary w-100">Chức năng đang phát triển</button>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

            @php
                $id = Auth::user()->id;
                $profileData = App\Models\User::find($id);
            @endphp

            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                        src="{{ (!empty($profileData->photo)) ? url('upload/instructor_images/'.$profileData->photo) : url('upload/no_image.jpg')}}"
                        class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{ $profileData->name }}</p>
                        <p class="designattion mb-0">{{ $profileData->email }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.profile') }}"><i
                                class="bx bx-user fs-5"></i><span>Thông tin tài khoản</span></a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center"
                           href="{{ route('instructor.change.password') }}"><i class="bx bx-cog fs-5"></i><span>Đổi mật khẩu </span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('instructor.logout') }}"><i
                                class="bx bx-log-out-circle"></i><span>Đăng xuất</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

<script>
    function markNotificationRead(notificationId) {

        fetch('/mark-notification-as-read/' + notificationId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/josn',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
            .then(response => response.json())
            .then(data => {
                document.getElementById('notification-count').textContent = data.count;
            })
            .catch(error => {
                console.log('Error', error)
            });
    }
</script>
