<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles ') }}
        </h2>
    </x-slot>
    <div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('role.create') }}" class="btn btn-dark">Create</a>
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
                    <h3 class="text-white">Roles</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                        @if ($roles->isNotEmpty() )
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id ?? ''}}</td>
                                    <td>{{ $role->name  ?? ''}}</td>

                                    <td>
                                        <a href="{{ url('role/'.$role->id.'/give-permission') }}" class="btn btn-dark">Add / Edit Role Permission</a>

                                        <a href="{{ route('role.edit',$role->id) }}" class="btn btn-dark">Edit</a>

                                        <a href="#" onclick="deleteRole({{ $role->id }});" class="btn btn-danger">Delete</a>
                                        <form id="delete-role-form-{{ $role->id }}" action="{{ route('role.destroy', [$role->id]) }}" method="post" style="display: none;">
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
    function deleteRole(roleId,) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this role from the service?')) {
            document.getElementById('delete-role-form-' + roleId).submit();
        }
    }
</script>
</x-app-layout>>
