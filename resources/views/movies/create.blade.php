@extends('layouts.app')

@section('content')

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Nuovo Film</h5>
                <a href="{{ route('movies.index') }}" class="btn btn-sm btn-light">Torna alla lista</a>
            </div>

            <div class="card-body">
                <form action="{{ route('movies.store') }}" method="POST" novalidate>
                    @csrf
                    {{-- Includiamo i campi del form --}}
                    @include('movies._form', ['submitButtonText' => 'Crea'])
                </form>
            </div>
        </div>
    </div>
@endsection
