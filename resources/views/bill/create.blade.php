<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category create') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('cash_box.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Create category</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('cashbox.cost') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Kerakli Summa</label>
                                <input value="{{ old('cost') }}" type="text" class="@error('cost') is-invalid @enderror form-control-lg form-control" placeholder="Xarajat" name="cost">
                                @error('cost')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Comment</label>
                                <input value="{{ old('comment') }}" type="text" class="@error('comment') is-invalid @enderror form-control-lg form-control" placeholder="Comment" name="comment">
                                @error('comment')
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
