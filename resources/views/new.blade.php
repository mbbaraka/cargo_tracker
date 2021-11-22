@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">
            <div class="card" style="min-height: 100%">
                <div class="card-header">Menu</div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action" href="{{ route('home') }}">Dashboard</a>
                        <a class="list-group-item list-group-item-action active" href="{{ route('new') }}">{{ __('New Transaction') }}</a>
                        <a class="list-group-item list-group-item-action" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
                        <a class="list-group-item list-group-item-action" href="#">{{ __('My Profile') }}</a>
                        <a class="list-group-item list-group-item-action" href="#">{{ __('Logout') }}</a>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="min-height: 100%">
                <div class="card-header">{{ __('New Shipment') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cargo_name">Cargo Name</label>
                                    <input id="cargo_name" class="form-control @error('cargo_name') is-invalid @enderror" type="text" name="cargo_name" value="{{ old('cargo_name') }}">
                                    @error('cargo_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cargo_desc">Cargo Description</label>
                                    <textarea name="cargo_desc" id="" class="form-control @error('cargo_desc') is-invalid @enderror">
                                        {{ old('cargo_desc') }}
                                    </textarea>
                                    @error('cargo_desc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender_name">Sender Name</label>
                                    <input id="sender_name" class="form-control @error('sender_name') is-invalid @enderror" type="text" name="sender_name" value="{{ old('sender_name') }}">
                                    @error('sender_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sender_phone">Sender Phone</label>
                                    <input id="sender_phone" class="form-control @error('sender_phone') is-invalid @enderror" type="text" name="sender_phone" value="{{ old('sender_phone') }}" placeholder="07xxxxxxxxx">
                                    @error('sender_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receiver_name">Receiver Name</label>
                                    <input id="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror" type="text" name="receiver_name" value="{{ old('receiver_name') }}">
                                    @error('receiver_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receiver_phone">Receiver Phone</label>
                                    <input id="receiver_phone" class="form-control @error('receiver_phone') is-invalid @enderror" type="text" name="receiver_phone" value="{{ old('receiver_phone') }}" placeholder="07xxxxxxxxx">
                                    @error('receiver_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between m-auto">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
