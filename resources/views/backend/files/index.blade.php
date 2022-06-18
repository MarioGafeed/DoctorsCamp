@extends('backend.theme.layout.app')


@section('content')
<div class="bg-light p-5 rounded">    
      <a href="{{ route('files.create') }}" class="btn btn-primary float-right mb-3">{{trans('main.addfile')}}</a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{trans('main.name')}}</th>
            <th scope="col">{{trans('main.size')}}</th>
            <th scope="col">{{trans('main.type')}}</th>
            <th scope="col">{{trans('main.action')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($files as $file)
            <tr>
              <td width="3%">{{ $file->id }}</td>
              <td>{{ $file->name }}</td>
              <td width="10%">{{ $file->size }}</td>
              <td width="10%">{{ $file->type }}</td>
              <div class="modal fade" id="myModal{{ $file->id }}">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button class="close" data-dismiss="modal">x</button>
                              <h4 class="modal-title">
                                  {{trans('main.delete')}}
                              </h4>
                          </div>
                          <div class="modal-body">
                              {{trans('main.ask-delete')}} {{ $file->name }} !
                          </div>
                          <div class="modal-footer">
                              {!! Form::open([ 'method' => 'DELETE', 'route' => ['users.destroy', $file->id] ]) !!}
                              {!! Form::submit(trans('main.approval'), ['class' => 'btn btn-danger']) !!}
                              <a class="btn btn-default" data-dismiss="modal">
                                  {{ trans('main.cancel') }}
                              </a>
                              {!! Form::close() !!}
                          </div>
                      </div>
                  </div>
              </div>
              <td width="5%"><a href="{{ route('files.destroy', $file->id ) }}" class="btn btn-danger btn-sm">{{trans('main.delete')}}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@endsection
