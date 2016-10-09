<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageWasCreated;

class ChatController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->get('message');
        event(new MessageWasCreated($message));
    }
}
