@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">
            <div class="card" style="min-height: 100%">
                {{--  mobile nav  --}}
                <div class="card-header">Menu</div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action active" href="{{ route('home') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('new') }}">{{ __('New Transaction') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('buses') }}">{{ __('Buses') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('location') }}">{{ __('Location') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('profile') }}">{{ __('My Profile') }}</a>
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
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row mt-3">
                        <div class="col-4">
                            <a href="{{ route('shippings') }}" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="img-custom" src="{{ asset('images/cargo.png') }}" alt="">
                                        <h2 class="text-center">{{ $cargos }}</h2>
                                        <h6>Total Cargo Delivered</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="img-custom" src="{{ asset('images/shipping.gif') }}" alt="">
                                        <h2 class="text-center">{{ $shipping }}</h2>
                                        <h6>Shipping Now</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('buses') }}" class="custom-link">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="img-custom" src="{{ asset('images/buses.png') }}" alt="">
                                        <h2 class="text-center">{{ $buses }}</h2>
                                        <h6>Total Buses</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Shipping Summary</h6>
                            <table class="table table-hover table-light">
                                <tr>
                                    <td>#</td>
                                    <td>Received Cargo</td>
                                    <td>{{ $received }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Shipping Cargo</td>
                                    <td>{{ $shipping }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Ready to Pick Cargo</td>
                                    <td>{{ $reached }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Picked Cargo</td>
                                    <td>{{ $cargos }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Movements by Location</h6>
                            <table class="table table-hover table-dark">
                                @if ($location->count() >0)
                                    @foreach ($location as $item)
                                        <tr>
                                            <td>{{ $item->location }}</td>
                                            <td>
                                                @php
                                                    $movement = App\Models\Shipping::where('destination', $item->id)->where('status', 'shipping');
                                                    echo $movement->count()
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="2">No Items currently added</td></tr>
                                @endif
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
