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
                    </div>
                    <edit-device :id="{{request()->route()->parameter('id')}}"></edit-device>
                </div>
            </div>
        </div>
    </div>
@endsection
