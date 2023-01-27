@extends('app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-4">
                <div class="container table-wrapper">
                    <div class="card  shadow h-100 py-2 mb-4">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span>Department:</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800 mb-1">DSVN</div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span>Employee Type:</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h6  font-weight-bold text-gray-800 mb-1">{{ $user->role }}</div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span>Employee Name:</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800 mb-1">{{ $user->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <select class="col form-select ">
                    <option selected>January 2023 </option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <button type="button" class="col btn btn-link">Previous Month</button>
                <button type="button" class=" col btn btn-link">This Month</button>
                <button type="button" class="col btn btn-link">Next Month</button>
            </div>

            <div class=" mt-4 table-responsive-lg">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Date</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Status</th>
                            <th scope="col">Difficultie</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= now()->month($month)->daysInMonth; $i++)
                            @if (date('D', strtotime($i . '-' . $month)) == 'Sun')
                                <tr class="table-danger">
                                @elseif (date('D', strtotime($i . '-' . $month)) == 'Sat')
                                <tr class="table-info">
                                @else
                                <tr>
                            @endif
                            <td>{{ date('D', strtotime($i . '-' . $month)) }}</td>
                            <td>{{ date('Y-m-d', strtotime($i . '-' . $month)) }}</td>
                            @if (count($sheet) == 0)
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            @foreach ($sheet as $item)
                                @if (date('Y-m-d', strtotime($i . '-' . $month)) == $item->date)
                                    <td>{{ $item->check_in }}</td>
                                    <td>{{ $item->check_out }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->difficultie }}</td>
                                    <td>{{ $item->plan }}</td>
                                @break
                            @elseif ($loop->last)
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        @endforeach
                        <td><button type="button" class="btn btn-link" data-toggle="modal"
                                data-target="#exampleModalCenter"><i class="fa fa-edit"></i></button></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
