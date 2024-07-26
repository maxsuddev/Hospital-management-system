<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }}
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
                        <h3 class="text-white">Edit Order</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('order.update', $order->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="full_name" class="form-label h5">Full Name</label>
                                <input value="{{ old('full_name', $order->Full_name) }}" type="text" class="@error('full_name') is-invalid @enderror form-control-lg form-control" placeholder="Full Name" name="full_name">
                                @error('full_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label h5">Address</label>
                                <input value="{{ old('address', $order->address) }}" type="text" class="@error('address') is-invalid @enderror form-control-lg form-control" placeholder="Address" name="address">
                                @error('address')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label h5">Phone</label>
                                <input value="{{ old('phone', $order->phone) }}" type="text" class="@error('phone') is-invalid @enderror form-control-lg form-control" placeholder="Phone" name="phone">
                                @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label h5">Age</label>
                                <input value="{{ old('age', $order->age) }}" type="number" class="@error('age') is-invalid @enderror form-control-lg form-control" placeholder="Age" name="age">
                                @error('age')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="services" class="form-label h5">Services</label>
                                @foreach($services as $service)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}" id="service{{ $service->id }}" name="services[{{ $service->id }}][id]"
                                               @if(in_array($service->id, $order->service->pluck('id')->toArray())) checked @endif>
                                        <label class="form-check-label" for="service{{ $service->id }}">
                                            {{ $service->name }} (${{ $service->price }})
                                        </label>
                                        <input type="number" class="form-control mt-2" placeholder="Quantity" name="services[{{ $service->id }}][quantity]"
                                               value="{{ $order->service->where('id', $service->id)->first()->pivot->quantity ?? '' }}">
                                        <input type="hidden" name="services[{{ $service->id }}][price]" value="{{ $service->price }}">
                                    </div>
                                @endforeach
                                @error('services')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
