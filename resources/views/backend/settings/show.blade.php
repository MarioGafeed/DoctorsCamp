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
                        <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('settings.edit', [$show->id]) }}" data-toggle="tooltip" title="{{ trans('main.edit') }}  {{ trans('main.job') }}"> <i class="fa fa-edit"></i> </a>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#" data-original-title="{{trans('main.full-screen')}}" title="{{trans('main.full-screen')}}"> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>{{trans('main.sitename')}} : </strong>
                            {{ $show->sitename }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannersliderimage')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->bannersliderimage) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannerslidertxt1')}} : </strong>
                            {{ $show->bannerslidertxt1 }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannersliderspantxt')}} : </strong>
                            {{ $show->bannersliderspantxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannerslidertxt2')}} : </strong>
                            {{ $show->bannerslidertxt2 }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannersliderptxt')}} : </strong>
                            {{ $show->bannersliderptxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.bannertestisliderimage')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->bannertestisliderimage) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.testcentertxt')}} : </strong>
                            {{ $show->testcentertxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.testptxt')}} : </strong>
                            {{ $show->testptxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.testyellowtxt')}} : </strong>
                            {{ $show->testyellowtxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.testcentertxt2')}} : </strong>
                            {{ $show->testcentertxt2 }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.logosliderimg')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->logosliderimg) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.audioimg')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->audioimg) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.audioh4txt')}} : </strong>
                            {{ $show->audioh4txt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.audioptxt')}} : </strong>
                            {{ $show->audioptxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-12">
                            <strong>{{trans('main.audiosource')}} : </strong>
                            <!-- <iframe width="560" height="315" src="{{ $show->content }}" frameborder="0" allowfullscreen> -->
                            {<iframe width="450" height="360" src="{{ $show->audiosource  }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>}
                              <!-- <video  src="{{ $show->content }}" controls> </video> -->
                            <!-- {!! $show->content !!} -->
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.quoteimg')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->quoteimg) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.quoteh5txt')}} : </strong>
                            {{ $show->quoteh5txt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.quoteh3txt')}} : </strong>
                            {{ $show->quoteh3txt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.shootingspantxt')}} : </strong>
                            {{ $show->shootingspantxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.shootingh3txt')}} : </strong>
                            {{ $show->shootingh3txt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.shootingptxt')}} : </strong>
                            {{ $show->shootingptxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.shootingimg')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->shootingimg) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-12">
                            <strong>{{trans('main.shootingvideo')}} : </strong>
                            <!-- <iframe width="560" height="315" src="{{ $show->content }}" frameborder="0" allowfullscreen> -->
                            {<iframe width="450" height="360" src="{{ $show->shootingvideo  }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>}
                              <!-- <video  src="{{ $show->content }}" controls> </video> -->
                            <!-- {!! $show->content !!} -->
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.teamspantxt')}} : </strong>
                            {{ $show->teamspantxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1img')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->team1img) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2img')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->team2img) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3img')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->team3img) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4img')}} : </strong>
                            <img style="width: 200px; height: 150px;" src="{{ ShowImage($show->team4img) }}" alt="">
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1name')}} : </strong>
                            {{ $show->team1name }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2name')}} : </strong>
                            {{ $show->team2name }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3name')}} : </strong>
                            {{ $show->team3name }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4name')}} : </strong>
                            {{ $show->team4name }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1role')}} : </strong>
                            {{ $show->team1role }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2role')}} : </strong>
                            {{ $show->team2role }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3role')}} : </strong>
                            {{ $show->team3role }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4role')}} : </strong>
                            {{ $show->team4role }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1fb')}} : </strong>
                            {{ $show->team1fb }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2fb')}} : </strong>
                            {{ $show->team2fb }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3fb')}} : </strong>
                            {{ $show->team3fb }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4fb')}} : </strong>
                            {{ $show->team4fb }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1tw')}} : </strong>
                            {{ $show->team1tw }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2tw')}} : </strong>
                            {{ $show->team2tw }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3tw')}} : </strong>
                            {{ $show->team3tw }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4tw')}} : </strong>
                            {{ $show->team4tw }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team1in')}} : </strong>
                            {{ $show->team1in }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team2in')}} : </strong>
                            {{ $show->team2in }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team3in')}} : </strong>
                            {{ $show->team3in }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.team4in')}} : </strong>
                            {{ $show->team4in }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.footertxt')}} : </strong>
                            {{ $show->footertxt }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.facebook')}} : </strong>
                            {{ $show->facebook }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.twitter')}} : </strong>
                            {{ $show->twitter }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.youtube')}} : </strong>
                            {{ $show->youtube }}
                            <br><hr>
                        </div>
                        <div class="col-md-6">
                            <strong>{{trans('main.insta')}} : </strong>
                            {{ $show->insta }}
                            <br><hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
