<div class="form-body">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-3 control-label">{{ trans('main.question') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <input type="text" name="title" value="{{ getData($data, 'title') }}" class="form-control" placeholder="{{ trans('main.title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add question's lesson --}}
    <div class="form-group{{ $errors->has('lesson_id') ? ' has-error' : '' }}">
        <label class="col-md-3 control-label">{{ trans('main.lesson') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <select class="form-control select2" id="lesson_id" name="lesson_id">
              <option value="">{{ trans('main.select lesson') }}</option>
              @foreach ($les as $l)
                  <option value="{{ $l->id }}" {{ getData($data, 'lesson_id') == $l->id ? 'selected' : '' }}>{{ $l->title }}</option>
              @endforeach
            </select>
            @if ($errors->has('lesson_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('lesson_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('q_order') ? ' has-error' : '' }}">
        <label class="col-md-3 control-label">{{ trans('main.q_order') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <input type="number" name="q_order"  value="{{ getData($data, 'q_order') }}" class="form-control" placeholder="{{ trans('main.q_order') }}" required>
            @if ($errors->has('q_order'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('q_order') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.description') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <textarea name="desc" class="form-control" placeholder="{{ trans('main.description') }}">{{ getData($data, 'desc') }}</textarea>
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
