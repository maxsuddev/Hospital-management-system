<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Doctors') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('doctor.create') }}" class="btn btn-dark">Create</a>
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
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Doctors</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Birthday</th>
                                <th>Balance</th>
                                <th>Categories</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    <td>{{ $doctor->first_name }}</td>
                                    <td>{{ $doctor->last_name }}</td>
                                    <td>{{ $doctor->phone }}</td>
                                    <td>{{ $doctor->birthday }}</td>
                                    <td>{{ $doctor->balance }}</td>
                                    <td>
                                        @foreach ($doctor->categories as $category)
                                            {{ $category->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('doctor.edit', $doctor->id) }}" class="btn btn-dark">Edit</a>
                                        <button class="btn btn-primary" onclick="showWithdrawModal({{ $doctor->id }})">Pul olish</button>
                                        <a href="#" onclick="deleteDoctor({{ $doctor->id }});" class="btn btn-danger">Delete</a>
                                        <form id="delete-doctor-form-{{ $doctor->id }}" action="{{ route('doctor.destroy', $doctor->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Doctors found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="withdraw-form" action="{{ route('doctor.withdraw', ['id']) }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="amount" id="withdraw-amount">
    </form>

    <script>
        function deleteDoctor(doctorId) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this doctor?')) {
                document.getElementById('delete-doctor-form-' + doctorId).submit();
            }
        }

        function showWithdrawModal(doctorId) {
            const amount = prompt('Qancha pul yechishni xohlaysiz:');
            if (amount !== null && amount !== '') {
                const form = document.getElementById('withdraw-form');
                form.action = `/doctor/${doctorId}/withdraw`;
                document.getElementById('withdraw-amount').value = amount;
                form.submit();
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</x-app-layout>
