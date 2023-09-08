<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\UserVerificationMail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        if ($user) {
            try {
                Mail::to($user->email)->send(new UserVerificationMail($user));
                return response()->json(['message' => "Inscrit(e), vérifiez votre adresse e-mail pour vous connecter."]);
            } catch (\Exception $e) {
                $user->delete();

                return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
            }
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remembre' => 'required|boolean'
        ]);

        unset($credentials['remembre']);

        if (auth()->attempt($credentials, $request->remembre)) {
            /** @var \App\Models\User */
            $user = auth()->user();
            if (!$user->hasVerifiedEmail()) {
                // Resend link to verify email
                Mail::to($user->email)->send(new UserVerificationMail($user));

                return response()->json(['message' => 'Lien de vérification envoyé !']);
            }
            return response()->json([
                'message' => 'Vous êtes connecté avec succès.',
                'user' => $user->only(['name', "email"])
            ]);
        }

        return response()->json(['message' => "Les informations d'identification fournies ne sont pas correctes."], 422);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()->only(['name', "email"])]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return response()->noContent();
    }

    public function forgot(Request $request)
    {
        $validatedData = $request->validate([
            "email" => "required|email"
        ]);

        $user = User::where('email', $validatedData['email'])->first();
        if (!$user) {
            return response()->json(['message' => "Cet e-mail n'existe pas."], 404);
        }

        $validatedData['token'] = Str::random(16);
        DB::table('password_resets')->insert($validatedData);

        try {
            Mail::to($user->email)->send(new ResetPasswordMail($validatedData['token'], $user));
            return response()->json(["message" => "Nous vous avons envoyé un e-mail de réinitialisation de mot de passe."]);
        } catch (\Exception $e) {
            DB::table('password_resets')->where('email', $user->email)->delete();

            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $passwordReset = DB::table('password_resets')->where("token", $request->token)->first();
        if (!$passwordReset) {
            return response()->json(["message" => "Le token fourni est invalide."], 400);
        }

        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            return response()->json(["message" => "Cet utilisateur n'existe plus."], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        return response()->json(["message" => "Réinitialisation du mot de passe réussie."]);
    }

    public function checkResetPasswordToken($token)
    {
        $passwordReset = DB::table("password_resets")
            ->select('email')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            return response()->json(["message" => "Le token fourni est invalide."], 403);
        }

        return response()->json($passwordReset);
    }
}
