<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('order.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Create Order</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('order.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="first_name" class="form-label h5">Full Name</label>
                                <input value="{{ old('full_name') }}" type="text" class="@error('full_name') is-invalid @enderror form-control-lg form-control" placeholder="Full Name" name="full_name">
                                @error('first_name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label h5">Address</label>
                                <input value="{{ old('address') }}" type="text" class="@error('address') is-invalid @enderror form-control-lg form-control" placeholder="Address" name="address">
                                @error('address')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label h5">Phone</label>
                                <input value="{{ old('phone') }}" type="text" class="@error('phone') is-invalid @enderror form-control-lg form-control" placeholder="Phone" name="phone">
                                @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label h5">Age</label>
                                <input value="{{ old('age') }}" type="number" class="@error('age') is-invalid @enderror form-control-lg form-control" placeholder="Age" name="age">
                                @error('age')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-dark" onclick="addService()">Add Service</button>
                            </div>
                            <div id="services-container"></div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--    @dd($categories)--}}



    <script>
        let serviceIndex = 0;
        const categories = @json($categories);

        function addService() {
            serviceIndex++;
            const container = document.getElementById('services-container');

            const serviceElement = document.createElement('div');
            serviceElement.classList.add('mb-3', 'card', 'p-3', 'shadow-sm');
            serviceElement.innerHTML = `
        <div class="mb-3">
            <label for="category${serviceIndex}" class="form-label">Category</label>
            <select class="form-control form-control-lg" id="category${serviceIndex}" onchange="loadServices(${serviceIndex})">
                <option value="">Select Category</option>
                ${categories.map(category => `<option value="${category.id}">${category.name}</option>`).join('')}
            </select>
        </div>
        <div class="mb-3">
            <label for="service${serviceIndex}" class="form-label">Service</label>
            <select class="form-control form-control-lg" id="service${serviceIndex}" name="services[${serviceIndex}][id]" onchange="updatePrice(${serviceIndex})">
                <option value="">Select Service</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="person${serviceIndex}" class="form-label">Person</label>
            <select class="form-control form-control-lg" id="person${serviceIndex}" name="services[${serviceIndex}][person_id]">
                <option value="">Select Person</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity${serviceIndex}" class="form-label">Quantity</label>
            <input type="number" class="form-control form-control-lg" id="quantity${serviceIndex}" name="services[${serviceIndex}][quantity]" value="1" onchange="updatePrice(${serviceIndex})">
        </div>
        <div class="mb-3">
            <label for="price${serviceIndex}" class="form-label">Price</label>
            <input type="number" class="form-control form-control-lg" id="price${serviceIndex}" name="services[${serviceIndex}][price]" readonly>
        </div>
    `;
            container.appendChild(serviceElement);
        }

        function loadServices(index) {
            const categorySelect = document.getElementById(`category${index}`);
            const serviceSelect = document.getElementById(`service${index}`);
            const personSelect = document.getElementById(`person${index}`);
            const selectedCategory = categories.find(category => category.id == categorySelect.value);

            if (selectedCategory) {
                serviceSelect.innerHTML = `
            <option value="">Select Service</option>
            ${selectedCategory.services.map(service => `<option value="${service.id}" data-price="${service.price}">${service.name}</option>`).join('')}
        `;
                personSelect.innerHTML = `
            <option value="">Select Person</option>
            ${selectedCategory.persons.map(person => `<option value="${person.id}">${person.first_name} ${person.last_name}</option>`).join('')}
        `;
            } else {
                serviceSelect.innerHTML = `<option value="">Select Service</option>`;
                personSelect.innerHTML = `<option value="">Select Person</option>`;
            }
        }

        function updatePrice(index) {
            const serviceSelect = document.getElementById(`service${index}`);
            const quantityInput = document.getElementById(`quantity${index}`);
            const priceInput = document.getElementById(`price${index}`);
            const selectedService = serviceSelect.options[serviceSelect.selectedIndex];

            if (selectedService && quantityInput.value) {
                const price = selectedService.getAttribute('data-price') * quantityInput.value;
                priceInput.value = price;
            } else {
                priceInput.value = 0;
            }
        }
    </script>
</x-app-layout>
