<?php

namespace App\Http\Controllers;
use App\Authorizable;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreFileRequest;

class FileUploadController extends Controller
{
  // use Authorizable;

    public function index()
    {
        $files = File::all();

        return view('backend.files.index', [
            'files' => $files,
            'title' => trans('main.show-all').' '.trans('main.files'),
        ]);
    }

    public function create()
    {
        return view('backend.files.create', [
          'title' => trans('main.add').' '.trans('main.files'),
      ]);
    }

    public function store(StoreFileRequest $request)
    {
        $fileName = auth()->id() . '_' . time() . '.'. $request->file->getClientOriginalName() ;

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('uploads'.'/'.'files'), $fileName, 0775, true);

        File::create([
            'user_id' => auth()->id(),
            'name' => $fileName,
            'type' => $type,
            'size' => $size
        ]);

        return redirect()->route('files.index')->withSuccess(__('File added successfully.'));
    }

    public function destroy(File $file)
    {
      if(file_exists(public_path('uploads'.'/'.'files/'.$file->name))){
        @unlink(public_path('uploads'.'/'.'files/'.$file->name));
          $file->delete();
          session()->flash('success', trans('main.deleted-message'));
          return redirect()->route('files.index');
      }else{
          dd('File does not exists.');
      }
    }
}
