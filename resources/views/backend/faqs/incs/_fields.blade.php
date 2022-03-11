<div class="form-answer">
    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.question') }}<span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="question" value="{{ getData($data, 'question') }}" class="form-control" placeholder="{{ trans('main.question') }}" required>
            @if ($errors->has('question'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('question') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.answer') }}</label>
        <div class="col-md-10">
            <textarea name="answer" class="form-control" placeholder="{{ trans('main.answer') }}">{{ getData($data, 'answer') }}</textarea>
            @if ($errors->has('answer'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('answer') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
