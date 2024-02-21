<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Notifications\UserUpdated;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Enviar e-mail de boas-vindas
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Atribuir uma função padrão ao novo usuário
        $user->assignRole('user');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Notification::send($user, new UserUpdated($user));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        AuditLog::create(['action' => 'user_deleted', 'user_id' => $user->id]);

        // Limpar relacionamentos ou registros associados
        $user->profile()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
