<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;

class PostAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Post $post)
    {
    }

    public function via($notifiable)
    {
        return ['database'];
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
            "title"            =>  [
              'ar'      => "تم إضافة منشور جديد",
              'en'      => "New Post Added"
              ],
            "description"      =>  [
              'ar' => $this->post['title_ar'],
              'en' => $this->post['title_en']
            ],
            "entity_type"      =>  get_class($this->post),
            "entity_id"        =>  $this->post->id
        ];
    }
}