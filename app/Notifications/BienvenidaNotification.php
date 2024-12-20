<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BienvenidaNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('¡Bienvenido a Fragora!')
        ->greeting('¡Hola ' . $notifiable->name . '!')
        ->line('Gracias por registrarte en Fragora Perfumes. Estamos muy emocionados de tenerte con nosotros.') 
        ->line('En nuestra tienda online, podrás encontrar una gran variedad de perfumes árabes de alta calidad.')
        ->action('Visita nuestra tienda', url('/'))
        ->line('Si tienes alguna pregunta, no dudes en contactarnos a través de nuestro servicio de atención al cliente.')
        ->line('Gracias por confiar en nosotros. ¡Esperamos que disfrutes de tu experiencia de compra!')
        ->salutation('Saludos, Fragora Perfumes');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
