@extends('app')
@section('content')
<div class="container">
    @if (session('msg'))
    {{ session('msg') }}
    @endif
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
        </div>
        <div class="row">
            <select class="col form-select ">
                <option selected>January 2023 </option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="col m-2" id="displayDateTime">Month</div>
            <button class="col btn btn-link" onclick="previousMonth();"> Prev Month</button>
            <button class="col btn btn-link" onclick="thisMonth();"> This Month </button>
            <button class="col btn btn-link" onclick="nextMonth();"> Next Month </button>
        </div>
        @php($monthYear = now()->format('m-Y'))
        <div class=" mt-4 table-responsive-lg">
            <table id="table-sheet" class="table table-sm table-bordered text-center">
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
                    @for ($i = 1; $i <= now()->month($monthYear)->daysInMonth; $i++)
                        @if (date('D', strtotime($i . '-' . $monthYear)) == 'Sun')
                        <tr class="table-danger">
                            @elseif (date('D', strtotime($i . '-' . $monthYear)) == 'Sat')
                        <tr class="table-info">
                            @else
                        <tr>
                            @endif
                            <td>{{ date('D', strtotime($i . '-' . $monthYear)) }}</td>
                            <td class="date">{{ date('Y-m-d', strtotime($i . '-' . $monthYear)) }}</td>
                            @if (count($sheets) == 0)
                            <td class="check_in"></td>
                            <td class="check-out"></td>
                            <td class="status"></td>
                            <td class="difficult"></td>
                            <td class="plan"></td>
                            <td><a type="button" class="btn btn-link create_task" data-toggle="modal" data-target="#create-task"><i class="fa fa-plus-circle"></i></a></td>

                            @endif
                            @foreach ($sheets as $item)
                            @if (date('Y-m-d', strtotime($i . '-' . $monthYear)) == $item->date)
                            <td class="id" style="display: none;">{{ $item->id }}</td>
                            <td class="check_in">{{ $item->check_in }}</td>
                            <td class="check-out">{{ $item->check_out }}</td>
                            <td class="status">{{ $item->status }}</td>
                            <td class="difficult">{{ $item->difficult }}</td>
                            <td class="plan">{{ $item->plan }}</td>
                            <td><a type="button" class="btn btn-link edit_task" data-toggle="modal" data-target="#edit_task{{$item->id}}"><i class="fa fa-edit"></i></a></td>
                            @break
                            @elseif ($loop->last)
                            <td class="check-in"></td>
                            <td class="check-out"></td>
                            <td class="status"></td>
                            <td class="difficult"></td>
                            <td class="plan"></td>
                            <td><a type="button" class="btn btn-link create_task" data-toggle="modal" data-target="#create-task"><i class="fa fa-plus-circle"></i></a></td>

                            @endif
                            @endforeach

                        </tr>
                        @endfor
                </tbody>
            </table>

        </div>
    </div>
    <!-- Button trigger modal -->



    <!-- CREATE Modal -->
    <div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create TimeSheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form action="{{ route('sheettask.create') }}" method="post">
                        @csrf
                        <div class="row" mb-2>
                            <div class="col">
                                <span>Date:</span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="date" id="c-date" readonly>
                            </div>
                        </div>
                        <div class="row" mb-2>
                            <div class="col">
                                <span>Time In</span>
                            </div>
                            <div class="col">
                                <span>Time Out</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control" name="checkin" id="c-checkin">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="checkout" id="c-checkout">
                            </div>
                        </div>
                        <span>Difficultie</span>
                        <input type="text" class="form-control mb-2" placeholder="difficutltie" name="difficult" id="c-difficult">
                        <span>Plan</span>
                        <input type="text" class="form-control mb-2" placeholder="plan" name="plan" id="c-plan">
                        <span>Status</span>
                        <input type="text" class="form-control mb-2" placeholder="status" name="status" id="c-status">
                        <div class="row mb-4">
                            <div class="col">
                                <button type="button" class="btn btn-light" data-toggle="collapse" data-target="#demo">Task</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-primary">+New</button>
                            </div>
                        </div>
                        <div id="demo" class="collapse">
                            <div class="card shadow py-2 mb-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase px-4">
                                    <span>Task 1</span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">Task1 naiyou</div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-secondary">edit</button>
                                            <button type="button" class="btn btn-danger">remove</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($sheets as $item)
    <!-- Modal -->
    <div class="modal fade" id="edit_task{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit TimeSheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <form action="{{ url('sheettask/' .$item->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row" mb-2>
                            <div class="col">
                                <span>Date:</span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="date" value="{{$item->date}}" readonly>
                            </div>
                        </div>
                        <div class="row" mb-2>
                            <div class="col">
                                <span>Time In</span>
                            </div>
                            <div class="col">
                                <span>Time Out</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control" name="checkin" value="{{$item->check_in}}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="checkout" value="{{$item->check_out}}">
                            </div>
                        </div>
                        <span>Difficultie</span>
                        <input type="text" class="form-control mb-2" placeholder="difficutltie" name="difficult" value="{{$item->difficult}}">
                        <span>Plan</span>
                        <input type="text" class="form-control mb-2" placeholder="plan" name="plan" value="{{$item->plan}}">
                        <span>Status</span>
                        <input type="text" class="form-control mb-2" placeholder="status" name="status" value="{{$item->status}}">

                        <div class="row mb-2">
                            <div class="col-auto">
                                <button type="button" class="btn btn-light">Task</button>
                            </div>
                            <input id="task-content{{$item->id}}" type="text" class="form-control mb-2 mr-2 col" placeholder="Task Content">
                            <div class="col-auto">
                                <button type="button" class="btn btn-primary" onclick="addNewTask( {!! $item->id !!} );">+New</button>
                            </div>
                        </div>

                        <div id="task-list{{$item->id}}">
                        </div>
                        @foreach ($item->tasks as $task)
                        <div class="card shadow mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control-plaintext border-0" placeholder="phone" name="phone" value="{{ $task->content }}">
                                    </div>

                                    <div class="col-auto">
                                        <button type="button" class="btn btn-danger">remove</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    function addNewTask(id) {
        var taskContent = document.getElementById('task-content' + id).value;
        var taskList = document.getElementById('task-list' + id);
        if (taskContent == '') {
            alert('Please enter task content');
            return;
        } else {
            var task = document.createElement('div');
            task.className = 'card shadow mb-2';
            task.innerHTML = `
            <div class="card-body">
                <div class="row">
                    <div class="col">
                    <input type="text" class="form-control-plaintext border-0" placeholder="phone" name="phone" value="` +
                        taskContent + `">
                    </div> 
                    <div class = "col-auto" >
                        <button type = "button" class = "btn btn-danger" > remove </button>
                    </div> 
                </div> 
            </div>`;
            taskList.appendChild(task);
            document.getElementById('task-content' + id).value = '';
        }
    }
</script>



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

<script>
    $(document).ready(function() {

        //create-task
        $('.create_task').click(function() {
            var checkin = $(this).closest('tr').find('.check_in').text();
            $('#c-checkin').val(checkin);
            var checkout = $(this).closest('tr').find('.check-out').text();
            $('#c-checkout').val(checkout);
            var date = $(this).closest('tr').find('.date').text();
            $('#c-date').val(date);
            var status = $(this).closest('tr').find('.status').text();
            $('#c-status').val(status);
            var difficult = $(this).closest('tr').find('.difficult').text();
            $('#c-difficult').val(difficult);
            var plan = $(this).closest('tr').find('.plan').text();
            $('#c-plan').val(plan);

        });

    });
</script>
<script>
    //get month
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
    document.getElementById("displayDateTime").innerHTML = month;

    // next month js
    function nextMonth() {
        d.setMonth(convertMonth() + 1);
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
        $monthYear = getMonth();
        console.log(' {!! $monthYear !!} ');
    }
    // previous month js
    function previousMonth() {
        d.setMonth(convertMonth() - 1);
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
    }
    // this month js
    function thisMonth() {
        var d = new Date();
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
    }

    function convertMonth() {
        var month = document.getElementById("displayDateTime").innerHTML;
        var month = month.split(' ');
        var month = month[0];
        var month = months.indexOf(month);
        return month;
    }

    function getMonth() {
        var month = document.getElementById("displayDateTime").innerHTML;
        var month = month.split('-');
        var month = month[0];
        return month;
    }
</script>
@endsection