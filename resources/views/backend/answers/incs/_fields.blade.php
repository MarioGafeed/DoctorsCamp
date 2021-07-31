<div class="form-body">

    {{-- Add Question's Answer --}}
    <div class="form-group{{ $errors->has('question_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.question') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="question_id" name="question_id">
              <option value="">{{ trans('main.select question') }}</option>
              @foreach ($quest as $q)
                  <option value="{{ $q->id }}" {{ getData($data, 'question_id') || request()->get('q_id') == $q->id ? 'selected' : '' }}>{{ $q->title }}</option>
              @endforeach
            </select>
            @if ($errors->has('question_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('question_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.answer') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="answer" value="{{ getData($data, 'answer') }}" class="form-control" placeholder="{{ trans('main.answer') }}" required>
            @if ($errors->has('answer'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('answer') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.status') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="status" name="status">
                <option value="">{{ trans('main.status') }}</option>
                <option value="true" {{ getData($data, 'status') == 'true' ? ' selected' : '' }}>{{trans('main.true')}}</option>
                <option value="false" {{ getData($data, 'status') == 'false' ? ' selected' : '' }}>{{trans('main.false')}}</option>
            </select>
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
