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

   {{-- Add Country --}}
   <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
       <label class="col-md-2 control-label">{{ trans('main.country') }} <span class="required"></span> </label>
       <div class="col-md-6">
           <select class="form-control select2" id="country_id" name="country_id">
             <option value="">{{ trans('main.select country') }}</option>
             @foreach ($countries as $country)
                  <option value="{{ $country->id }}" {{ getData($data, 'country_id') == $country->id ? 'selected' : '' }}>
                    {{  $country->name }}
                  </option>
             @endforeach
           </select>
           @if ($errors->has('country_id'))
               <span class="help-block">
                   <strong class="help-block">{{ $errors->first('country_id') }}</strong>
               </span>
           @endif
       </div>
   </div>

   <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
       <label class="col-md-2 control-label">{{ trans('main.city') }} </label>
       <div class="col-md-6">
           <input type="text" name="city" value="{{ getData($data, 'city') }}" class="form-control" placeholder="{{ trans('main.city') }}" >
           @if ($errors->has('city'))
               <span class="help-block">
                   <strong class="help-block">{{ $errors->first('city') }}</strong>
               </span>
           @endif
       </div>
   </div>

   <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
       <label class="col-md-2 control-label">{{ trans('main.location') }}  </label>
       <div class="col-md-6">
           <input type="text" name="location" value="{{ getData($data, 'location') }}" class="form-control" placeholder="{{ trans('main.location') }}" >
           @if ($errors->has('location'))
               <span class="help-block">
                   <strong class="help-block">{{ $errors->first('location') }}</strong>
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

    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.start_date') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" name="start_date" class="form-control" value="{{ getData($data, 'start_date') }}" readonly required>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.end_date') }} <span class="required"></span> </label>
        <div class="col-md-8">
            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                <input type="text" name="end_date" class="form-control" value="{{ getData($data, 'end_date') }}" readonly required>
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
            @if ($errors->has('end_date'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.desc') }} (en)</label>
        <div class="col-md-6">
            <input type="text" name="description_en" value="{{ getData($data, 'description_en') }}" class="form-control" placeholder="{{ trans('main.description') }}" >
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.desc') }}  (ar)</label>
        <div class="col-md-6">
            <input type="text" name="description_ar" value="{{ getData($data, 'description_ar') }}" class="form-control" placeholder="{{ trans('main.description') }}" >
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>  


</div>
