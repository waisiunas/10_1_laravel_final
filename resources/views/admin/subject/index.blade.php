@extends('layout.main')

@section('title', 'Admin || Subjects')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Subjects</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.subject.create') }}" class="btn btn-outline-primary">Add Subject</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                @if (count($subjects) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Subject Name</th>
                                <th>Subject Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.subject.edit', $subject) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.subject.delete', $subject) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger m-0">No record found!</div>
                @endif
            </div>
        </div>
    </div>
@endsection
