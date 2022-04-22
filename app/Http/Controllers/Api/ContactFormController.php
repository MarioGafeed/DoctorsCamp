<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class ContactFormController extends Controller
{
  public function contact(Request $request) {

      // Form validation
       $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'phone' => 'nullable',
          'subject'=>'nullable',
          'body' => 'required'
       ]);
       if ($validator->fails()) {
      return response()->json(['error'=>$validator->errors()], 401);
  }
      //  Store data in database
      Message::create($request->all());

      //  Send mail to Application Admin
      // \Mail::send('emails.contactemail', array(
      //     'name' => $request->get('name'),
      //     'email' => $request->get('email'),
      //     'subject' => $request->get('subject'),
      //     'bodyMessage' => $request->get('message'),
      // ), function($message) use ($request){
      //     $message->from($request->email);
      //     $message->to('troposal.com@gmail.com', 'Admin')->subject($request->get('subject'));
      // });
      return response()->json([
        'message' => trans('main.contactsubmit')
      ]);
  }
}
