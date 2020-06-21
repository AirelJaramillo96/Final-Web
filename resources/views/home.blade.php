@extends('layouts.app')
@routes
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body" style="text-align: right">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('create.device')}}">
                        <button  type="button" class="btn btn-circle btn-sm btn-primary"><h6>Registrar nuevo dipositivo</h6></button>
                    </a>
                        <br>

                </div>
                <index-device></index-device>
            </div>
        </div>
    </div>
</div>
@endsection
