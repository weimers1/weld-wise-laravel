<x-layout pageTitle="Take Test">
    <div class="container pt-3">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <strong>Time Remaining: <span id="timer">{{ $timeLimit }}:00</span></strong>
                    <p class="mb-0">Once you leave this page, your test will be marked as abandoned.</p>
                </div>
            </div>
        </div>

        <form action="/test/submit/{{ $testToken->token }}" method="POST" id="testForm">
            @csrf
            @foreach($questions as $index => $question)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Question {{ $index + 1 }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $question->description }}</p>
                        @foreach($question->answers as $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" 
                                       name="question_{{ $question->id }}" 
                                       value="{{ $answer->id }}" 
                                       id="answer_{{ $answer->id }}">
                                <label class="form-check-label" for="answer_{{ $answer->id }}">
                                    {{ $answer->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="row mb-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Submit Test</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Timer functionality
        let timeLimit = {{ $timeLimit * 60 }}; // Convert to seconds
        let timer = document.getElementById('timer');
        
        let countdown = setInterval(function() {
            let minutes = Math.floor(timeLimit / 60);
            let seconds = timeLimit % 60;
            
            timer.innerHTML = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            
            if (timeLimit <= 0) {
                clearInterval(countdown);
                // Auto-submit or mark as timed out
                fetch('/test/timeout/{{ $testToken->token }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(() => {
                    window.location.href = '/test';
                });
            }
            timeLimit--;
        }, 1000);

        // Warn user before leaving page
        window.addEventListener('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });
    </script>
</x-layout>