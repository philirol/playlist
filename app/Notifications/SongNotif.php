<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Song;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class SongNotif extends Notification implements ShouldQueue
{
    use Queueable;

    protected $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Message from Playlist')
                    ->greeting('Hello!')   
                    ->line('The song "'. $this->song->title.'" has been modified by '. Auth::user()->name)
                    ->action('Go on Playlist', url('http://localhost/playlist_laravel58/public'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
