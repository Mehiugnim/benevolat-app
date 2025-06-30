@extends('layouts.app')

@section('title', 'Projets disponibles')

@section('content')
    <h2>Projets de bénévolat</h2>

    @if($projets->isEmpty())
        <p>Aucun projet disponible pour le moment.</p>
    @else
        @foreach ($projets as $projet)
            <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px;">
                <h3>{{ $projet->titre_projet }}</h3>
                <p><strong>Lieu :</strong> {{ $projet->lieu_projet }}</p>
                <p><strong>Compétences :</strong> {{ $projet->competences_requises }}</p>
                <p>{{ $projet->description_projet }}</p>
            </div>
        @endforeach
    @endif
@endsection
