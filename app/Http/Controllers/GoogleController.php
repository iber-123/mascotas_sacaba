<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirect();
    }

 public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->getId())
                    ->orWhere('email', $googleUser->getEmail())
                    ->first();

        if (!$user) {
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'password'  => bcrypt(rand()),
                'google_id' => $googleUser->getId(),
            ]);
            $user->assignRole('Usuario');
        } else {
            if ($user->roles->count() === 0) {
                $user->assignRole('Usuario');
            }
        }

        Auth::login($user, true);

        return redirect()->intended('/check-role'); // usar intended para mantener URL previa

    } catch (\Exception $e) {
        return redirect('/login')->withErrors('Error al iniciar sesión con Google: ' . $e->getMessage());
    }
}


}
