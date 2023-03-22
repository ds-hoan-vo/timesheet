@extends('app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4">
                <div class="container table-wrapper">

                    <div class="row">
                        <div class="col-md-6">
                            <h2>Login</h2>
                            @if ($errors->any())
                                @foreach ($errors->all() as $err)
                                    <p class="alert alert-danger">{{ $err }}</p>
                                @endforeach
                            @endif
                            <form action="{{ route('login.action') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="username" name="username"
                                        value="{{ old('username') }}" />
                                </div>
                                <div class="mb-3">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" />
                                </div>                               
                                <div class="mb-3">
                                    <a href="{{ route('forgot.password') }}">Forgot Password?</a>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Login</button>
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
