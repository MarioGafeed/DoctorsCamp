<div class="form-body">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.title') }}  (en)<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="title_en" value="{{ getData($data, 'title_en') }}" class="form-control" placeholder="{{ trans('main.title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.title') }} (ar) <span class="required"></span></label>
        <div class="col-md-6">
            <input type="text" name="title_ar" value="{{ getData($data, 'title_ar') }}" class="form-control" placeholder="{{ trans('main.title') }}" required >
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    


    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.description') }} (en)<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="desc_en" value="{{ getData($data, 'desc_en') }}" class="form-control" placeholder="{{ trans('main.desc') }}" required>
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.description') }} (ar)<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="desc_ar" value="{{ getData($data, 'desc_ar') }}" class="form-control" placeholder="{{ trans('main.desc') }}" required>
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.keyword') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="keyword"  value="{{ getData($data, 'keyword') }}" class="form-control" placeholder="{{ trans('main.keyword') }}" required>
            @if ($errors->has('keyword'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('keyword') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.summary') }} (en)<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="summary_en"  value="{{ getData($data, 'summary_en') }}" class="form-control" placeholder="{{ trans('main.summary') }}" required>
            @if ($errors->has('summary'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('summary') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.summary') }} (ar)<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="summary_ar"  value="{{ getData($data, 'summary_ar') }}" class="form-control" placeholder="{{ trans('main.summary') }}" required>
            @if ($errors->has('summary'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('summary') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
