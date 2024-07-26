<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add ') }}
        </h2>
    </x-slot>
<div class="bg-dark py-3">
    <h3 class="text-white text-center">Role: {{ $role->name }}</h3>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('role.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Edit role</h3>
                </div>
                <form  action="{{ url('/role'.$role->id.'/give-permission') }}" method="post">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Permissions</label>

                          <div class="row" >
                              @foreach($permissions as $permission)
                                  <div class="col-md-3" >
                                      <label>
                                          <input type="checkbox"
                                                 name="permissions[]"
                                                 value="{{ $permission->name }}"
                                                 {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                                  class="from-controller"/>
                                          {{ $permission->name }}
                                      </label>
                                  </div>
                              @endforeach
                          </div>
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

