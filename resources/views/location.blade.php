@extends('layouts.app')

@section('title', 'Locations')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">
            <div class="card" style="min-height: 100%">
                <div class="card-header">Menu</div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action" href="{{ route('home') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('new') }}">{{ __('New Shipping') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('buses') }}">{{ __('Buses') }}</a>
                        <a class="list-group-item list-group-item-action active" href="{{ route('location') }}">{{ __('Location') }}</a>
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
                <div class="card-header">{{ __('Locations') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <h4>Add New Location</h4>
                            <form class="" method="post" action="{{ route('location-add') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="my-input">Location  </label>
                                    <input id="my-input" value="{{ old('location') }}" class="form-control @error('location') is-invalid @enderror" type="text" name="location">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="my-input">Duration  </label>
                                    <input id="my-input" value="{{ old('duration') }}" class="form-control @error('duration') is-invalid @enderror" type="number" name="duration">
                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                        <div class="col-md-7">
                            <h4>All Available Buses</h4>
                            <table class="table table-striped table-bordered table-inverse table-responsive-sm">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Location</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ($locations->count() > 0)
                                        @foreach ($locations as $key => $location)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $location->location }}</td>
                                            <td>{{ $location->duration }} Hours</td>
                                            <td>
                                                <a onclick="confirm('Are you sure you want to delete')" href="{{ route('location-delete', $location->id) }}"  class="btn btn-outline-light">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr><td colspan="4" class="text-center">No location added yet</td></tr>
                                        @endif
                                    </tbody>
                            </table>

                                {{ $locations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
