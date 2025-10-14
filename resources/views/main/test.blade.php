<x-layout
    pageTitle="Tests"
>

    <div
        class="container pt-3"
    >
        <h2
            class="text-white my-4"
        >
            Tests
        </h2>
        <div
            class="row text-black"
        >
            <div
                class="col-12 col-lg-3 d-flex justify-content-center align-items-center flex-column"
            >
                <div
                    class="p-4 m-4 w-75 border rounded h-px-150 lg:h-px-220 position-relative bg-light-grey shadow"
                >
                    <h3
                        class="text-center"
                    >
                        Total Attempts
                    </h3>
                    <div
                        class="text-center fs-4 position-absolute bottom-0 start-50 translate-middle-x mb-4"
                    >
                        5
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-lg-3 d-flex justify-content-center align-items-center flex-column"
            >
                <div
                    class="p-4 m-4 w-75 border rounded h-px-150 lg:h-px-220 position-relative bg-light-grey shadow"
                >
                    <h3
                        class="text-center"
                    >
                        Total Passed
                    </h3>
                    <div
                        class="text-center fs-4 position-absolute bottom-0 start-50 translate-middle-x mb-4"
                    >
                        5
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-lg-3 d-flex justify-content-center align-items-center flex-column"
            >
                <div
                    class="p-4 m-4 w-75 border rounded h-px-150 lg:h-px-220 position-relative bg-light-grey shadow"
                >
                    <h3
                        class="text-center"
                    >
                        Average Overall Score
                    </h3>
                    <div
                        class="text-center fs-4 position-absolute bottom-0 start-50 translate-middle-x mb-4"
                    >
                        5
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-lg-3 d-flex justify-content-center align-items-center flex-column"
            >
                <div
                    class="p-4 m-4 w-75 border rounded h-px-150 lg:h-px-220 position-relative bg-light-grey shadow"
                >
                    <h3
                        class="text-center"
                    >
                        Average Score (Last 5 Exams)
                    </h3>
                    <div
                        class="text-center fs-4 position-absolute bottom-0 start-50 translate-middle-x mb-4"
                    >
                        5
                    </div>
                </div>
            </div>
        </div>
        <div
            class="row my-4"
        >
            <div
                class="col-12"
            >
                <div
                    class="alert alert-warning p-4"
                    role="alert"
                >
                    <p>
                        All tests will have a 1 hour time limit that begins when you click the
                        <span
                            class="btn btn-ww-orange shadow mx-2"
                            type="submit"
                        >
                            <i
                                class="bi-file-text"
                            ></i> Attempt Test
                        </span> button. Please make sure you are prepared to take the exam before clicking this button.
                    </p>
                    <p
                        class="mt-2"
                    >
                    <ul>
                        <li>You are allowed to use a sheet of paper and pen or pencil, and a calculator.</li>
                        <li>You are <b>not</b> allowed to use any other resources.</li>
                        <li>If you leave the page before you have submitted your test, your score for that test will be
                            counted as 0% and will expend one of your attempts.</li>
                        <li>Please make sure you have a stable internet connection before attempting the test.</li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
        @if(session('error'))
            <div class="row my-4">
                <div class="col-12">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif
        
        <div
            class="row my-4"
        >
            <div
                class="col col-sm-2 ms-lg-3 d-flex justify-content-center align-items-center"
            >
                <form
                    action="/test/create"
                    method="POST"
                >
                    @csrf
                    <button
                        class="btn btn-ww-orange shadow"
                        type="submit"
                    >
                        <i
                            class="bi-file-text"
                        ></i> Attempt Test
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-layout>
