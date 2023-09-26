<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
    public function showForgotPasswordForm()
    {
        return view('solipassword');
    }

    /**
     * Envía el correo electrónico con el enlace de restablecimiento de contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('password.request')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Muestra la página de restablecimiento de contraseña.
     *
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token)
    {
        return view('reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    

    

    /**
     * Procesa la solicitud de restablecimiento de contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        }
    );

    if ($status == Password::PASSWORD_RESET) {
        session()->flash('status', 'La contraseña se ha restablecido exitosamente.');
        return redirect()->route('logeo');
    } else {
        return back()->withErrors(['email' => [__($status)]]);
    }
}



}
