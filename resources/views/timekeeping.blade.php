@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Điểm danh') }}</div>



                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
                    <p>{{  now()->toDateTimeString() }}</p>
                    <a href="{{ route('sheettask') }}" class="btn btn-primary">Check In</a>
                   <button type="button" class="btn btn-success">checkout</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection