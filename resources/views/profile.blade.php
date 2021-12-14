@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">
            <div class="card" style="min-height: 100%">
                <div class="card-header">Menu</div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action" href="{{ route('home') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('new') }}">{{ __('New Transaction') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('buses') }}">{{ __('Buses') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('location') }}">{{ __('Location') }}</a>
                        <a class="list-group-item list-group-item-action active" href="{{ route('profile') }}">{{ __('My Profile') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="min-height: 100%">
                <div class="card-header">My Account Information</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-light">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <tbody>
                            <tr>
                                <td>First Name</td>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>

                        </tbody>
                    </table>
                    <tr>
                        <p>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#contentId" aria-expanded="false"
                                    aria-controls="contentId">
                                Change Password
                            </button>
                        </p>
                        <div class="collapse" id="contentId">

                        <form class="form-horizontal" method="POST" action="{{ route('password-change') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} row">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }} row">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </tr>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
