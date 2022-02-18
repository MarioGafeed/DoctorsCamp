<div class="form-body">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.title') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="title" value="{{ getData($data, 'title') }}" class="form-control" placeholder="{{ trans('main.title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add lesson's Course --}}
    <div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.course') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="course_id" name="course_id">
              <option value="">{{ trans('main.select course') }}</option>
              @foreach ($cor as $c)
                  <option value="{{ $c->id }}" {{ getData($data, 'course_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('course_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('course_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
  

    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.status') }} </span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="active" name="active">
                <option value="">{{ trans('main.status_choose') }}</option>
                <option value="1" {{ getData($data, 'active') == '1' ? ' selected' : '' }}>{{trans('main.active')}}</option>
                <option value="0" {{ getData($data, 'active') == '0' ? ' selected' : '' }}>{{trans('main.inactive')}}</option>
            </select>
            @if ($errors->has('active'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('active') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('vcontent') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.vcontent') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="vcontent" value="{{ getData($data, 'vcontent') }}" class="form-control" placeholder="{{ trans('main.vcontent') }}" required>
            @if ($errors->has('vcontent'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('vcontent') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.content') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <textarea name="content" class="form-control" placeholder="{{ trans('main.content') }}">{{ getData($data, 'content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('myorder') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.myorder') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="number" name="myorder" min="1" value="{{ getData($data, 'myorder') }}" class="form-control" placeholder="{{ trans('main.myorder') }}" required>
            @if ($errors->has('myorder'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('myorder') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
