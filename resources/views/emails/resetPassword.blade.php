@extends('layouts.app')

@section('title', __('Login'))

@section('content')
    <h1 class="mb-3 text-18 text-center">Generar nueva contraseña</h1>
    <form method="POST" action="{{ route('users.change.password')}}">
        @csrf
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" class="form-control form-control-rounded @error('password') is-invalid @enderror" type="password" name="password_confirmation" required>
        </div>
        <input id="id" type="hidden" class="form-control" name="id" value="{{$user->id}}">
        <button class="btn btn-rounded btn-primary btn-block mt-2">
            {{ __('Confirm') }}
        </button>
    </form>
@endsection
