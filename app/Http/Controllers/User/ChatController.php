<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    use GeneralTrait;

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'user_reciver_id' => 'required|exists:users,id',
        ]);
        $user = auth()->user();
        // if ($user->id == $request->user_reciver_id) {
        //     return $this->returnError('You can\'t send message for your self', 440);
        // }
        $data['user_sender_id'] = $user->id;
        Message::create($data);

        return $this->returnAccept('Sended');
    }

    public function GetAllTheMessagesToUser(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'user_reciver_id' => 'required|exists:users,id',
        ]);
        $chat = Message::getCorrespondingUsers($user->id, $request->user_reciver_id);
        return $this->returnCollection('chat', $chat);
    }

    public function MainPage()
    {
        $data = Message::getMainPageData();
        return $this->returnCollection('main_page', $data);
    }
}
