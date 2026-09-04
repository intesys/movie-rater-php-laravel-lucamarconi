@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Modifica Film</h5>
                <a href="{{ route('movies.index') }}" class="btn btn-sm btn-light">Torna alla lista</a>
            </div>

            <div class="card-body">
                <form action="{{ route('movies.update', $movie) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    {{-- Includiamo i campi del form --}}
                    @include('movies._form', ['submitButtonText' => 'Salva'])
                </form>
            </div>
        </div>
    </div>
@endsection
