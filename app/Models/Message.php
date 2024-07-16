<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['updated_at'];
    public function scopegetCorrespondingUsers($query, $user1id, $user2id)
    {
        $this->where('user_sender_id', $user2id)
            ->where('user_reciver_id', $user1id)
            ->update(['is_read' => 1]);

        $messages =  $query->where(
            function ($query) use ($user1id, $user2id) {
                $query->where('user_sender_id', $user1id)->where('user_reciver_id', $user2id);
            }
        )
            ->orWhere(
                function ($query) use ($user1id, $user2id) {
                    $query->where('user_sender_id', $user2id)->where('user_reciver_id', $user1id);
                }
            )
            ->orderBy('created_at')
            ->get(['id', 'user_sender_id', 'user_reciver_id', 'is_read', 'content', 'created_at']);
        return $messages;
    }

    public function scopeCorrespondingUsers($query)
    {
        $user = auth()->user();

        return $query
            ->select('user_sender_id as user_id')
            ->where('user_reciver_id', $user->id)
            ->distinct()
            ->union(Message::select('user_reciver_id as user_id')
                ->where('user_sender_id', $user->id)
                ->distinct());
    }

    public static function getMainPageData()
    {
        $user = auth()->user();
        $BesicData = self::CorrespondingUsers()->get();
        $data = [];

        foreach ($BesicData as $item) {
            $user1 = $user;
            $user2 = User::find($item->user_id);
            $message = self::where(
                function ($query) use ($user1, $user2) {
                    $query->where('user_sender_id', $user1->id)->where('user_reciver_id', $user2->id);
                }
            )
                ->orWhere(
                    function ($query) use ($user1, $user2) {
                        $query->where('user_sender_id', $user2->id)->where('user_reciver_id', $user1->id);
                    }
                )
                ->latest('created_at')->first();
            $from_me = false;
            if ($message->user_sender_id == $user->id) {
                $from_me = true;
            }
            $data[] = [
                'user_id' => $item->user_id,
                'name' => ucfirst($user2->fname) . ' ' . ucfirst($user2->lname),
                'type' => $user2->user_type,
                'content' => $message->content,
                'is_read' => $message->is_read,
                'from_me' => $from_me,
                'created_at' => $message->created_at
            ];
        }

        return $data;
    }
}
