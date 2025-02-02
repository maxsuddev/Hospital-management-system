<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Create ') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('permission.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Create permission</h3>
                </div>
                <form  action="{{ route('permission.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Name</label>
                            <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>>
