<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $message = $request->input('message');
        $titulo = $request->input('titulo');

        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ]);

        $data['message'] = $message;
        $data['titulo'] = $titulo;
        $data['url'] = 'https://edusnapec.com/';
        $pusher->trigger('notifications', 'new-notification', $data); // Corregido el canal y el evento aquí

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }
}
