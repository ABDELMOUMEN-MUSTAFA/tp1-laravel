@component('mail::message')
@component('mail::panel')
Réinitialisation du mot de passe.
@endcomponent
Bonjour **{{$user->name}}**,
<br>
Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

@component('mail::button', ['url' => env('FRONTEND_URL').'/password/reset/'.$token, 'color' => 'success'])
Réinitialiser le mot de passe
@endcomponent

Si vous n'avez pas fait cette demande, vous pouvez ignorer cet e-mail en toute sécurité.
<br>
Cordialement,<br>
{{ config('app.name') }}
@endcomponent