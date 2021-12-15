<div class="form-body">
    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.title') }} (en) </label>
        <div class="col-md-6">
            <input type="text" name="title_en" value="{{ getData($data, 'title_en') }}" class="form-control" placeholder="{{ trans('main.title') }}" >
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.title') }} (ar) </label>
        <div class="col-md-6">
            <input type="text" name="title_ar" value="{{ getData($data, 'title_ar') }}" class="form-control" placeholder="{{ trans('main.title') }}" >
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
       <label class="control-label col-md-2">{{ trans('main.image') }}</label>
       <div class="col-md-10">
           <div class="fileinput fileinput-new" data-provides="fileinput">
               <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                   @if ( isset($edit) )
                       <img src="{{ $edit->getFirstMediaUrl() }}" alt="" />
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

    {{-- Add Post's Category --}}
    <div class="form-group{{ $errors->has('pcat_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.epcategory') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="pcat_id" name="pcat_id">
              <option value="">{{ trans('main.select Category') }}</option>
              @foreach ($pcats as $pc)
                   <option value="{{ $pc->id }}" {{ getData($data, 'pcat_id') == $pc->id ? 'selected' : '' }}>
                     @if(GetLanguage() == 'en')
                       {{ json_decode($pc->title)->en }}
                     @else
                       {{ json_decode($pc->title)->ar }}
                     @endif
                   </option>
              @endforeach
            </select>
            @if ($errors->has('pcat_id'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('pcat_id') }}</strong>
                </span>
            @endif
        </div>
    </div>  



    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.status') }} <span class="required"></span> </label>
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

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.content') }} (en) </label>
        <div class="col-md-10">
            <textarea name="content_en" class="form-control" placeholder="{{ trans('main.content') }}">{{ getData($data, 'content_en') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.content') }}  (ar)</label>
        <div class="col-md-10">
            <textarea name="content_ar" class="form-control" placeholder="{{ trans('main.content') }}">{{ getData($data, 'content_ar') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('content') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.description') }} (en)</label>
        <div class="col-md-6">
            <input type="text" name="desc_en" value="{{ getData($data, 'desc_en') }}" class="form-control" placeholder="{{ trans('main.desc') }}" >
            @if ($errors->has('desc'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('desc') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.description') }}  (ar)</label>
        <div class="col-md-6">
            <input type="text" name="desc_ar" value="{{ getData($data, 'desc_ar') }}" class="form-control" placeholder="{{ trans('main.desc') }}" >
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

</div>
