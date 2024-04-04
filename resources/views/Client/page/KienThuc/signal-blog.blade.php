@extends('Client.share.master')
@section('noi_dung')
    <!-- BLGO-AREA START -->
    <div class="blog-area blog-2 blog-details-area  pt-80 pb-80">
        <div class="container">
            <div class="blog">
                <div class="row">
                    <!-- Single-blog start -->
                    <div class="col-lg-9">
                        <div class="single-blog mb-30">
                            <div class="blog-photo">
                                <a href="#"><img src="{{ $data->hinh_anh }}" alt="" /></a>
                                <div class="like-share fix">
                                    <a href="#"><i class="zmdi zmdi-account"></i><span>Admin</span></a>
                                    <a href="#"><i class="zmdi zmdi-favorite"></i><span>{{ rand(25, 98) }}
                                            Like</span></a>
                                    <a href="#"><i class="zmdi zmdi-comments"></i><span>{{ rand(25, 98) }}
                                            Comments</span></a>
                                    <a href="#"><i class="zmdi zmdi-share"></i><span>{{ rand(25, 98) }}
                                            Share</span></a>
                                </div>
                                <div class="post-date post-date-2">
                                    <span class="text-dark-red">{{ $data->ngay }}</span>
                                    <span class="text-dark-red text-uppercase">{{$data->thang}}</span>
                                </div>
                            </div>
                            <div class="blog-info blog-details-info">
                                <h4 class="post-title post-title-2"><a href="#">{{$data->title}}</a></h4>
                                <p>{!!$data->noi_dung!!}</p>
                                <div class="post-share-tag clearfix mt-40">
                                    <div class="post-share floatleft">
                                        <span class="text-uppercase"><strong>Share</strong></span>
                                        <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                                        <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                                        <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                                        <a href="#"><i class="zmdi zmdi-vimeo"></i></a>
                                        <a href="#"><i class="zmdi zmdi-dribbble"></i></a>
                                        <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Single-blog end -->
                    <div class="col-lg-3">
                        <!-- Widget-Search start -->
                        <aside class="widget widget-search mb-30">
                            <form action="#">
                                <input type="text" placeholder="Search here..." />
                                <button type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </aside>
                        <!-- Widget-search end -->
                        <!-- Widget-Size start -->
                        <aside class="widget widget-comments mb-30">
                            <div class="widget-title">
                                <h4>Bài Viết Liên Quan</h4>
                            </div>
                            <div class="widget-info comments-filter clearfix">
                                @foreach ($kienThucLienQuan as $value)
                                <div class="single-recent-comments">
                                    <h5><a href="/blog-kien-thuc/view/{{$value->slug}}">{{$value->title}}</a></h5>
                                    <p>{{ Illuminate\Support\Str::limit($value->mo_ta, 300) }}</p>
                                </div>
                                @endforeach
                            </div>
                        </aside>
                        <!-- Widget-Size end -->

                    <aside class="widget widget-product mb-30">
                        <div class="widget-title">
                            <h4>Sản Phẩm Liên Quan</h4>
                        </div>
                        <div class="widget-info sidebar-product clearfix">
                            @if (count($spLienQuan) > 0)
                                @foreach ($spLienQuan as $value)
                                    <!-- Single-product start -->
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="/product/view/{{ $value->slug_san_pham }}"><img
                                                    src="{{ $value->hinh_anh[0] }}" alt="" /></a>
                                        </div>
                                        <div class="product-info">
                                            <h4 class="post-title"><a href="#">{{ $value->ten_san_pham }}</a></h4>
                                            <span class="pro-price">
                                                @if ($value->size_active)
                                                    {{ \App\Helpers\Helper::formatVnd($value->min_gia_ban, 0, ',', '.') . ' - ' . \App\Helpers\Helper::formatVnd($value->max_gia_ban, 0, ',', '.') }}
                                                @else
                                                    {{ \App\Helpers\Helper::formatVnd($value->gia_ban, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single-product end -->
                                @endforeach
                            @endif
                        </div>
                    </aside>
                    <!-- Widget-product end -->

                        <!-- Widget-banner start -->
                        <aside class="widget widget-banner">
                            <div class="widget-info widget-banner-img">
                                <a href="#"><img src="img/banner/5.jpg" alt="" /></a>
                            </div>
                        </aside>
                        <!-- Widget-banner end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BLGO-AREA END -->
@endsection

@section('js')
@endsection
