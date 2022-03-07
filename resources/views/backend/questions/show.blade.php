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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('questions.create') }}" data-toggle="tooltip" title="{{trans('main.add')}}  {{trans('main.questions')}}"> <i class="fa fa-plus"></i> </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('questions.edit', [$show->id]) }}" data-toggle="tooltip" title="{{ trans('main.edit') }}  {{ trans('main.job') }}"> <i class="fa fa-edit"></i> </a>
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
                                        {!! Form::open([ 'method' => 'DELETE', 'route' => ['questions.destroy', $show->id] ]) !!}
                                        {!! Form::submit(trans('main.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">
                                            {{ trans('main.cancel') }}
                                        </a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('questions.index') }}" data-toggle="tooltip" title="{{trans('main.show-all')}}  {{trans('main.questions')}}"> <i class="fa fa-list"></i> </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('main.full-screen')}}" title="{{trans('main.full-screen')}}"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{trans('main.title')}} : </strong>
                            {{ $show->title }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.title')}} : </strong>
                            {{ $show->lesson->title }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.q_order')}} : </strong>
                            {{ trans( $show->q_order) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.op1')}} : </strong>
                            {{ trans( $show->op1) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.op2')}} : </strong>
                            {{ trans( $show->op2) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.op3')}} : </strong>
                            {{ trans( $show->op3) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.op4')}} : </strong>
                            {{ trans( $show->op4) }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.right_ans')}} : </strong>
                            {{ trans( $show->right_ans) }}
                            <br><hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
