@extends('layout.main')

@section('title', 'Admin || Edit Topic')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Edit Topic</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.topics') }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                <form action="{{ route('admin.topic.edit', $topic) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id"
                            class="form-select @error('subject_id') is-invalid @enderror">
                            <option value="" selected hidden>Select a subject!</option>
                            @foreach ($subjects as $subject)
                                @if (!empty(old('subject_id')))
                                    @if ($subject->id == old('subject_id'))
                                        <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
                                    @else
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endif
                                @else
                                    @if ($subject->id == $topic->subject_id)
                                        <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
                                    @else
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Topic Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Enter the topic name!" value="{{ old('name') ?? $topic->name }}">
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
