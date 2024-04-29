<section class="register-area section-padding dot-bg overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-24 font-weight-semi-bold pb-2">Upload Your Files</h3>
                        <div class="divider"><span></span></div>
                        <form id="myForm" action="{{ route('user.uploadfile') }}" method="get" class="row g-3">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group col-md-12">
                                <label class="form-label" for="tester_id">Select QA</label>
                                <div class="form-group">
                                    <select name="tester_id" id="tester_id" class="form-control form--control mb-3"
                                            aria-label="Default select example">
                                        <option selected="" disabled>Select Tester</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn theme-btn" type="submit">Go To Upload Page <i
                                        class="la la-arrow-right icon ml-1"></i></button>
                            </div><!-- end input-box -->
                        </form>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->
{{--            <div class="col-lg-12">--}}
{{--                <div class="card card-item">--}}
{{--                    <div class="card-body">--}}
{{--                        @auth--}}
{{--                            <div class="register-content">--}}
{{--                                <div class="section-heading">--}}
{{--                                    <h5 class="ribbon ribbon-lg mb-2">Dashboard</h5>--}}
{{--                                    <h2 class="section__title">Go to Dashboard</h2>--}}
{{--                                    --}}{{--                        <span class="section-divider"></span>--}}
{{--                                    --}}{{--                        <p class="section__desc">Education is the process of acquiring the body of knowledge and skills that people are expected have in your society. A education develops a critical thought process in addition to learning. Bimply dummy text of the printing and typesetting istryrem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid architecto aspernatur, facilis perspiciatis rerum saepe vel vitae? Alias culpa dicta facere maiores quam quas, quis sapiente voluptatem? Nulla, voluptatem.</p>--}}
{{--                                </div><!-- end section-heading -->--}}
{{--                                <div class="btn-box pt-35px">--}}
{{--                                    <a href="{{route('instructor.dashboard')}}" class="btn theme-btn">Go To Dashboard <i--}}
{{--                                            class="la la-arrow-right mr-1"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="register-content">--}}
{{--                                <div class="section-heading">--}}
{{--                                    <h5 class="ribbon ribbon-lg mb-2">Login</h5>--}}
{{--                                    <h2 class="section__title">Login to see more functions</h2>--}}
{{--                                    --}}{{--                        <span class="section-divider"></span>--}}
{{--                                    --}}{{--                        <p class="section__desc">Education is the process of acquiring the body of knowledge and skills that people are expected have in your society. A education develops a critical thought process in addition to learning. Bimply dummy text of the printing and typesetting istryrem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid architecto aspernatur, facilis perspiciatis rerum saepe vel vitae? Alias culpa dicta facere maiores quam quas, quis sapiente voluptatem? Nulla, voluptatem.</p>--}}
{{--                                </div><!-- end section-heading -->--}}
{{--                                <div class="btn-box pt-35px">--}}
{{--                                    <a href="{{route('instructor.login')}}" class="btn theme-btn"><i--}}
{{--                                            class="la la-user mr-1"></i>Login</a>--}}
{{--                                </div>--}}
{{--                            </div><!-- end register-content -->--}}
{{--                        @endauth--}}
{{--                    </div><!-- end card-body -->--}}
{{--                </div><!-- end card -->--}}
{{--            </div><!-- end col-lg-5 -->--}}
            <div class="col-lg-12">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="fs-24 font-weight-semi-bold pb-2">Shared Files</h3>
                        <div class="divider"><span></span></div>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>File</th>
                                    <th>Download</th>
                                    <th>Uploaded by</th>
                                    <th>Uploaded at</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($files as $key=> $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <a href="{{  asset('uploads/'.$item-> name) }}" target="blank" title="Review Files">{{substr($item-> name,11)}}</a>
                                        </td>
                                        <td>
                                            <a title="download" download href="{{  asset('uploads/'.$item-> name) }}"
                                               class="btn-lg btn-link text-primary text-decoration-none"
                                               target="_blank" title="Download File">
                                                <i class="la la-download icon ml-1" style="font-size: 1.5rem"></i>
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\Models\User::find($item -> instructor_id) -> name}}
                                        </td>
                                        <td>{{$item -> created_at -> format('d/m/Y H:i')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->
            </div><!-- end col-lg-5 -->

        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
