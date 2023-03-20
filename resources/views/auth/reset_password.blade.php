@extends('app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4">
                <div class="container table-wrapper">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Reset Password</h2>
                            reset password for {{ $email }}
                            
                          
                            <form action="{{ route('reset.password.action') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" />
                                </div>
                                <div class="mb-3">
                                    <label>Password Confirmation<span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password_confirm" />
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Reset Password</button>
                                    <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
