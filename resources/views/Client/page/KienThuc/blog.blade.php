@extends('Client.share.master')
@section('noi_dung')
    <div class="heading-banner-area overlay-bg" style="background: rgba(0, 0, 0, 0) url('https://media.istockphoto.com/id/1220573371/photo/minimal-work-space-creative-flat-lay-photo-of-workspace-desk-top-view-office-desk-with-laptop.jpg?s=612x612&w=0&k=20&c=xmrSzPD4LCRhPD4L5TlttC88sSYe9Pc3J2ZnxCMzzyQ=') no-repeat scroll 0 0; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-banner" >
                        <div class="heading-banner-title">
                            <h2>Blog Về Kiến Thức</h2>
                        </div>
                        <div class="breadcumbs pb-15">
                            @foreach (Breadcrumbs::generate() as $breadcrumb)
                                @if (!is_null($breadcrumb->url) && !$loop->last)
                                    <li class="home"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                                @else
                                    <li class="active">{!! $breadcrumb->title !!}</li>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BLGO-AREA START -->
    <div class="blog-area blog-2  pt-80 pb-80">
        <div class="container">
            <div class="blog">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-option mb-30 clearfix">
                            <!-- Size end -->
                            <div class="showing text-end d-none d-md-block">
                                <p class="mb-0">Showing 01-{{count($data)}} of {{count($data)}} Results</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($data as $value)
                    <!-- Single-blog start -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog mb-30">
                            <div class="blog-photo">
                                <a href="/blog-kien-thuc/view/{{ $value->slug }}"><img style="height: 280px;" src="{{$value->hinh_anh}}" alt=""/></a>
                                <div class="like-share text-center fix">
                                    <a href="/blog-kien-thuc/view/{{ $value->slug }}"><i class="zmdi zmdi-favorite"></i><span>89 Like</span></a>
                                    <a href="/blog-kien-thuc/view/{{ $value->slug }}"><i class="zmdi zmdi-comments"></i><span>59 Comments</span></a>
                                    <a href="/blog-kien-thuc/view/{{ $value->slug }}"><i class="zmdi zmdi-share"></i><span>29 Share</span></a>
                                </div>
                            </div>
                            <div class="blog-info">
                                <div class="post-meta fix">
                                    <div class="post-date floatleft"><span class="text-dark-red">{{$value->ngay}}</span></div>
                                    <div class="post-year floatleft">
                                        <p class="text-uppercase text-dark-red mb-0">{{$value->thang}} , {{$value->nam}}</p>
                                        <h4 class="post-title"><a href="/blog-kien-thuc/view/{{ $value->slug }}" tabindex="0">{{$value->title}}</a></h4>
                                    </div>
                                </div>
                                <p>{{ Illuminate\Support\Str::limit($value->mo_ta, 300) }}</p>
                                <a href="/blog-kien-thuc/view/{{ $value->slug }}" class="button-2 text-dark-red">Xem Thêm...</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single-blog end -->
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- BLGO-AREA END -->
@endsection
@section('js')
@endsection
