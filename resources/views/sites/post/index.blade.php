@extends('sites.master')
@section('content')
@include('sites._include.navbar')
<div class="banner">
   <div class="breadcrumb">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h4 class='title'><strong> <a href="{{ url('/gioithieu') }}">Giới thiệu</a></strong></h4>
               <ul>
                  <li><i class="fa fa-long-arrow-right"></i>Phòng khám</li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="page-content">
   <div class="container main">
      <div class="container">
         <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
               <!-- Title -->
               <h3 class="mt-4">{{ $post->title }}</h3>
               <hr>
               <!-- Date/Time -->
               <p class='day-posted'>
                  <small><i class='fa fa-calendar'>&nbsp;</i>Posted on {{ $post->created_at->format('d/m/Y') }}</small>
               </p>
               <hr>
               <!-- Preview Image -->
               <img class="img-fluid rounded" src="{{ $post->image }}" alt="">
               <hr>
               <!-- Post Content -->
               <p class="lead">{!! $post->content !!}</p>
               <hr>
            </div>
            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
               <!-- Side Widget -->
               <div class="card my-4">
                  <h6 class="card-header related-post">Các bài viết mới</h6>
                  <div class="card-body">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           @foreach ($newestPost as $item)
                           <!-- item -->
                           <div class="row" style="margin-top: 10px;">
                              <div class="col-md-5">
                                 <a href="{{ route('page.post.show', ['category' => str_replace(' ', '-', $item->categories->name), 'post_name' => str_replace(' ', '-', str_replace('/', '_', $post->title))] ) }}">
                                 <img class="img-responsive" width="100%" height='100%' src="{{ $item->image }}" alt="">
                                 </a>
                              </div>
                              <div class="col-md-7 ">
                                 <a class='title-related-post' href="{{ route('page.post.show', ['category' => str_replace(' ', '-', $item->categories->name), 'post_name' => str_replace(' ', '-', str_replace('/', '_', $post->title))] ) }}">{{ substr($item->title, 0, 20) }}...</a>
                              </div>
                              <div class="break"></div>
                           </div>
                           <!-- end item -->
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Categories Widget -->
               @include('sites._include.mucluc')
            </div>
         </div>
         <!-- /.row -->
      </div>
   </div>
</div>
@include('sites._include.footer')
@endsection
@section('style')
{{-- {{ Html::style('css/sites/gioithieu.css') }} --}}
{{ Html::style('css/sites/_include/navbar.css') }}
{{ Html::style('css/sites/_include/footer.css') }}
{{ Html::style('css/sites/_include/banner.css') }}
{{ Html::style('css/sites/_include/post.css') }}
@endsection