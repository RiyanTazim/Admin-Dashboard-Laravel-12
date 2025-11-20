<?php

namespace App\Notifications;

use App\Models\SystemSetting;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommonNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $customMessage;
    protected $subjectLine;

    /**
     * Create a new notification instance.
     */
    public function __construct($customMessage, $subjectLine = 'Welcome Notification')
    {
        $this->customMessage = $customMessage;
        $this->subjectLine = $subjectLine;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $systemSetting = SystemSetting::first();
        $logoPath = $systemSetting?->logo;
        $logoUrl = $logoPath ? asset($logoPath) : null;

        return (new MailMessage)
            ->subject($this->subjectLine)
            ->view('backend.layouts.emails.common_notification', [
                'logoUrl'        => $logoUrl,
                'notifiable'     => $notifiable,
                'customMessage'  => $this->customMessage,
                'subjectLine'    => $this->subjectLine,
            ]);
    }
}
