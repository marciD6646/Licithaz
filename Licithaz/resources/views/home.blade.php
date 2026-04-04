@extends('layouts.app')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-col">
            <div class="card">
                <div class="card-header">
                    <h1 class="dashboard-title">{{ __('Dashboard') }}</h1>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="status-alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
@endsection