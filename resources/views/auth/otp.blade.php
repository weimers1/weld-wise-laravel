<x-layout
    pageTitle="Verify Phone Number"
>
    <x-slot:includes>
        <link
            type="text/css"
            href="/css/login.css"
            rel="stylesheet"
        />
    </x-slot:includes>

    <div
        class="container"
    >
        <div
            class="row pt-4 justify-content-center"
        >
            <div
                class="col-lg-6 col-12"
            >
                <div
                    class="card p-4 shadow"
                >
                    <div
                        class="card-body"
                    >
                        <h5
                            class="card-title mb-4"
                        >Verify Your Phone Number</h5>
                        <p
                            class="mb-4"
                        >We've sent a verification code to {{ $phone }}. Please enter the code below.</p>
                        <form
                            method="POST"
                            action="/otp/verify"
                        >
                            @csrf
                            <input
                                type="hidden"
                                name="phone_id"
                                value="{{ $phone_id }}"
                            />
                            <label
                                for="otp-code"
                            >Verification Code</label>
                            <input
                                class="form-control"
                                id="otp-code"
                                name="otp_code"
                                type="text"
                                maxlength="6"
                                placeholder="Enter 6-digit code"
                                required
                            />
                            @if ($errors->has('otp_code'))
                                <div
                                    class="error"
                                >{{ $errors->first('otp_code') }}</div>
                            @endif
                            <button
                                class="btn btn-ww-orange mt-4"
                                type="submit"
                            >Verify Phone Number</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>