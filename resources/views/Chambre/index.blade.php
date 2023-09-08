@extends("layouts.app")

@section("content")
<div class="mb-3">
    <a href="{{route('chambres.create')}}" class="btn btn-primary">Nouvelle chambre</a>
</div>
@if(session("message"))
    <div class="alert alert-success my-2">{{session("message")}}</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Description</th>
            <th>Superficie (m<sup>2</sup>)</th>
            <th>Etage</th>
            <th>Prix (par unité)</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($chambres as $chambre)
            <tr>
                <td>{{$chambre->id}}</td>
                <td>{{$chambre->type->titre}}</td>
                <td class="text-truncate" style="max-width: 350px">{{$chambre->description}}</td>
                <td>{{$chambre->superficie}}</td>
                <td>{{$chambre->etage}}</td>
                <td>{{$chambre->prix}}</td>
                <td class="text-center"><a href="{{route("chambres.show", $chambre->id)}}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i>
                </a> <a href="{{route("chambres.edit", $chambre->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i>
                </a> <form method="POST" class="d-inline-block" action="{{route("chambres.destroy", $chambre->id)}}"><button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                </button>@csrf @method("DELETE")</form></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection