<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('order.create') }}" class="btn btn-dark">Create Order</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Orders</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Age</th>
                                <th>Services</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
{{--                                    @dd($order)--}}
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->full_name }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->age }}</td>
                                    <td>
                                        <ul>
                                            @foreach($order->service as $service)
                                                <li>{{ $service->name }} (x{{ $service->pivot->quantity ?? '' }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $service->pivot->price ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-12">
                            <nav aria-label="Page navigation" class="justify-content-center">
                                {{$orders->links('pagination::bootstrap-4')}}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
