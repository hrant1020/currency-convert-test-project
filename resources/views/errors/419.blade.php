<!-- resources/views/errors/419.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">419 - Page Expired</h4>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">Sorry, your session has expired. Please try again.</p>
                        <a href="{{ route('index') }}" class="btn btn-primary">Go Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
