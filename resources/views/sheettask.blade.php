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
                                <div class="h6  font-weight-bold text-gray-800 mb-1">{{$user->role}}</div>
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
            <button class="col btn btn-link" onclick=""> Prev Month</button>
            <button class="col btn btn-link"> This Month </button>
            <button class="col btn btn-link"> Next Month </button>


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

                            <td><a type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-edit"></i></a></td>
                        </tr>
                        @endfor
                </tbody>
            </table>

        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">TimeSheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form action="#sheettask/" method="patch">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="time in" name="checkin" id="checkin">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="time out" name="checkout" id="checkout">
                            </div>
                        </div>
                        <input type="text" class="form-control mb-2" placeholder="difficutltie" name="" id="">
                        <input type="text" class="form-control mb-2" placeholder="plan" name="" id="">
                        <input type="text" class="form-control mb-2" placeholder="status" name="" id="">
                        <div class="row mb-4">
                            <div class="col">
                                <button type="button" class="btn btn-light" data-toggle="collapse" data-target="#demo">Task</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary">+New</button>
                            </div>
                        </div>
                        <div id="demo" class="collapse">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>
@endsection