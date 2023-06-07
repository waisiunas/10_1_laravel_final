@extends('layout.main')

@section('title', 'Admin || Edit Question')

@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col">
                <h1>Edit Question</h1>
            </div>
            <div class="col text-end">
                <a href="{{ route('admin.questions') }}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @include('partials.flash-messages')
                <form action="{{ route('admin.question.edit', $question) }}" method="POST">
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
                                    @if ($subject->id == $question->topic->subject_id)
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
                        <label for="topic_id" class="form-label">Topic</label>
                        <select name="topic_id" id="topic_id" class="form-select @error('topic_id') is-invalid @enderror">
                            <option value="" selected hidden>Select a topic!</option>
                            @if (old('subject_id') || old('topic_id'))
                                <option value="" selected hidden>Select a topic!</option>
                                @if (old('subject_id') && old('topic_id'))
                                    @foreach ($topics as $topic)
                                        @if ($topic->subject_id == old('subject_id'))
                                            @if ($topic->id == old('topic_id'))
                                                <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                                            @else
                                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($topics as $topic)
                                        @if ($topic->subject_id == old('subject_id'))
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            @else
                                @foreach ($topics as $topic)
                                    @if ($topic->subject_id == $question->topic->subject_id)
                                        @if ($topic->id == $question->topic_id)
                                            <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                                        @else
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @error('topic_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="text" class="form-label">Question Text</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text"
                            placeholder="Enter the question text!" cols="30" rows="3">{{ old('text') ?? $question->text }}</textarea>
                        @error('text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach ($question->choices as $choice)
                        @if ($choice->is_correct == 1)
                            @php
                                $correct_choice = $loop->iteration;
                            @endphp
                        @endif
                        <div class="mb-3">
                            <label for="choice_{{ $loop->iteration }}" class="form-label">Choice
                                #{{ $loop->iteration }}</label>
                            <input type="text"
                                class="form-control @error('choice_' . $loop->iteration) is-invalid @enderror"
                                name="choice_{{ $loop->iteration }}" id="choice_{{ $loop->iteration }}"
                                placeholder="Enter the choice {{ $loop->iteration }}!"
                                value="{{ old('choice_' . $loop->iteration) ?? $choice->text }}">
                            @error('choice_' . $loop->iteration)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <label for="correct_choice" class="form-label">Correct Choice</label>
                        <input type="text" class="form-control @error('correct_choice') is-invalid @enderror"
                            name="correct_choice" id="correct_choice" placeholder="Enter the correct choice!"
                            value="{{ old('correct_choice') ?? $correct_choice }}">
                        @error('correct_choice')
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

    <script>
        const subjectElement = document.getElementById('subject_id');
        const topicElement = document.getElementById('topic_id');

        subjectElement.addEventListener('change', function() {
            let subjectId = subjectElement.value;
            let token = document.querySelector('input[name="_token"]').value;

            data = {
                subject_id: subjectId,
                _token: token,
            };

            fetch("{{ route('admin.subject.topics') }}", {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(result) {
                    // console.log(result);
                    topicElement.innerHTML = result;
                });
        })
    </script>
@endsection
