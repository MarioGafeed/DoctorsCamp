@extends('backend.theme.layout.app')

@section('styles')
    @include('backend.comments.incs._styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-blue">{{ $title }}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{route('comments.index')}}" data-toggle="tooltip" title="{{ trans('main.show-all') }}   {{ trans('main.comments') }}"> <i class="fa fa-list"></i> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form method="post" action="{{ route('comments.store') }}" class="form-horizontal" role="form">
                        @csrf
                        @include('backend.comments.incs._fields', [
                            'data' => collect(old()),
                            'action' => 'create'
                        ])
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn green">{{ trans('main.add') }} {{ trans('main.comment') }}</button>
                                    <a href="{{ route('comments.index') }}" class="btn default">{{ trans('main.cancel') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
