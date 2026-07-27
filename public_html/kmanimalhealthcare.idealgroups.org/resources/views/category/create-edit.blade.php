<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card p-5">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">User Management</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('users.index') }}" class="btn btn-dark btn-primary">
                                        User List
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif



                                @if ($page_data['form_title'] == 'Add New User')
                                    <form action="{{ route('app-user-store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                    @else
                                        <form action="{{ route('app-user-update', encrypt($user->id)) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                @endif





                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') ?? ($user != '' ? $user->name : '') }}">
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') ?? ($user != '' ? $user->email : '') }}">
                                        <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="email" class="form-label">Mobile No</label>
                                        <input type="number" class="form-control" id="mobile" name="mobile"
                                            value="{{ old('mobile') ?? ($user != '' ? $user->phone : '') }}">
                                        <span class="text-danger">
                                            @error('mobile')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="status"
                                                name="status"
                                                {{ $user != '' && $user->status == 'on' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Active</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        <label for="is_admin" class="form-label">Is Admin</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_admin"
                                                name="is_admin"
                                                {{ $user != '' && $user->is_admin == 'on' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_admin">Yes</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') ?? ($user != '' ? $user->address : '') }}</textarea>
                                        <span class="text-danger">
                                            @error('address')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="col-dm-6 text-end">

                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>

<script>
    function deleteConfirm(event) {
        event.preventDefault(); // Prevent the default link behavior
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms, proceed with deletion by navigating to the route
                var url = event.target.href;
                window.location.href = url;
            }
        });
    }
</script>
