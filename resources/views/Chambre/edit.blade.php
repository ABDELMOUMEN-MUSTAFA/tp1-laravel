@extends("layouts.app")

@section("content")
<div class="mb-3">
    <a href="{{route('chambres.index')}}" class="btn btn-secondary">Retourner</a>
</div>
<form action="{{route("chambres.update", $chambre->id)}}" method="POST">
    <h2 class="mb-3">Nouvelle chambre</h2>
    <div class="mb-3">
        <select name="type_id" class="form-select">
            <option selected disabled>Type de chambre</option>
            @foreach($types as $type)
                <option @if($type->id == $chambre->type_id) selected @endif value="{{$type->id}}">{{$type->titre}}</option>
            @endforeach
        </select>
        @error('type_id')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea placeholder="Description" name="description" id="description" rows="5" class="form-control">{{$chambre->description}}</textarea>
        @error('description')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="superficie" class="form-label">Superficie</label>
        <input value="{{$chambre->superficie}}" type="text" name="superficie" id="superficie" class="form-control" placeholder="en &#x33A1;" />
        @error('superficie')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Etage</label>
        <div class="d-flex gap-3">
            @foreach($etages as $etage)
                <div class="form-check">
                    <input type="radio" value="{{$etage}}" @if($etage == $chambre->etage) checked @endif class="form-check-input" name="etage" id="etage-{{$etage}}" />
                    <label class="form-check-label" for="etage-{{$etage}}">{{$etage}}</label>
                </div>
            @endforeach
        </div>
        @error('etage')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="text" value="{{$chambre->prix}}" class="form-control" placeholder="en DHs" id="prix" name="prix" />
        @error('prix')
            <small class="text-danger">{{$message}}</small>
        @enderror
    </div>
    @csrf
    @method('PATCH')
    <button class="btn btn-success">Ajouter</button>
</form>
@endsection