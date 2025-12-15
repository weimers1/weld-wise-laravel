<x-layout
    pageTitle="Subscribe"
>
    <div
        class="bg-ww-orange-gradient text-white py-5"
    >
        <div
            class="container text-center py-4"
        >
            <h1
                class="display-4 fw-bold mb-3"
            >Weld WISE Unlimited</h1>
            <p
                class="lead mb-4"
            >Unlock the full power of welding mastery</p>
            <div
                class="row justify-content-center"
            >
                <div
                    class="col-md-8"
                >
                    <p
                        class="fs-5 opacity-90"
                    >Join the professionals who've elevated their welding expertise with our comprehensive platform</p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="container py-5"
    >
        <div
            class="row justify-content-center"
        >
            <div
                class="col-lg-10"
            >
                <!-- Features Grid -->
                <div
                    class="row mb-5"
                >
                    <div
                        class="col-md-4 text-center text-white mb-4"
                    >
                        <i
                            class="bi bi-lightning-charge text-ww-orange-gradient"
                            style="font-size: 3rem;"
                        ></i>
                        <h5
                            class="mt-3 fw-bold"
                        >Unlimited Practice Tests</h5>
                        <p>Access our complete library of CWI exam simulations</p>
                    </div>
                    <div
                        class="col-md-4 text-center text-white mb-4"
                    >
                        <i
                            class="bi bi-graph-up-arrow text-ww-orange-gradient"
                            style="font-size: 3rem;"
                        ></i>
                        <h5
                            class="mt-3 fw-bold"
                        >Analytics Insights</h5>
                        <p>Track your progress with retrospective feedback</p>
                    </div>
                    <div
                        class="col-md-4 text-center text-white mb-4"
                    >
                        <i
                            class="bi bi-award text-ww-orange-gradient"
                            style="font-size: 3rem;"
                        ></i>
                        <h5
                            class="mt-3 fw-bold"
                        >Expert-Level Content</h5>
                        <p>Industry-validated questions and explanations</p>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div
                    class="row justify-content-center"
                >
                    <div
                        class="col-md-6"
                    >
                        <div
                            class="card card-premium"
                        >
                            <div
                                class="card-body text-center p-5"
                            >
                                <div
                                    class="mb-4"
                                >
                                    <h2
                                        class="fw-bold mb-2"
                                    >Unlimited Access</h2>
                                    <p
                                        class="text-muted"
                                    >Everything you need to ace your CWI exam</p>
                                </div>

                                <div
                                    class="mb-4"
                                >
                                    <div
                                        class="d-flex justify-content-center align-items-baseline"
                                    >
                                        <span
                                            class="display-4 fw-bold"
                                        >$29</span>
                                        <span
                                            class="text-muted ms-2"
                                        >/month</span>
                                    </div>
                                    <small
                                        class="text-muted"
                                    >Cancel anytime</small>
                                </div>

                                <ul
                                    class="list-unstyled mb-4"
                                >
                                    <li
                                        class="mb-2"
                                    ><i
                                            class="bi bi-check-circle-fill text-success me-2"
                                        ></i>Unlimited practice tests</li>
                                    <li
                                        class="mb-2"
                                    ><i
                                            class="bi bi-check-circle-fill text-success me-2"
                                        ></i>Detailed explanations</li>
                                    <li
                                        class="mb-2"
                                    ><i
                                            class="bi bi-check-circle-fill text-success me-2"
                                        ></i>Progress tracking</li>
                                    <li
                                        class="mb-2"
                                    ><i
                                            class="bi bi-check-circle-fill text-success me-2"
                                        ></i>Mobile access</li>
                                    <li
                                        class="mb-2"
                                    ><i
                                            class="bi bi-check-circle-fill text-success me-2"
                                        ></i>Priority support</li>
                                </ul>

                                <!-- Add your PayPal subscription button code here -->
                                <div
                                    id="paypal-button-container-P-9X757929G4151125HNE7YGOI"
                                ></div>
                                <script
                                    src="https://www.paypal.com/sdk/js?client-id=AeCRzW5Omj3a0gCY-Ih2fJE8G0bY7aOzyTMBleNCzT2AzDLufpjbsuRZjP95lrjbJe9tbaKYyflKv3mu&vault=true&intent=subscription"
                                    data-sdk-integration-source="button-factory"
                                ></script>
                                <script>
                                    paypal.Buttons({
                                        style: {
                                            shape: 'rect',
                                            color: 'blue',
                                            layout: 'vertical',
                                            label: 'subscribe'
                                        },
                                        createSubscription: function(data, actions) {
                                            return actions.subscription.create({
                                                /* Creates the subscription */
                                                plan_id: 'P-9X757929G4151125HNE7YGOI'
                                            });
                                        },
                                        onApprove: function(data, actions) {
                                            alert(data.subscriptionID); // You can add optional success message for the subscriber here
                                        }
                                    }).render('#paypal-button-container-P-9X757929G4151125HNE7YGOI'); // Renders the PayPal button
                                </script>

                                <div
                                    class="mt-4"
                                >
                                    <small
                                        class="text-muted"
                                    >🔧 Join today to become a welding professional</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div
                    class="row mt-5"
                >
                    <div
                        class="col-12 text-center"
                    >
                        <p
                            class="text-muted mb-3"
                        >Trusted by professionals</p>
                        <div
                            class="d-flex justify-content-center align-items-center flex-wrap gap-4"
                        >
                            <span
                                class="badge bg-light text-dark px-3 py-2"
                            >AWS Supported</span>
                            <span
                                class="badge bg-light text-dark px-3 py-2"
                            >Industry Leaders</span>
                            <span
                                class="badge bg-light text-dark px-3 py-2"
                            >CWI Approved</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
