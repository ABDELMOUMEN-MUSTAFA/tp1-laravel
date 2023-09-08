@component('mail::message')
@component('mail::panel')
Vérification d'e-mail.
@endcomponent
Bonjour **{{$user->name}}**,
<br>
Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail:

@component('mail::button', ['url' => URL::temporarySignedRoute("verification.verify", now()->addMinutes(15), $user->id), 'color' => 'success'])
Vérifier mon adresse e-mail
@endcomponent
 
Cordialement,<br>
{{ config('app.name') }}
@endcomponent