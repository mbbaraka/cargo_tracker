@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">
            <div class="card" style="min-height: 100%">
                <div class="card-header">Menu</div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action active" href="{{ route('home') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('new') }}">{{ __('New Transaction') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
                        <a class="list-group-item list-group-item-action" href="#">{{ __('My Profile') }}</a>
                        <a class="list-group-item list-group-item-action" href="#">{{ __('Logout') }}</a>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="min-height: 100%">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3><i class="fa fa-bell"></i></h3>
                                        <h2 class="text-center">230</h2>
                                        <h6>NOtifications</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fa fa-bell"></i>
                                        <h2 class="text-center">230</h2>
                                        <h6>Total Sent</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fa fa-bell"></i>
                                        <h2 class="text-center">230</h2>
                                        <h6>Total Sent</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h4><i class="fa fa-bell"></i></h4>
                                        <h2 class="text-center">230</h2>
                                        <h6>Total Sent</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fa fa-bell"></i>
                                        <h2 class="text-center">230</h2>
                                        <h6>Total Sent</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fa fa-bell"></i>
                                        <h2 class="text-center">230</h2>
                                        <h6>Total Sent</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
