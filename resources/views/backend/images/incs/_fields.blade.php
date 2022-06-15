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

  {{-- Add image  Category --}}
  <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
      <label class="col-md-2 control-label">{{ trans('main.category') }} <span class="required"></span> </label>
      <div class="col-md-6">
          <select class="form-control select2" id="category_id" name="category_id">
            <option value="">{{ trans('main.select Category') }}</option>
            @foreach ($categories as $category)
                 <option value="{{ $category->id }}" {{ getData($data, 'category_id') == $category->id ? 'selected' : '' }}>
                   @if(GetLanguage() == 'en')
                     {{ $category->title_en }}
                   @else
                     {{ $category->title_ar }}
                   @endif
                 </option>
            @endforeach
          </select>
          @if ($errors->has('category_id'))
              <span class="help-block">
                  <strong class="help-block">{{ $errors->first('category_id') }}</strong>
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

   <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
       <label class="col-md-2 control-label">{{ trans('main.description') }} (en)</label>
       <div class="col-md-6">
           <textarea type="text" name="desc_en" value="{{ getData($data, 'desc_en') }}" class="form-control" placeholder="{{ trans('main.desc') }}" ></textarea>
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
           <textarea type="text" name="desc_ar" value="{{ getData($data, 'desc_ar') }}" class="form-control" placeholder="{{ trans('main.desc') }}" ></textarea>
           @if ($errors->has('desc'))
               <span class="help-block">
                   <strong class="help-block">{{ $errors->first('desc') }}</strong>
               </span>
           @endif
       </div>
   </div>

</div>
