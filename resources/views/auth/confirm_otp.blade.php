@extends('app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4">
                <div class="container table-wrapper">

                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="position-relative">
                            <div class="card p-2 text-center">
                                <h6>Please enter the one time password <br> to verify your account</h6>
                                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                    <input class="m-2 text-center form-control rounded" type="text" id="first"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="second"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="third"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fourth"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fifth"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="sixth"
                                        maxlength="1" />
                                </div>
                                <form action="{{ route('confirm.otp.action') }}" method="POST">
                                    @csrf
                                    <input id="otpnumber" class="form-control" type="text" name="otp" hidden />

                                    <input class="form-control" type="text" name="token" hidden
                                        value="{{ $token }}" />
                                    <div class="mt-4"> <button id="validate"
                                            class="btn btn-danger px-4 validate">Validate</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {

                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("validate").addEventListener("click", function() {
                var first = document.getElementById("first").value;
                var second = document.getElementById("second").value;
                var third = document.getElementById("third").value;
                var fourth = document.getElementById("fourth").value;
                var fifth = document.getElementById("fifth").value;
                var sixth = document.getElementById("sixth").value;
                var otp = first + second + third + fourth + fifth + sixth;
                document.getElementById("otpnumber").value = otp;
            });
        });
    </script>
@endsection
