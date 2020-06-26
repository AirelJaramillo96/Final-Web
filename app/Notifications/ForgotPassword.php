<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgotPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $route = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->from('no-reply@iotuaa.com', 'Fumisan')
            ->subject('Cambio de contraseña')
            ->greeting('Hola')
            ->line('Bienvenido')
            ->line('Parece que has olvidado la contraseña')
            ->line('No te preocupes, te ayudaremos a recuperarla')
            ->line('Solo haz click en el siguiente botón')
            ->action('Actualizar Contraseña', (string)$route)
            ->line('¡Gracias por formar parte del equipo iot!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function verificationUrl($notifiable)
    {

        $token = Str::random(32);
        DB::table('password_resets')->insert([
            'email'      => $notifiable->email,
            'token'      => bcrypt($token),
            'created_at' => Carbon::now(),
        ]);
        return route('users.reset.password', $token);
    }
}
