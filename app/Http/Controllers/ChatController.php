<?php

namespace App\Http\Controllers;

use App\Events\HideEvent;
use App\Events\ChatEvent;
use App\Events\LikeEvent;
use App\Models\Message;
use App\Models\Messageslike;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function chat(Request $request) {
        $messages = Message::with(['user', 'reactions', 'reply', 'reply.user'])->where('status_id', 1)->orderBy('created_at', 'desc')->paginate(25);

        return response()->json(['messages' => $messages], 200);
    }

    public function storeChat(Request $request) {
        $chat_message = new Message;
        $chat_message->user_id = $request->user()->id;
        $chat_message->type_id = 'text';
        $chat_message->message_id = $request->reply_id != -1 ? $request->reply_id : NULL;
        $chat_message->body = $request->body;
        $chat_message->save();

        $chat_message->load(['user', 'reactions', 'reply', 'reply.user']);

        try {
            event(new ChatEvent($request->user(), $chat_message));
        } catch(BroadcastException $e) {

        }

        return response()->json(['message' => $chat_message], 200);
    }

    public function storeReact(Request $request) {
        $message = Message::findOrFail($request->message_id);

        $reaction = $message->isReactedByUser($request->user_id);

        if(!$reaction) {
            $newReact = new Messageslike();
            $newReact->message_id = $request->message_id;
            $newReact->user_id = $request->user_id;
            $newReact->type_id = $request->type_id;
            $newReact->save();
        } else {
            $reaction->delete();
        }

        $message->load(['user', 'reactions', 'reply', 'reply.user']);

        event(new LikeEvent($message));

        return response()->json(['reactions' => $message->reactions], 200);
    }

    public function storeImage(Request $request) {
        $file = $request->file('attach');

        $filename = $request->get('user_id') . '_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
        Storage::disk(config('app.disk'))->putFileAs('public/files/chat/', $file, $filename, 'public');

        $message = new Message;
        $message->user_id = $request->get('user_id');
        $message->body = '/storage/files/chat/' . $filename;
        $message->type_id = 'image';
        $message->save();

        $message->load(['user', 'reactions', 'reply', 'reply.user']);

        try {
            event(new ChatEvent($request->user(), $message));
        } catch(BroadcastException $e) {

        }

        return response()->json(['message' => $message], 200);
    }

    public function banMessage(Request $request) {
        $message = Message::findOrFail($request->message_id);
        $message->status_id = 0;
        $message->save();

        event(new HideEvent($message));

        return response()->json(['success' => true], 200);
    }
}
