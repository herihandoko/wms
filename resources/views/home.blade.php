@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @can('view_users')
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Users Management</h5>
                                    <p class="card-text">Manage system users, their roles and permissions.</p>
                                    <a href="{{ route('users.index') }}" class="btn btn-primary">Manage Users</a>
                                </div>
                            </div>
                        </div>
                        @endcan

                        @can('view_roles')
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Roles Management</h5>
                                    <p class="card-text">Manage user roles and their associated permissions.</p>
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Manage Roles</a>
                                </div>
                            </div>
                        </div>
                        @endcan

                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
                                    <p class="card-text">Your roles:
                                        @foreach(Auth::user()->roles as $role)
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
