@extends('layout.main')

@section('title', 'Admin || Edit Subject')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Edit Subject</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.subjects') }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                <form action="{{ route('admin.subject.edit', $subject) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Enter the subject name!" value="{{ old('name') ?? $subject->name }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
