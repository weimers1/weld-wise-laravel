<x-layout pageTitle="Take Test">
    @if(isset($showModal))
        <x-modal id="testModal" title="{{ $showModal['title'] }}">
            {{ $showModal['message'] }}
        </x-modal>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('testModal'));
                modal.show();
                
                // Redirect to /test when modal is closed
                document.getElementById('testModal').addEventListener('hidden.bs.modal', function() {
                    window.location.href = '/test';
                });
            });
        </script>
    @else
        <div class="container pt-3">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        <strong>Time Remaining: <span id="timer">{{ $remainingMinutes }}:00</span></strong>
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

        <x-modal id="timeUpModal" title="Time Up!">
            Your test time has expired.
        </x-modal>

        <script>
            // Visual timer functionality
            let remainingMinutes = {{ $remainingMinutes }};
            let timeInSeconds = remainingMinutes * 60;
            let timer = document.getElementById('timer');
            
            let countdown = setInterval(function() {
                let minutes = Math.floor(timeInSeconds / 60);
                let seconds = timeInSeconds % 60;
                
                timer.innerHTML = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
                
                if (timeInSeconds <= 0) {
                    clearInterval(countdown);
                    // Show modal when time is up
                    var modal = new bootstrap.Modal(document.getElementById('timeUpModal'));
                    modal.show();
                    
                    // Redirect when modal is closed
                    document.getElementById('timeUpModal').addEventListener('hidden.bs.modal', function() {
                        window.location.href = '/test';
                    });
                }
                timeInSeconds--;
            }, 1000);

            // Warn user before leaving page
            window.addEventListener('beforeunload', function(e) {
                e.preventDefault();
                e.returnValue = '';
            });
        </script>
    @endif
</x-layout>