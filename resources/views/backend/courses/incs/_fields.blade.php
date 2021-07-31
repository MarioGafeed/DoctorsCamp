<div class="form-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.name') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <input type="text" name="name" value="{{ getData($data, 'name') }}" class="form-control" placeholder="{{ trans('main.name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.slug') }}</label>
        <div class="col-md-6">
            <input type="text" name="slug" value="{{ getData($data, 'slug') }}" class="form-control" placeholder="{{ trans('main.slug') }}" >
            @if ($errors->has('slug'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('slug') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">{{ trans('main.image') }}</label>
        <div class="col-md-10">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                    @if (checkValue(getData($data, 'image')))
                        <img src="{{ ShowImage(getData($data, 'image')) }}" alt="" />
                    @endif
                </div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> {{ trans('main.select_image') }} </span>
                        <span class="fileinput-exists"> {{ trans('main.change') }} </span>
                        <input type="file" name="image">
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ trans('main.remove') }} </a>
                </div>
            </div>
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('image') }}</strong>
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

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">{{ trans('main.price') }} <span class="required"></span> </label>
            <div class="col-md-6">
                <input type="text" name="price" value="{{ getData($data, 'price') }}" class="form-control" placeholder="{{ trans('main.price') }}" >
                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong class="help-block">{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>


</div>
