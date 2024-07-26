<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Doctor') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('doctor.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Doctor</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('doctor.update', $doctor->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="first_name" class="form-label h5">First Name</label>
                                <input value="{{ old('first_name', $doctor->first_name) }}" type="text" class="@error('first_name') is-invalid @enderror form-control-lg form-control" placeholder="First Name" name="first_name">
                                @error('first_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label h5">Last Name</label>
                                <input value="{{ old('last_name', $doctor->last_name) }}" type="text" class="@error('last_name') is-invalid @enderror form-control-lg form-control" placeholder="Last Name" name="last_name">
                                @error('last_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label h5">Phone</label>
                                <input value="{{ old('phone', $doctor->phone) }}" type="text" class="@error('phone') is-invalid @enderror form-control-lg form-control" placeholder="Phone" name="phone">
                                @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="telegram_id" class="form-label h5">Telegram ID</label>
                                <input value="{{ old('telegram_id', $doctor->telegram_id) }}" type="text" class="@error('telegram_id') is-invalid @enderror form-control-lg form-control" placeholder="Telegram Id" name="telegram_id">
                                @error('telegram_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label h5">Birthday</label>
                                <input value="{{ old('birthday', $doctor->birthday) }}" type="date" class="@error('birthday') is-invalid @enderror form-control-lg form-control" name="birthday">
                                @error('birthday')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label h5">Categories</label>
                                <select class="@error('category_id') is-invalid @enderror form-control-lg form-control" id="category_id" name="category_id[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, $doctor->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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
</x-app-layout>
