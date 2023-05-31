@extends('layout.main')

@section('title', 'Admin || Questions')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Questions</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.question.create') }}" class="btn btn-outline-primary">Add Question</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                @if (count($questions) > 0)
                    @foreach ($questions as $question)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h5>{{ $loop->iteration }}. {{ $question->text }}</h5>
                                        <ul>
                                            @foreach ($question->choices as $choice)
                                                @if ($choice->is_correct == 1)
                                                    <li>{{ $choice->text }} (Correct)</li>
                                                @else
                                                    <li>{{ $choice->text }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('admin.question.edit', $question) }}" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger m-0">No record found!</div>
                @endif
            </div>
        </div>
    </div>
@endsection
