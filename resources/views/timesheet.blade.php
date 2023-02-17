@extends('app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<div class="container">
    <div class="row justify-content-center">
        <div class="container mt-4">
            <div class="container table-wrapper">
                <div class="card  shadow h-100 py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="text-xs font-weight-bold text-info text-uppercase m-1">
                                    <span>Department: </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h6 font-weight-bold text-gray-800 m-1">DSVN</div>
                            </div>
                            <div class="col-auto">
                                <div class="text-xs font-weight-bold text-info text-uppercase m-1">
                                    <span>Employee Type: </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h6  font-weight-bold text-gray-800 m-1">{{$user->role}}</div>
                            </div>
                            <div class="col-auto">
                                <div class="text-xs font-weight-bold text-info text-uppercase m-1">
                                    <span>Employee Name: </span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h6 font-weight-bold text-gray-800 m-1">{{ $user->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
            <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
