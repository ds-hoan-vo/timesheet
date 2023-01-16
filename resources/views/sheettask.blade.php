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
            <table class="table table-sm table-bordered  text-center text-title">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time In</th>
                        <th scope="col">Time Out</th>
                        <th scope="col">show task</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <!-- <?php

                    use Carbon\Carbon;

                    $newDay = new Carbon('first day of January 2022');
                    $days = $newDay->daysInMonth;
                    for ($i = 0; $i < $days; $i++) {
                        if ($newDay->format('l') == 'Saturday') echo "<tr class = \"table-info \">";
                        elseif ($newDay->format('l') == 'Sunday') echo "<tr class = \"table-danger \">";
                        else
                            echo "<tr>";
                        echo "<td>" . $newDay->format('D') . "</td>";
                        echo "<td>" . $newDay->format('Y-m-d') . "</td>";
                        $newDay->addDay(1);
                        echo "<td>-</td>";
                        echo  "<td>time in</td>";
                        echo "<td>time out</td>";
                        echo "<td> <button type=\"button\" class=\"btn btn-primary\"><i class=\"far fa-eye\"> </i> </button>  </td>";
                        echo  "</tr>";
                    }
                    ?> -->
                


                </tbody>
            </table>

        </div>

    </div>
</div>
@endsection