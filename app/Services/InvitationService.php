<?php

namespace App\Services;

use App\Mail\UserInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationService
{
    public function send(User $user): void
    {
        // Generar token único
        $token = Str::random(64);

        // Guardar token y fecha en el usuario
        $user->update([
            'invitation_token'   => $token,
            'invitation_sent_at' => now(),
            'active'             => false,
        ]);

        // Generar URL de activación
        $activationUrl = route('invitation.activate', ['token' => $token]);

        // Enviar correo
        Mail::to($user->email)->send(new UserInvitation($user, $activationUrl));
    }

    public function activate(string $token, string $password): bool
    {
        $user = User::where('invitation_token', $token)
            ->where('invitation_sent_at', '>=', now()->subHours(24))
            ->first();

        if (!$user) {
            return false;
        }

        $user->update([
            'password'          => bcrypt($password),
            'active'            => true,
            'invitation_token'  => null,
            'email_verified_at' => now(),
        ]);

        return true;
    }
}
