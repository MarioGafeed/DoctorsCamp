@extends('backend.theme.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-blue">{{$title}}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('courses.create') }}" data-toggle="tooltip" title="{{trans('main.add')}}  {{trans('main.courses')}}"> <i class="fa fa-plus"></i> </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('courses.edit', [$show->id]) }}" data-toggle="tooltip" title="{{ trans('main.edit') }}  {{ trans('main.job') }}"> <i class="fa fa-edit"></i> </a>
                        <span data-toggle="tooltip" title="{{ trans('main.delete') }}  {{ trans('main.job') }}">
                            <a data-toggle="modal" data-target="#myModal{{ $show->id }}" class="btn btn-circle btn-icon-only btn-default" href=""> <i class="fa fa-trash"></i> </a>
                        </span>
                        <div class="modal fade" id="myModal{{ $show->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">x</button>
                                        <h4 class="modal-title">
                                            {{trans('main.delete')}}
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('main.ask-delete')}} {{ $show->title }} !
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open([ 'method' => 'DELETE', 'route' => ['courses.destroy', $show->id] ]) !!}
                                        {!! Form::submit(trans('main.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">
                                            {{ trans('main.cancel') }}
                                        </a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('courses.index') }}" data-toggle="tooltip" title="{{trans('main.show-all')}}  {{trans('main.courses')}}"> <i class="fa fa-list"></i> </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('main.full-screen')}}" title="{{trans('main.full-screen')}}"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{trans('main.name')}} : </strong>
                            {{ $show->name }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.slug')}} : </strong>
                            {{ $show->slug }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.active')}} : </strong>
                            {{ trans( $show->active) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.category')}} : </strong>
                            {{ $show->category->title_en }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.category')}} : </strong>
                            {{ $show->category->title_ar }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.description')}} : (en)</strong>
                            {{ json_decode($show->desc)->en }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.description')}} : (ar)</strong>
                            {{ json_decode($show->desc)->ar }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.price')}} : </strong>
                            {{ $show->price }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.image')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ $show->getFirstMediaUrl() }}" alt="">
                            <br><hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
