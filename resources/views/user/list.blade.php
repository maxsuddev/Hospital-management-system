<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users ') }}
        </h2>
    </x-slot>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('user.create') }}" class="btn btn-dark">Create</a>
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
                    <h3 class="text-white">User</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        @if ($users->isNotEmpty() )
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->roles !== null)
                                            @foreach($user->roles as $roleName)
                                                <label class="badge bg-primary mx-1">{{ $roleName->name }}</label>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-dark">Edit</a>

                                        <a href="#" onclick="deleteUser({{ $user->id }});" class="btn btn-danger">Delete</a>
                                        <form id="delete-user-form-{{ $user->id }}" action="{{ route('user.destroy', [$user->id]) }}" method="post" style="display: none;">
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
    function deleteUser(userId,) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this user from the service?')) {
            document.getElementById('delete-user-form-' + userId).submit();
        }
    }
</script>
</x-app-layout>>
