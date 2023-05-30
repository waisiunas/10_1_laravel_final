@extends('layout.main')

@section('title', 'Admin || Topics')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Topics</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.topic.create') }}" class="btn btn-outline-primary">Add Topic</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                @if (count($topics) > 0)
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Topic Name</th>
                                <th>Subject Name</th>
                                <th>Topic Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($topics as $topic)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $topic->name }}</td>
                                    <td>{{ $topic->subject->name }}</td>
                                    <td>{{ $topic->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.topic.edit', $topic) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.topic.delete', $topic) }}"
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
