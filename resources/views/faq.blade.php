<?php
$faqs = [
    [
        'id' => 1,
        'question' => 'Question 1',
        'answer' => 'Answer 1',
    ],
    [
        'id' => 2,
        'question' => 'Question 2',
        'answer' => 'Answer 2',
    ],
    [
        'id' => 3,
        'question' => 'Question 3',
        'answer' => 'Answer 3',
    ],
];
?>
<x-layout
    pageTitle="FAQ"
>
    <x-navbar></x-navbar>

    <div
        class="container pt-3"
    >
        <div
            class="row"
        >
            <div
                class="col fs-4"
            >
                Frequently Asked Questions
            </div>
        </div>
        <div
            class="row"
        >
            <div
                className="col list-group"
            >
                @foreach ($faqs as $faq)
                    <div
                        className="list-group-item shadow"
                    >
                        <div
                            class="card mt-3"
                        >
                            <div
                                class="card-header collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#answer-{{ $faq['id'] }}"
                            >
                                {{ $faq['question'] }}
                            </div>
                            <div
                                class="card-body p-0"
                            >
                                <div
                                    class="collapse"
                                    id="answer-{{ $faq['id'] }}"
                                >
                                    <div
                                        class="p-3"
                                    >
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
