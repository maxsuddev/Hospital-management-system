<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CashBox') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end gap-3">
                <!-- Inkassa tugmasi -->
                <a href="{{ route('cost') }}" class="btn btn-success">Pull olish</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">CashBox</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sum</th>
                                <th>Total money</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cashBoxes as $cashBox)
                                <tr>
                                    <td>{{ $cashBox->id }}</td>
                                    <td>{{ $cashBox->sum }}</td>
                                    <td>{{ $cashBox->remains }} sum</td>
                                    <td>
                                        <a href="#" onclick="inkassa({{ $cashBox->id }});" class="btn btn-danger">Inkassa</a>
                                        <form id="delete-inkassa-form-{{ $cashBox->id }}" action="{{ route('cashbox.inkassa', $cashBox->id) }}" method="post" style="display:none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function inkassa(id) {
            if (confirm("Are you sure for inkassa ")) {
                document.getElementById("delete-inkassa-form-" + id).submit();
            }
        }
    </script>
</x-app-layout>
