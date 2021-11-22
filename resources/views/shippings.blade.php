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
                        <a class="list-group-item list-group-item-action" href="{{ route('new') }}">{{ __('New Shipping') }}</a>
                        <a class="list-group-item list-group-item-action active" href="{{ route('shippings') }}">{{ __('All Shippings') }}</a>
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

                    <table class="table table-striped table-inverse table-responsive-sm">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Cargo ID</th>
                                <th>Cargo Name</th>
                                <th>Sender</th>
                                <th>Receiver</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippings as $key => $shipping)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $shipping->cargo_id }}</td>
                                    <td>{{ $shipping->cargo_name }}</td>
                                    <td>{{ $shipping->sender_name }}</td>
                                    <td>{{ $shipping->receiver_name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-primary">{{ Str::ucfirst($shipping->status) }}</span>
                                        <button type="button"  class="btn btn-outline-light" data-toggle="modal" data-target="#modal{{ $shipping->txn_id }}">
                                            <i class="fa fa-pencil text-secondary"></i>
                                        </button>
                                        <div id="modal{{ $shipping->txn_id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Status</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('edit') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="txn_id" value="{{ $shipping->txn_id }}">
                                                            <div class="form-group">
                                                              <label for="status">Status</label>
                                                              <select class="form-control" name="status" id="status">
                                                                <option @if($shipping->status == 'received') selected @endif value="received">Received</option>
                                                                <option @if($shipping->status == 'shipped') selected @endif value="shipped">Shipped</option>
                                                                <option @if($shipping->status == 'reached') selected @endif value="reached">Reached</option>
                                                                <option @if($shipping->status == 'picked') selected @endif value="picked">Picked</option>
                                                              </select>
                                                            </div>

                                                            <div class="row justify-content-between m-auto">
                                                                <button data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                        {{ $shippings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
