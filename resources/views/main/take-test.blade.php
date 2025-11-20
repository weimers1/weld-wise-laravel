<x-layout
    pageTitle="Take Test"
>
    @if (isset($showModal))
        <x-modal
            id="testModal"
            title="{{ $showModal['title'] }}"
        >
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
        <div
            class="container pt-3"
        >
            <div
                class="row"
            >
                <div
                    class="col-12"
                >
                    <div
                        class="alert alert-info"
                    >
                        <strong>Time Remaining:{{ ' ' }}
                            <span
                                id="timer"
                            >
                                Loading...
                            </span>
                        </strong>
                    </div>
                </div>
            </div>

            <form
                id="testForm"
                action="/test/submit/{{ $testToken->token }}"
                method="POST"
            >
                @csrf
                @foreach ($questions as $index => $question)
                    <div
                        class="card mb-4"
                    >
                        <div
                            class="card-header"
                        >
                            <h5>Question {{ $index + 1 }}</h5>
                        </div>
                        <div
                            class="card-body"
                        >
                            <p>{{ $question->description }}</p>
                            @foreach ($question->answers as $answer)
                                <div
                                    class="form-check"
                                >
                                    <input
                                        class="form-check-input"
                                        id="answer_{{ $answer->id }}"
                                        name="question_{{ $question->id }}"
                                        type="radio"
                                        value="{{ $answer->id }}"
                                    >
                                    <label
                                        class="form-check-label"
                                        for="answer_{{ $answer->id }}"
                                    >
                                        {{ $answer->description }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div
                    class="row mb-4"
                >
                    <div
                        class="col-12"
                    >
                        <button
                            class="btn btn-success shadow mx-2"
                            type="submit"
                        >Submit Test</button>
                    </div>
                </div>
            </form>
        </div>

        <x-modal
            id="timeUpModal"
            title="Time Up!"
        >
            Your test time has expired.
        </x-modal>

        <script>
            // Visual timer functionality
            let remainingMinutes = {{ $remainingMinutes }};
            let timeInSeconds = Math.floor(remainingMinutes * 60);
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

            // Update timer on page revisit
            window.addEventListener('pageshow', function(event) {
                fetch('/test/time/{{ $testToken->token }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.expired) {
                            clearInterval(countdown);
                            var modal = new bootstrap.Modal(document.getElementById('timeUpModal'));
                            modal.show();
                        } else {
                            // Update timer with fresh data
                            remainingMinutes = data.remainingMinutes;
                            timeInSeconds = Math.floor(remainingMinutes * 60);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            });
        </script>
    @endif
</x-layout>
