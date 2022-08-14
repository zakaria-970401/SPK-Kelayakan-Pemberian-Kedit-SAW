@extends('layouts.base')
@section('title', 'Home Page')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <strong>Hallo {{ Auth::user()->name }}, Selamat Datang!</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
