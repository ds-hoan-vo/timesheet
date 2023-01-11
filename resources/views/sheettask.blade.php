@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="container mt-4">

                <p class="display-4 text-title">Timesheet</p>

                <div class="container table-wrapper">


                    <div class="card border-left-info shadow h-100 py-2 mb-4">
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
                                    <div class="h6  font-weight-bold text-gray-800 mb-1">Employee</div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <span>Employee Type:</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="h6 font-weight-bold text-gray-800 mb-1">Vo Ta Hoan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>


            <div class="table-responsive-lg">
                <table class="table table-sm table-striped text-center text-title">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Time In</th>
                            <th scope="col">Time Out</th>   
                            <th scope="col">show task</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Provide Documentation <span class="badge badge-pill tile-red">Project 1</span></td>
                            <td>-</td>
                            <td>2</td>
                            <td>5</td>
                            <td>3</td>
                            <td>8</td>
                            <td>1</td>
                            <td>-</td>
                            <td class="table-secondary font-weight-bold">19</td>
                        </tr>
                        <tr>
                            <td>Design app architecture <span class="badge badge-pill tile-purple">Project 2</span></td>
                            <td>-</td>
                            <td>4</td>
                            <td>0</td>
                            <td>3</td>
                            <td>0</td>
                            <td>5</td>
                            <td>-</td>
                            <td class="table-secondary font-weight-bold">12</td>
                        </tr>
                        <tr>
                            <td>Prepare integration tests <span class="badge badge-pill tile-blue">Project 3</span></td>
                            <td>-</td>
                            <td>2</td>
                            <td>3</td>
                            <td>2</td>
                            <td>0</td>
                            <td>2</td>
                            <td>-</td>
                            <td class="table-secondary font-weight-bold">9</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection