
@php
    $blog = App\Models\BlogPost::latest()->limit(3)->get();
@endphp

<section class="blog-area section--padding bg-gray overflow-hidden">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Tin tức</h5>
            <h2 class="section__title">Bài viết mới</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
           @foreach ($blog as $item)
            <div class="card card-item">
                <div class="card-image">
                    <a href="blog-single.html" class="d-block">
                        <img class="card-img-top" src="{{ asset($item->post_image) }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">
                           Đăng ngày: {{ $item->created_at->format('d/m/y') }}</div>
                    </div>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ url('blog/details/'.$item->post_slug) }}">{{ $item->post_title }}</a></h5>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ url('blog/details/'.$item->post_slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white">Đọc thêm <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li class="mr-0"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li class="mr-0"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li class="mr-0"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons"><i class="la la-share-alt"></i></div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
            @endforeach
        </div><!-- end blog-post-carousel -->
    </div><!-- end container -->
</section><!-- end blog-area -->
