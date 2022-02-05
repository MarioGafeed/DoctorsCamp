<div class="form-body">
    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.comment') }} <span class="required"></span></label>
        <div class="col-md-6">
            <input type="text" name="comment"  value="{{ getData($data, 'comment') }}" class="form-control" placeholder="{{ trans('main.comment') }} "  >
            @if ($errors->has('comment'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('comment') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Add Comment's Post --}}
    <div class="form-group{{ $errors->has('post_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.post') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="post_id" name="post_id">
              <option value="">{{ trans('main.select Post') }}</option>
              @foreach ($posts as $post)
                   <option value="{{ $post->id }}" {{ getData($data, 'post_id') == $post->id ? 'selected' : '' }}>
                     @if(GetLanguage() == 'en')
                       {{ $post->title_en }}
                     @else
                       {{ $post->title_ar }}
                     @endif
                   </option>
              @endforeach
            </select>
            @if ($errors->has('post_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('post_id') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
