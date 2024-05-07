<?php

use App\Models\Blog;
use App\Models\ChuyenMuc;
use App\Models\SanPham;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Request;


// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Trang Chủ', route('trang_chu'));
});
// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push("Blog", route('blog'));
});
// Home > Blog
Breadcrumbs::for('signal-blog', function ($trail,$slug) {
    $trail->parent('blog');
    $trail->push("Bài Viết", route('signal-blog',compact('slug')));
});
// Home > Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push("Cart", route('cart'));
});
