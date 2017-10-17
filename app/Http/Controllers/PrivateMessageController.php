<?php

namespace App\Http\Controllers;

use App\PrivateMessage;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{
    /**
     * Get all unread messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserNotifications(Request $request)
    {
        $notifications = (new PrivateMessage())
            ->unRead(
                $request->user()->id
            );

        return response()->json($notifications, 200);
    }

    /**
     * Get all output messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrivateMessages(Request $request)
    {
        $messages = (new PrivateMessage())
            ->getReceiverMessages(
                $request->user()->id
            );

        return response()->json($messages, 200);
    }

    /**
     * Get message by id
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrivateMessageById(Request $request)
    {
        $msg = (new PrivateMessage())->find($request->get('id'));

        return response()->json($msg, 200);
    }

    /**
     * Get all input messages
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrivateMessagesSent(Request $request)
    {
        $messages = (new PrivateMessage())
            ->getSenderMessages($request->user()->id);

        return response()->json($messages, 200);
    }

    public function sendPrivateMessage(Request $request)
    {
        $data = [
            'sender_id' => $request->get('sender_id'),
            'receiver_id' => $request->get('receiver_id'),
            'subject' =>$request->get('subject'),
            'message' => $request->get('message'),
            'read' => 0
        ];

        $message = (new PrivateMessage())
            ->save($data);

        return response()->json($message, 200);
    }
}
