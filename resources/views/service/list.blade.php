<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category create') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('service.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Service</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Created_at</th>
                            </tr>
                            @if ($services->isNotEmpty())
                            @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->name }}</td>
                                <td> {{ $service->category->name }}</td>
                                <td>{{ $service->price }}</td>

                                <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('service.edit',$service->id) }}" class="btn btn-dark">Edit</a>

                                    <a href="#" onclick="deleteService({{ $service->id  }});" class="btn btn-danger">Delete</a>
                                    <form id="delete-service-from-{{ $service->id  }}" action="{{ route('service.destroy',$service->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                            @endif

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteService(id) {
            if (confirm("Are you sure you want to delete service?")) {
                document.getElementById("delete-service-from-"+id).submit();
            }
        }
    </script>
</x-app-layout>

