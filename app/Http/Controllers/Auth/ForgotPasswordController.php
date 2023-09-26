<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB; // Agregar la referencia a DB
use Illuminate\Validation\ValidationException; // Agregar la referencia a ValidationException

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.reset-password');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Verificar si existe un token válido para este correo en la base de datos
        $tokenExists = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('created_at', '>', now()->subHours(2)) // Puedes ajustar este límite de tiempo según tu configuración
            ->exists();

        if (!$tokenExists) {
            // No se encontró un token válido para este correo
            throw ValidationException::withMessages([
                'email' => ['Tu correo no está registrado'],
            ]);
        }

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            session()->flash('status', 'Se ha enviado un correo con las instrucciones para restablecer la contraseña.');
            return redirect()->route('password.request');
        }

        return $this->sendResetLinkFailedResponse($request, $response);
    }
}
