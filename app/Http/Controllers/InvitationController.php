<?php

namespace App\Http\Controllers;

use App\Services\InvitationService;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function __construct(
        protected InvitationService $invitationService
    ) {}

    public function activate(string $token)
    {
        $user = User::where('invitation_token', $token)
            ->where('invitation_sent_at', '>=', now()->subHours(24))
            ->first();

        if (!$user) {
            return view('invitation.expired');
        }

        return view('invitation.activate', compact('user', 'token'));
    }

    public function store(Request $request, string $token)
    {
        $request->validate([
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $activated = $this->invitationService->activate($token, $request->password);

        if (!$activated) {
            return back()->withErrors(['token' => 'El enlace ha expirado o no es válido.']);
        }

        return redirect()->route('login')->with('status', 'Cuenta activada exitosamente. Ya puede iniciar sesión.');
    }
}
