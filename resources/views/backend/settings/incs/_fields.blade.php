<div class="form-body">

<!-- first to add Fields -->
<div class="form-body">

    <div class="form-group{{ $errors->has('sitename') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.sitename') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="sitename" value="{{ getData($data, 'sitename') }}" class="form-control" placeholder="{{ trans('main.sitename') }}" required>
            @if ($errors->has('sitename'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('sitename') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannersliderimage') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.bannersliderimage') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'bannersliderimage')))
                        <img src="{{ ShowImage(getData($data, 'bannersliderimage')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="bannersliderimage">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('bannersliderimage'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannersliderimage') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannerslidertxt1') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.bannerslidertxt1') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="bannerslidertxt1" value="{{ getData($data, 'bannerslidertxt1') }}" class="form-control" placeholder="{{ trans('main.bannerslidertxt1') }}" required>
            @if ($errors->has('bannerslidertxt1'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannerslidertxt1') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannersliderspantxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.bannersliderspantxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="bannersliderspantxt" value="{{ getData($data, 'bannersliderspantxt') }}" class="form-control" placeholder="{{ trans('main.bannersliderspantxt') }}" required>
            @if ($errors->has('bannersliderspantxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannersliderspantxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannerslidertxt2') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.bannerslidertxt2') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="bannerslidertxt2" value="{{ getData($data, 'bannerslidertxt2') }}" class="form-control" placeholder="{{ trans('main.bannerslidertxt2') }}" required>
            @if ($errors->has('bannerslidertxt2'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannerslidertxt2') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannersliderptxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.bannersliderptxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="bannersliderptxt" value="{{ getData($data, 'bannersliderptxt') }}" class="form-control" placeholder="{{ trans('main.bannersliderptxt') }}" required>
            @if ($errors->has('bannersliderptxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannersliderptxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('bannertestisliderimage') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.bannertestisliderimage') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'bannertestisliderimage')))
                        <img src="{{ ShowImage(getData($data, 'bannertestisliderimage')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="bannertestisliderimage">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('bannertestisliderimage'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('bannertestisliderimage') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('testcentertxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.testcentertxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="testcentertxt" value="{{ getData($data, 'testcentertxt') }}" class="form-control" placeholder="{{ trans('main.testcentertxt') }}" required>
            @if ($errors->has('testcentertxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('testcentertxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('testptxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.testptxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="testptxt" value="{{ getData($data, 'testptxt') }}" class="form-control" placeholder="{{ trans('main.testptxt') }}" required>
            @if ($errors->has('testptxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('testptxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('testyellowtxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.testyellowtxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="testyellowtxt" value="{{ getData($data, 'testyellowtxt') }}" class="form-control" placeholder="{{ trans('main.testyellowtxt') }}" required>
            @if ($errors->has('testyellowtxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('testyellowtxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('testcentertxt2') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.testcentertxt2') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="testcentertxt2" value="{{ getData($data, 'testcentertxt2') }}" class="form-control" placeholder="{{ trans('main.testcentertxt2') }}" required>
            @if ($errors->has('testcentertxt2'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('testcentertxt2') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('logosliderimg') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.logosliderimg') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'logosliderimg')))
                        <img src="{{ ShowImage(getData($data, 'logosliderimg')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="logosliderimg">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('logosliderimg'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('logosliderimg') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('audioimg') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.audioimg') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'audioimg')))
                        <img src="{{ ShowImage(getData($data, 'audioimg')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="audioimg">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('audioimg'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('audioimg') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('audioh4txt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.audioh4txt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="audioh4txt" value="{{ getData($data, 'audioh4txt') }}" class="form-control" placeholder="{{ trans('main.audioh4txt') }}" required>
            @if ($errors->has('audioh4txt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('audioh4txt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('audioptxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.audioptxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="audioptxt" value="{{ getData($data, 'audioptxt') }}" class="form-control" placeholder="{{ trans('main.audioptxt') }}" required>
            @if ($errors->has('audioptxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('audioptxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('audiosource') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.audiosource') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="audiosource" value="{{ getData($data, 'audiosource') }}" class="form-control" placeholder="{{ trans('main.audiosource') }}" required>
            @if ($errors->has('audiosource'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('audiosource') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('quoteimg') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.quoteimg') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'quoteimg')))
                        <img src="{{ ShowImage(getData($data, 'quoteimg')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="quoteimg">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('quoteimg'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('quoteimg') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('quoteh5txt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.quoteh5txt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="quoteh5txt" value="{{ getData($data, 'quoteh5txt') }}" class="form-control" placeholder="{{ trans('main.quoteh5txt') }}" required>
            @if ($errors->has('quoteh5txt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('quoteh5txt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('quoteh3txt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.quoteh3txt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="quoteh3txt" value="{{ getData($data, 'quoteh3txt') }}" class="form-control" placeholder="{{ trans('main.quoteh3txt') }}" required>
            @if ($errors->has('quoteh3txt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('quoteh3txt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingspantxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.shootingspantxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="shootingspantxt" value="{{ getData($data, 'shootingspantxt') }}" class="form-control" placeholder="{{ trans('main.shootingspantxt') }}" required>
            @if ($errors->has('shootingspantxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingspantxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingh3txt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.shootingh3txt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="shootingh3txt" value="{{ getData($data, 'shootingh3txt') }}" class="form-control" placeholder="{{ trans('main.shootingh3txt') }}" required>
            @if ($errors->has('shootingh3txt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingh3txt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingptxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.shootingptxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="shootingptxt" value="{{ getData($data, 'shootingptxt') }}" class="form-control" placeholder="{{ trans('main.shootingptxt') }}" required>
            @if ($errors->has('shootingptxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingptxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingimg') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.shootingimg') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'shootingimg')))
                        <img src="{{ ShowImage(getData($data, 'shootingimg')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="shootingimg">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('shootingimg'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingimg') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingvideo') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.shootingvideo') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="shootingvideo" value="{{ getData($data, 'shootingvideo') }}" class="form-control" placeholder="{{ trans('main.shootingvideo') }}" required>
            @if ($errors->has('shootingvideo'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingvideo') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('teamspantxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.teamspantxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="teamspantxt" value="{{ getData($data, 'teamspantxt') }}" class="form-control" placeholder="{{ trans('main.teamspantxt') }}" required>
            @if ($errors->has('teamspantxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('teamspantxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1img') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.team1img') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'team1img')))
                        <img src="{{ ShowImage(getData($data, 'team1img')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="team1img">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('team1img'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1img') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2img') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.team2img') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'team2img')))
                        <img src="{{ ShowImage(getData($data, 'team2img')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="team2img">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('team2img'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2img') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3img') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.team3img') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'team3img')))
                        <img src="{{ ShowImage(getData($data, 'team3img')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="team3img">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('team3img'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3img') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4img') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.team4img') }}</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'team4img')))
                        <img src="{{ ShowImage(getData($data, 'team4img')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="team4img">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('team4img'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4img') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team1name') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team1name" value="{{ getData($data, 'team1name') }}" class="form-control" placeholder="{{ trans('main.team1name') }}" required>
            @if ($errors->has('team1name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('shootingptxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.shootingptxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="shootingptxt" value="{{ getData($data, 'shootingptxt') }}" class="form-control" placeholder="{{ trans('main.shootingptxt') }}" required>
            @if ($errors->has('shootingptxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('shootingptxt') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team2name') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team2name" value="{{ getData($data, 'team2name') }}" class="form-control" placeholder="{{ trans('main.team2name') }}" required>
            @if ($errors->has('team2name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team3name') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team3name" value="{{ getData($data, 'team3name') }}" class="form-control" placeholder="{{ trans('main.team3name') }}" required>
            @if ($errors->has('team3name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team4name') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team4name" value="{{ getData($data, 'team4name') }}" class="form-control" placeholder="{{ trans('main.team4name') }}" required>
            @if ($errors->has('team4name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1role') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team1role') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team1role" value="{{ getData($data, 'team1role') }}" class="form-control" placeholder="{{ trans('main.team1role') }}" required>
            @if ($errors->has('team1role'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1role') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2role') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team2role') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team2role" value="{{ getData($data, 'team2role') }}" class="form-control" placeholder="{{ trans('main.team2role') }}" required>
            @if ($errors->has('team2role'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2role') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3role') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team3role') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team3role" value="{{ getData($data, 'team3role') }}" class="form-control" placeholder="{{ trans('main.team3role') }}" required>
            @if ($errors->has('team3role'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3role') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4role') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team4role') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team4role" value="{{ getData($data, 'team4role') }}" class="form-control" placeholder="{{ trans('main.team4role') }}" required>
            @if ($errors->has('team4role'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4role') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1fb') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team1fb') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team1fb" value="{{ getData($data, 'team1fb') }}" class="form-control" placeholder="{{ trans('main.team1fb') }}" required>
            @if ($errors->has('team1fb'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1fb') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2fb') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team2fb') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team2fb" value="{{ getData($data, 'team2fb') }}" class="form-control" placeholder="{{ trans('main.team2fb') }}" required>
            @if ($errors->has('team2fb'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2fb') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3fb') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team3fb') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team3fb" value="{{ getData($data, 'team3fb') }}" class="form-control" placeholder="{{ trans('main.team3fb') }}" required>
            @if ($errors->has('team3fb'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3fb') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4fb') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team4fb') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team4fb" value="{{ getData($data, 'team4fb') }}" class="form-control" placeholder="{{ trans('main.team4fb') }}" required>
            @if ($errors->has('team4fb'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4fb') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1tw') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team1tw') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team1tw" value="{{ getData($data, 'team1tw') }}" class="form-control" placeholder="{{ trans('main.team1tw') }}" required>
            @if ($errors->has('team1tw'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1tw') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2tw') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team2tw') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team2tw" value="{{ getData($data, 'team2tw') }}" class="form-control" placeholder="{{ trans('main.team2tw') }}" required>
            @if ($errors->has('team2tw'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2tw') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3tw') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team3tw') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team3tw" value="{{ getData($data, 'team3tw') }}" class="form-control" placeholder="{{ trans('main.team3tw') }}" required>
            @if ($errors->has('team3tw'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3tw') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4tw') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team4tw') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team4tw" value="{{ getData($data, 'team4tw') }}" class="form-control" placeholder="{{ trans('main.team4tw') }}" required>
            @if ($errors->has('team4tw'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4tw') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team1in') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team1in') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team1in" value="{{ getData($data, 'team1in') }}" class="form-control" placeholder="{{ trans('main.team1in') }}" required>
            @if ($errors->has('team1in'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team1in') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team2in') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team2in') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team2in" value="{{ getData($data, 'team2in') }}" class="form-control" placeholder="{{ trans('main.team2in') }}" required>
            @if ($errors->has('team2in'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team2in') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team3in') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team3in') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team3in" value="{{ getData($data, 'team3in') }}" class="form-control" placeholder="{{ trans('main.team3in') }}" required>
            @if ($errors->has('team3in'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team3in') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('team4in') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.team4in') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="team4in" value="{{ getData($data, 'team4in') }}" class="form-control" placeholder="{{ trans('main.team4in') }}" required>
            @if ($errors->has('team4in'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('team4in') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('footertxt') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.footertxt') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <textarea name="footertxt" rows="4" cols="20" value="{{ getData($data, 'footertxt') }}" class="form-control" placeholder="{{ trans('main.footertxt') }}" required></textarea>
            @if ($errors->has('footertxt'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('footertxt') }}</strong>
                </span>
            @endif
        </div>
    </div>



    <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.facebook') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="facebook" value="{{ getData($data, 'facebook') }}" class="form-control" placeholder="{{ trans('main.facebook') }}" required>
            @if ($errors->has('facebook'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('facebook') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.twitter') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="twitter" value="{{ getData($data, 'twitter') }}" class="form-control" placeholder="{{ trans('main.twitter') }}" required>
            @if ($errors->has('twitter'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('twitter') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.youtube') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="youtube" value="{{ getData($data, 'youtube') }}" class="form-control" placeholder="{{ trans('main.youtube') }}" required>
            @if ($errors->has('youtube'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('youtube') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('insta') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.insta') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="insta" value="{{ getData($data, 'insta') }}" class="form-control" placeholder="{{ trans('main.insta') }}" required>
            @if ($errors->has('insta'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('insta') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
