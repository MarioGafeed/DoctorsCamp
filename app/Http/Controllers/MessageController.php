<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\DataTables\MessagesDataTable;
use App\Http\Requests\MessagesRequest;
use App\Mail\ContactResponseMail;
use App\Models\Message;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    use Authorizable;

    private $viewPath = 'backend.messages';

    public function index(MessagesDataTable $dataTable)
    {
        return $dataTable->render("{$this->viewPath}.index", [
          'title' => trans('main.show-all').' '.trans('main.messages'),
      ]);
    }

    public function create()
    {
        return view("{$this->viewPath}.create", [
          'title' => trans('main.add').' '.trans('main.messages'),
      ]);
    }

    public function store(MessagesRequest $request)
    {
        $requestAll = $request->all();
        $message = Message::create($requestAll);

        session()->flash('success', trans('main.added-message'));

        return redirect()->route('messages.create');
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return view("{$this->viewPath}.show", [
          'title' => trans('main.show').' '.trans('main.message').' : '.$message->name,
          'show' => $message,
      ]);
    }

    public function destroy($id, $redirect = true)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        if ($redirect) {
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('messages.index');
        }
    }

    public function multi_delete(Request $request)
    {
        if (count($request->selected_data)) {
            foreach ($request->selected_data as $id) {
                $this->destroy($id, false);
            }
            session()->flash('success', trans('main.deleted-message'));

            return redirect()->route('messages.index');
        }
    }

    public function response(Message $message, Request $request)
    {
        $request->validate([
      'name'      =>'required|string|max:255',
      'subject'   =>'required',
      'body'      =>'required|string',
      'email'     =>'required|email|max:255',
    ]);
        // $receiverName = $message->name;
        $receiverMail = $request->email;

        Mail::to($receiverMail)->send(new ContactResponseMail($request->name, $request->subject, $request->body));
        session()->flash('success', trans('main.send-message'));

        return redirect()->route('messages.index');
    }
}
