<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('order.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Order Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h5>First Name: {{ $order->full_name }}</h5>
                        </div>
                        <div class="mb-3">
                            <h5>Address: {{ $order->address }}</h5>
                        </div>
                        <div class="mb-3">
                            <h5>Phone: {{ $order->phone }}</h5>
                        </div>
                        <div class="mb-3">
                            <h5>Age: {{ $order->age }}</h5>
                        </div>
                        <div class="mb-3">
                            <h5>Services:</h5>
                            <ul class="list-group">
                                @foreach($order->service as $service)
                                    <li class="list-group-item">
                                        <b>{{ $service->name }}</b> - Quantity: {{ $service->pivot->quantity }} - Price: {{ $service->pivot->price }}
                                    </li>

                                @endforeach
                            </ul>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('order.index') }}" class="btn btn-lg btn-dark">Back to Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
