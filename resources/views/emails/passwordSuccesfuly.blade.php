@extends('layouts.app')

@section('title', __('Login'))

@section('content')

    <div>
        <h1 class="mb-3 text-18 text-center">Contraseña cambiada satisfactoriamente</h1>
        <a  href="{{ route('home') }}" class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-rounded d-flex justify-content-center"> Pagina Principal </a>
    </div>



@endsection
