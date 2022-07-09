<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Resources\PdfResource;

class FileUploadController extends Controller
{
  public function index(Request $request)
  {
       $pdfFiles = File::when($request->keyword, function ($query) use ($request){
             $query->orWhere('name', 'LIKE', "%$request->keyword%")
             ->get();
       })->paginate(10);

      return PdfResource::collection($pdfFiles);
  }

  public function show(File $file, Request $request)
  {
    $path = public_path('uploads'.'/'.'files' . '/' . $file->name);
    $header = [
       'Content-Type' => 'application/pdf',
       'Content-Disposition' => $file->name
     ];
    return response()->file($path, $header);
  }
}
