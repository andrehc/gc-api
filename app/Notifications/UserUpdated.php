<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class UserUpdated extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Perfil Atualizado')
            ->line('Seu perfil foi recentemente atualizado. Confira as mudanças abaixo:')
            ->action('Ver Perfil', url('/users/{userId}'))
            ->line('Obrigado por usar nosso serviço!');
    }
}
