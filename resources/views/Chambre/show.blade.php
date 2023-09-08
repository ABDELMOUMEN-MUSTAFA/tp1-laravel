@extends("layouts.app")

@section("content")
    <div class="mb-5 d-flex justify-content-between">
        <a href="{{route('chambres.index')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        <form method="POST" action="{{route("chambres.destroy", $chambre->id)}}"><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
        </button>@csrf @method("DELETE")</form>
    </div>
    <h2 class="mb-4">Détails de la chambre numéro {{$chambre->id}}</h2>
    <section class="d-flex justify-content-between">
        <div class="d-flex flex-column gap-2">
            <span><strong>Type :</strong> {{$chambre->type->titre}}</span>
            <span><strong>Superficie :</strong> {{$chambre->superficie}} m<sup>2</sup></span>
            <span style="max-width: 600px"><strong>Description :</strong> {{$chambre->description}}</span>
        </div>
        <div class="d-flex flex-column gap-2">
            <span><strong>Etage :</strong> {{$chambre->etage}}</span>
            <span><strong>Prix :</strong> {{$chambre->prix}} DH</span>
        </div>
    </section>
    <section class="mt-5">
        @if(session("message"))
            <div class="alert alert-success my-2">{{session("message")}}</div>
        @endif
        <h5 class="mb-3"><u>Réservation en cours et prochaines réservations</u></h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom de l'utilisateur</th>
                    <th>Date de départ</th>
                    <th>Date d'arrivée</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chambre->users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->pivot->date_depart}}</td>
                        <td>{{$user->pivot->date_arrivee}}</td>
                        <td class="text-center"><form method="POST" class="d-inline-block" action="{{route("chambres.detach", [$chambre->id, $user->id])}}"><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                        </button>@csrf @method("DELETE")</form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection