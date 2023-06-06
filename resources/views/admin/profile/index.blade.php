@extends('layout.main')

@section('title', 'Admin || Template')

@section('content')
    <div class="container-fluid p-0">

        <h1>Update Profile</h1>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                <form action="{{ route('admin.profile.details') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Enter the name!" value="{{ old('name') ?? Auth::user()->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Enter the email!" value="{{ old('email') ?? Auth::user()->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="Update Details" class="btn btn-primary">
                    </div>
                </form>

                <form action="{{ route('admin.profile.picture') }}" method="POST" enctype="multipart/form-data"
                    class="my-3">
                    @csrf
                    <div class="mb-3">
                        <label for="picture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="picture" id="picture">
                        @error('picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" value="Update Picture" class="btn btn-primary">
                    </div>
                </form>

                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password"
                                    placeholder="Enter the current password!" value="{{ old('current_password') }}">
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter the new password!" value="{{ old('password') }}">
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirm your password!"
                                    value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="Update Password" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
