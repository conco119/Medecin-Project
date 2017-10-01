@extends('admin.master')

@section('content-admin')
<div class="content-admin detail-patient">
    <div class="panel panel-default">
      @if(session('success'))
        <div class="alert alert-success">
          <p>{{session('success')}}</p>
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach

        </div>
      @endif
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a data-target="#detail" role="tab" data-toggle="tab">Detail</a></li>
                <li><a data-target="#history" role="tab" data-toggle="tab">History</a></li>
            </ul>
            <div class="tab-content">
                <!-- detail patient -->
                <div class="tab-pane active" id="detail">
                    <div class=" image-user col-md-4">
                        <div class="box-body box-profile">
                            <div class="col-md-10">
                                <img class="img-responsive img-circle" src="{{ asset('huonggiang.jpg')}}" alt="User profile picture">
                                <h3 class="profile-username text-center">
                                <i class="fa fa-leaf" aria-hidden="true"></i>
                                {{ $patient->name }}
                                </h3>
                                <a class="btn btn-primary btn-block" href="{{ route('patient.edit', ['id' => $patient->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>{{ trans('message.edit') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="info-user col-md-8">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i>{{ trans('message.phone') }} :</b>
                                <a>{{ $patient->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <b>{{ trans('message.mail') }}:</b>
                                <a>{{ $patient->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-transgender" aria-hidden="true"></i>{{ trans('message.gender') }} :</b>
                                @if ($patient->sex == config('custom.male'))
                                    <a>{{ trans('message.male') }}</a>
                                @else
                                    <a>{{ trans('message.female') }}</a>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-birthday-cake" aria-hidden="true"></i>{{ trans('message.age') }} :</b><a>{{ $patient->age }}</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- end detail patient -->

                <!-- history patient -->
                <div class="tab-pane " id="history">
                  @foreach($patient->histories as $history)
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h2 class="panel-title"><strong>{{ $history->date_examination }}</strong></h2>
                      </div>
                      <div class="panel-body">
                        <div class='row'>
                           <div class="col-md-12">
                             <p>{{ $history->content }}</p>
                           </div>
                        </div>
                        <div class="row editing">
                          <div class="col-md-9">
                            <video controls='controls'>
                              <source src="http://sanchoi.net/{{$history->media->path.  $history->media->name . "." . $history->media->type}}">
                            </video>
                            <br>
                          </div>
                          <div class="col-md-3 ">
                            <br>
                            {{-- <a data-toggle="modal" data-target="#addVideo" data-user-id="{{ $patient->id }}"><i class="fa fa-file-video-o" aria-hidden="true"></i></a> --}}
                            <form action="{{route('media-medical.destroy', ['id' => $history->id])}}" method="post">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button onclick="return alert()" type="submit" class="btn btn-danger" ><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button>
                            </form>
                            <br>
                            <button data-content= "{{ $history->content }}" data-history-id="{{ $history->id }}" data-toggle="modal" data-target="#addVideo" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Chỉnh sửa</button>
                          </div>
                        </div>
                      </div>



                    </div>
                  @endforeach
                </div>
              {{-- edit modal --}}
                <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Chỉnh sửa lịch sử khám</strong></h4>
                            </div>

                            <div class="modal-body ">
                                <form action="" id="modal-form" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="_method" value="PUT">
                                  {{ csrf_field() }}
                                  {{-- video  --}}
                                    <div class="form-group">
                                        <label>Chọn video khác</label>
                                        <div>
                                            <input id="file" type="file" name="video" class="form-control">
                                        </div>
                                    </div>
                                  {{-- content --}}
                                    <div class="form-group">
                                      <label for=""> Nội dung </label>
                                      <textarea id="modal-content" name="content" class="form-control" rows="5" type="text" ></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary"> Lưu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              {{-- edit modal --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
      $(document).ready(function() {
        $("button[data-toggle='modal']").click(function() {
          let history_id = $(this).data('history-id');
          let content = $(this).data('content');
          $('#modal-content').val(content);
        $('#modal-form').attr('action','http://localhost:8000/admin/media-medical/' + history_id);
        })
      })
      function alert() {
        return confirm("Bạn có chắc chắn muốn xóa?");
      }
    </script>
    {{-- {{ Html::script('js/admin/patient.js') }} --}}
@endsection
