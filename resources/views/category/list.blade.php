<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('category.create') }}" class="btn btn-dark">Create</a>
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
                    <h3 class="text-white">Category</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Service</th>
                            <th>Action</th>
                        </tr>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    @foreach($category->services as $service)
                                        <td>{{$service->name ?? 'No add yet'}}</td>
                                    @endforeach
                                    <td>
                                        <a href="{{ route('category.edit',$category->id) }}" class="btn btn-dark">Edit</a>

                                        <a href="#" onclick="deleteCategory({{ $category->id  }});" class="btn btn-danger">Delete</a>
                                        <form id="delete-category-from-{{ $category->id  }}" action="{{ route('category.destroy',$category->id) }}" method="post">
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
        function deleteCategory(id) {
            if (confirm("Are you sure you want to delete category?")) {
                document.getElementById("delete-category-from-"+id).submit();
            }
        }
    </script>
</x-app-layout>
