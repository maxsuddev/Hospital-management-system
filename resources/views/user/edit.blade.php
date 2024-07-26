<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit ') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('user.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Edit user</h3>
                </div>
                <form  action="{{ route('user.update',$user->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Name</label>
                            <input value="{{ old('name',$user->name) }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Email</label>
                            <input value="{{ old('email',$user->email) }}" type="email" class="@error('email') is-invalid @enderror form-control-lg form-control" placeholder="Email" name="email">
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label h5">Password</label>
                            <input value="{{ old('password') }}" type="password" class="@error('password') is-invalid @enderror form-control-lg form-control" placeholder="Password" name="password">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label h5">Roles</label>
                            <select class="@error('roles[]') is-invalid @enderror form-control-lg form-control"  name="roles[]" multiple>
                                <option style="color: white">Choose Role</option>
                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->name }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

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
