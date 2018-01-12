@extends('sites.master')

@section('content')
  @include('sites._include.navbar')
  <div class="banner">
   <div class="breadcrumb">
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h4 class='title'><strong> <a href="{{ url('/gioithieu') }}"> Chuyên Khoa</a></strong></h4>
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
       <div class="row">
          <div class="col-md-9">
            <section class="news">
              <div class="container">
                <div class="row">
                <br>
                  <div class="col-sm-12">
                      <h2 class='topic-name'>Tin tức mới nhất</h2>
                      <div class="line"></div>
                   </div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                      @if (isset($posts))
                        @foreach ($posts as $post)
                            <div class="row-item row">
                                <div class="col-md-4 col-lg-3">
                                    <a href="{{ route('page.post.show', ['category' => $post->categories->link, 'post_name' => str_replace(' ', '-', str_replace('/', '_', $post->title))] ) }}">
                                        <img  class="img-responsive img-post img-thumbnail" src="{{ $post->image }}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-8 col-lg-9">
                                    <h5>{{ $post->title }}</h5>
                                    <small><i class='fa fa-calendar-o'></i> <i>{{ $post->created_at->format('d/m/Y') }}</i></small>
                                    <p>{!! substr($post->content, 0, 400) !!}...</p>
                                    <a class="btn btn-outline-success btn-sm" href="{{ route('page.post.show', ['category' => $post->categories->link, 'post_name' => str_replace(' ', '-', str_replace('/', '_', $post->title))] ) }}">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                                <div class="break"></div>

                            </div>
                            <hr>
                        @endforeach
                      @endif
                        <!-- /.row -->
                    </div>
                </div>

              </div>
            </section>
            <nav aria-label="Page navigation">
                @if (isset($posts))
                    {{ $posts->links() }}
                @endif
            </nav>
          </div>
          <div class="col-md-3">
            @include('sites._include.mucluc')
          </div>
       </div>
    </div>
  </div>

@include('sites._include.footer')
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      //fix 25% col-md-3 ??? what the fk
      $(".col-md-3").css({"max-width":"100%"})
      console.log("ok");
    })
  </script>
@endsection
@section('style')
  {{ Html::style('css/sites/gioithieu/gioithieu.css') }}
  {{ Html::style('css/sites/_include/navbar.css') }}
  {{ Html::style('css/sites/_include/footer.css') }}
  {{ Html::style('css/sites/_include/banner.css') }}
  {{ Html::style('css/sites/_include/news.css') }}
@endsection
