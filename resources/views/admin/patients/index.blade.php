@extends('admin.master')

@section('content-admin')
<div class="content-admin" id="index-patients">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('message.patients') }}</h2>
          @if(session('message'))
            <div class="alert alert-success">
              <p>{{session('message')}}</p>
            </div>
          @endif
          @if(session('danger'))
            <div class="alert alert-danger">
              <p>{{session('danger')}}</p>
            </div>
          @endif
        </div>
        <div class="panel-body">
            <div class="col-md-12 admin-actions">
                <a href="{{ route('patient.create') }}" class="btn btn-success col-md-2">{{ trans('message.new_patient') }}</a>
                <form role="form" class="col-md-5">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter user">
                    </div>
                </form>
            </div>
            <table class="table table-hover table-bordered">
                <thead >
                    <tr>
                        <th class="text-center">{{ trans('message.id') }}</th>
                        <th class="text-center">{{ trans('message.name') }}</th>
                        <th class="text-center">{{ trans('message.phone') }}</th>
                        <th class="text-center">{{ trans('message.email') }}</th>
                        <th class="text-center">{{ trans('message.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ( $patients as $patient)
                    <tr id="patient-{{ $patient->id }}">
                        <th class="col-md-1">{{ $patient->id }}</th>
                        <th class="col-md-3">{{ $patient->name }}</th>
                        <th class="col-md-3">{{ $patient->phone }}</th>
                        <th class="col-md-3">{{ $patient->email }}</th>
                        <th class="col-md-2">
                            <a data-toggle="modal" data-target="#addVideo" data-user-id="{{ $patient->id }}"><i class="fa fa-file-video-o" aria-hidden="true"></i></a>
                            <a href="{{ route('patient.show', ['id' => $patient->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('patient.edit', ['id' => $patient->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a v-on:click="deletePatient('{{ $patient->id }}')"><i class="fa fa-fw  fa-close get-color-icon-delete" ></i></a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if (isset($users))
                {{ $users->links() }}
            @endif
        </div>
    </div>
    <!-- Add Video modal -->
    <div class="modal fade" id="addVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('message.close') }}</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('message.add_video') }}</h4>
                </div>

                <div class="modal-body ">
                    <form action="{{route('media-medical.store')}}" id="modal-form" method = "post" enctype="multipart/form-data">
                      <input name='userId' type="hidden" id="usr-id">
                      {{ csrf_field() }}
                      {{-- video  --}}
                        <div class="form-group">
                            <label>{{ trans('message.video') }}</label>
                            <div>
                                <input id="file" type="file" name="video" class="form-control">
                            </div>
                        </div>
                      {{-- content --}}
                        <div class="form-group">
                          <label for=""> {{__('message.content')}} </label>
                          <textarea name="content" class="form-control" rows="5" type="text" ></textarea>
                        </div>
                      {{-- date --}}
                        <div class="form-group">
                          <label for=""> {{__('message.date')}} </label>
                          <input name="date_examination" class="form-control" rows="5" type="date">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('message.add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Add Video modal --}}
</div>
@endsection

@section('script')
    <script>
      $(document).ready(function() {
        $("a[data-toggle='modal']").click(function() {
          let userId = $(this).data('user-id');
          $('#usr-id').val(userId);
        })
      })
    </script>
    {{ Html::script('js/admin/patient.js') }}
@endsection
