<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Message;
use App\Notifications\NewMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $receivedmessages = Message::with('fromUser')
                                   ->where('message_to', Auth::id())
                                   ->latest()
                                   ->get();

        return view('home', compact('receivedmessages'));
    }


    public function composemessage()
    {
        $users = User::orderBy('email')
                     ->where('id', '!=', Auth::id())
                     ->where('admin', '!=', 1)
                     ->where('block', '!=', 1)
                     ->get();

        return view('user.new-message', compact('users'));
    }

    public function viewmessage($id, $notificationid = null)
    {
        $viewmessage = Message::with('fromUser')->findOrFail($id);

        if($viewmessage->status == 0){

            $viewmessage->update(['status' => 1]);
        }

        if($notificationid != NULL) {

            $this->readSingleNotification($notificationid);
        }

        return view('user.view-message', compact('viewmessage'));
    }

    public function sentmessage()
    {
        $sentmessages = Message::with('toUser')
                                ->where('user_id', Auth::id())
                                ->latest()
                                ->get();

        return view('user.sent-message', compact('sentmessages'));
    }


    public function messageSend(Request $request)
    {
        $request->validate([
            'message_to'    => 'required',
            'subject'       => 'required|max:255',
            'body'          => 'required',
        ]);

        $message = Message::create([
            'user_id'       => Auth::id(),
            'message_to'    => $request->message_to,
            'subject'       => $request->subject,
            'body'          => $request->body
        ]);

        $user = User::find($request->message_to);

        $user->notify(new NewMessage($message));

        return back();
    }


    public function markAsReadNotification()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back();
    }

    protected function readSingleNotification($notificationid)
    {
        return auth()->user()->unreadNotifications->where('id', $notificationid)->markAsRead();
    }

    public function searchSentMessage()
    {
        $search = request()->input('sentmessage');

        $sentmessages = Message::where('user_id',Auth::id())
                                ->where(function($query) use($search) {
                                    $query->where('subject', 'LIKE', '%'.$search.'%')
                                        ->orWhere('body','LIKE', '%'.$search.'%');
                                })
                                ->get();

        return view('user.sent-message', compact('sentmessages'));
    }

    public function searchReceivedMessage()
    {
        $search = request()->input('receivedmessage');

        $receivedmessages = Message::where(function($query) use($search) {
                                        $query->where('subject', 'LIKE', '%'.$search.'%')
                                            ->orWhere('body','LIKE', '%'.$search.'%');
                                    })
                                    ->where('message_to',Auth::id())
                                    ->get();

        return view('home', compact('receivedmessages'));
    }


}
