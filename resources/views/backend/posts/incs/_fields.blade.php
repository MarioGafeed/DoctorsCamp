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
    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.category') }} <span class="required"></span> </label>
        <div class="col-md-6">
            <select class="form-control select2" id="category_id" name="category_id">
              <option value="">{{ trans('main.select Category') }}</option>
              @foreach ($cats as $pc)
                   <option value="{{ $pc->id }}" {{ getData($data, 'category_id') == $pc->id ? 'selected' : '' }}>
                     @if(GetLanguage() == 'en')
                       {{ $pc->title_en }}
                     @else
                       {{ $pc->title_ar }}
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



    {{-- Add Post's Taq --}}
    <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.tags') }} <span class="required"></span> </label>
        <div class="col-md-6">
          @if( isset($edit) )
          <input type="text" name="tags" value="{{ $tags }}" class="form-control" placeholder="{{ trans('main.tags') }}" required>
          @else
          <input type="text" name="tags" value="{{ getData($data, 'tags') }}" class="form-control" placeholder="{{ trans('main.tags') }}" required>
          @endif
            @if ($errors->has('tags'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('tags') }}</strong>
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

    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
        <label class="col-md-2 control-label">{{ trans('main.type') }} <span class="required"></span> </label>
        <div class="col-md-10">
            <select class="form-control" id="type" name="type">
                <option></option>
                <option value="article" {{ getData($data, 'type') == 'article' ? ' selected' : '' }}>{{trans('main.article')}}</option>
                <option value="video" {{ getData($data, 'type') == 'video' ? ' selected' : '' }}>{{trans('main.youtubeURL')}}</option>
                <option value="sound" {{ getData($data, 'type') == 'sound' ? ' selected' : '' }}>{{trans('main.soundcloudURL')}}</option>
                <option value="book" {{ getData($data, 'type') == 'book' ? ' selected' : '' }}>{{trans('main.book')}}</option>
            </select>
            @if ($errors->has('type'))
                <span class="help-block">
                    <strong class="help-block">{{ $errors->first('type') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div  class='form-group hidden' id="video">
        <div class="form-group{{ $errors->has('youtubeURL') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">{{ trans('main.youtubeURL') }}  </label>
            <div class="col-md-6">
                <input type="text" name="youtubeURL" value="{{ getData($data, 'youtubeURL') }}" class="form-control" placeholder="{{ trans('main.youtubeURL') }}" >
                @if ($errors->has('youtubeURL'))
                    <span class="help-block">
                        <strong class="help-block">{{ $errors->first('youtubeURL') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div  class='form-group hidden' id="sound">
        <div class="form-group{{ $errors->has('soundcloudURL') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">{{ trans('main.soundcloudURL') }}  </label>
            <div class="col-md-6">
                <input type="text" name="soundcloudURL" value="{{ getData($data, 'soundcloudURL') }}" class="form-control" placeholder="{{ trans('main.soundcloudURL') }}" >
                @if ($errors->has('soundcloudURL'))
                    <span class="help-block">
                        <strong class="help-block">{{ $errors->first('soundcloudURL') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div   class='form-group hidden' id="article" >
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
  </div>

</div>
