@extends('app')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@section('content')
    <div class="container">
        @if (session('msg'))
            {{ session('msg') }}
        @endif
        <div class="row justify-content-center">
            <div class="container mt-4">
                <div class="container table-wrapper">
                    <div class="card shadow py-2 mb-4">
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
                                    <div class="h6  font-weight-bold text-gray-800 m-1">{{ $user->role }}</div>
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
                    <br>
                    <table id="time-sheet" class="table table-sm table-bordered text-center align-middle">

                    </table>


                </div>

            </div>

        </div>
    </div>
    <!-- Button trigger modal -->



    <!-- CREATE Modal -->
    <div class="modal fade" id="create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create TimeSheet</h5>
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

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
                            <input type="text" class="form-control" name="check_in" id="c-checkin">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="check_out" id="c-checkout">
                        </div>

                    </div>
                    <span>Difficultie</span>
                    <input type="text" class="form-control mb-2" placeholder="difficutltie" name="difficult"
                        id="c-difficult">
                    <span>Plan</span>
                    <input type="text" class="form-control mb-2" placeholder="plan" name="plan" id="c-plan">
                    <span>Status</span>
                    <input type="text" class="form-control mb-2" placeholder="status" name="status" id="c-status">
                
                    <div class="modal-footer">
                        <button onclick="createSheetTask();" type="submit" class="btn btn-primary">Save changes</button>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @foreach ($sheets as $item)
        <!-- Modal -->
        <div class="modal fade" id="edit_task{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit TimeSheet</h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form action="{{ url('sheettask/' . $item->id) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row" mb-2>
                                <div class="col">
                                    <span>Date:</span>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="date"
                                        value="{{ $item->date }}" readonly>
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
                                    <input type="text" class="form-control" name="check_in"
                                        value="{{ $item->check_in }}">
                                </div>


                                <div class="col">
                                    <input type="text" class="form-control" name="check_out"
                                        value="{{ $item->check_out }}">
                                </div>
                            </div>
                            <span>Difficultie</span>
                            <input type="text" class="form-control mb-2" placeholder="difficutltie" name="difficult"
                                value="{{ $item->difficult }}">
                            <span>Plan</span>
                            <input type="text" class="form-control mb-2" placeholder="plan" name="plan"
                                value="{{ $item->plan }}">
                            <span>Status</span>
                            <input type="text" class="form-control mb-2" placeholder="status" name="status"
                                value="{{ $item->status }}">

                            <div class="row mb-2">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-light">Task</button>
                                </div>
                                <input id="task-content{{ $item->id }}" type="text"
                                    class="form-control mb-2 mr-2 col" placeholder="Task Content">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-primary"
                                        onclick="addNewTask( {!! $item->id !!} );">+New</button>
                                </div>
                            </div>

                            <div id="task-list{{ $item->id }}">
                                @foreach ($item->tasks as $task)
                                    <div class="card shadow mb-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext border-0"
                                                        placeholder="content" name="tasks[{{ $loop->index }}][content]"
                                                        value="{{ $task->content }}">
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control-plaintext border-0"
                                                        placeholder="status" name="tasks[{{ $loop->index }}][status]"
                                                        value="{{ $task->status }}">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-danger delete">remove</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
@endsection

<script>
   
    function addNewTask(id) {

        var taskContent = document.getElementById('task-content' + id).value;
        var taskList = document.getElementById('task-list' + id);
        var taskCount = taskList.childElementCount;
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
                <input type="text" class="form-control-plaintext border-0" name="tasks[` + taskCount +
                `][content]" value="` +
                taskContent + `">
                </div> 
                <div class="col">
                <input type="text" class="form-control-plaintext border-0" name="tasks[` + taskCount +
                `][status]" value="` +
                `pending ` + `">
                </div>
                <div class = "col-auto" >
                <button type="button" class="btn btn-danger delete">remove</button>
                </div> 
            </div> 
        </div>`;
            taskList.appendChild(task);
            document.getElementById('task-content' + id).value = '';
        }
    }

    //remove task in modal 
    $(document).on('click', '.delete', function() {
        $(this).closest('.card').remove();
    });

    //reload page when close modal
    $(document).ready(function() {
        $('.modal').on('hidden.bs.modal', function() {
            location.reload();
        });
    });
</script>


<script>
    //get month
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
        "November", "December"
    ];
    var d = new Date();
    var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
    $(document).ready(function() {
        document.getElementById("displayDateTime").innerHTML = month;
        drawTimeSheet();
    });

    // next month js
    function nextMonth() {
        d.setMonth(convertMonth() + 1);
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
        drawTimeSheet();
    }
    // previous month js
    function previousMonth() {
        d.setMonth(convertMonth() - 1);
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
        drawTimeSheet();
    }
    // this month js
    function thisMonth() {
        var d = new Date();
        var month = (months[d.getMonth()]) + ' ' + d.getFullYear();
        document.getElementById("displayDateTime").innerHTML = month;
        d.setMonth(convertMonth());
        drawTimeSheet();
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

    function drawTimeSheet() {

        table = document.getElementById("time-sheet");
        table.innerHTML = '';
        //draw time sheet using data from $timesheets
        var timesheets = {!! json_encode($sheets->toArray()) !!};
        var month = d.getMonth();
        var daysInMonth = getDaysInMonth(d.getFullYear(), d.getMonth() + 1);
        //draw header date, day,checkin,checkout,difficult,plan,status,action
        var row = table.insertRow(0);
        row.insertCell(0).innerHTML = '';
        row.insertCell(1).innerHTML = 'Day';
        row.insertCell(2).innerHTML = 'Check in';
        row.insertCell(3).innerHTML = 'Check out';
        row.insertCell(4).innerHTML = 'Difficult';
        row.insertCell(5).innerHTML = 'Plan';
        row.insertCell(6).innerHTML = 'Status';
        row.insertCell(7).innerHTML = 'Action';

        //draw body
        for (var i = 1; i <= daysInMonth; i++) {

            var date = new Date(d.getFullYear(), d.getMonth(), i + 1);
            //get short day
            var day = date.toLocaleString('en-us', {
                weekday: 'short'
            });
            var row = table.insertRow(i);
            if (day == 'Sun') {
                row.className = 'table-danger';
            }
            if (day == 'Sat') {
                row.className = 'table-info';
            }

            //get date
            date = date.toISOString().slice(0, 10);
            row.insertCell(0).innerHTML = day;
            row.insertCell(1).innerHTML = date;
            //for each to draw element in timesheet
            var checkin = '';
            var checkout = '';
            var status = '';
            var difficult = '';
            var plan = '';
            var id = '';
            timesheets.forEach(function(timesheet) {
                if (timesheet.date == date) {
                    checkin = timesheet.check_in;
                    checkout = timesheet.check_out;
                    status = timesheet.status;
                    difficult = timesheet.difficult;
                    plan = timesheet.plan;
                    id = timesheet.id;

                }
            });
            row.insertCell(2).innerHTML = checkin;
            row.insertCell(3).innerHTML = checkout;
            row.insertCell(4).innerHTML = difficult;
            row.insertCell(5).innerHTML = plan;
            row.insertCell(6).innerHTML = status;
            row.cells[1].className = 'date';
            row.cells[2].className = 'check_in';
            row.cells[3].className = 'check-out';
            row.cells[4].className = 'difficult';
            row.cells[5].className = 'plan';
            row.cells[6].className = 'status';
            if (id != '') {
                row.insertCell(7).innerHTML =
                    `<a href="#" class="btn btn-link edit_task" data-toggle="modal" data-target="#edit_task${id}"><i class="fa fa-edit"></i></a>`;
            } else {
                row.insertCell(7).innerHTML =
                    `<a href="#" class="btn btn-link create_task" data-toggle="modal" data-target="#create_task"><i class="fa fa-plus-circle"></i></a>`;
            }


        }
    }

    function getDaysInMonth(year, month) {
        return new Date(year, month, 0).getDate();
    }
</script>

<script>
    $(document).ready(function() {

        //create-task
        $('.create_task').click(function() {
            var date = $(this).closest('tr').find('.date').text();
            console.log(date);
            $('#c-date').val(date);
        });

    });
    //ajax create task
    function createSheetTask() {

        var date = $('#c-date').val();
        var content = $('#c-content').val();
        var checkin = $('#c-checkin').val();
        var checkout = $('#c-checkout').val();
        var status = $('#c-status').val();
        var difficult = $('#c-difficult').val();
        var plan = $('#c-plan').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('sheettask.create') }}",
            method: "POST",
            data: {
                date: date,
                check_in: checkin,
                check_out: checkout,
                content: content,
                status: status,
                difficult: difficult,
                plan: plan,
                _token: _token
            },
            success: function(data) {
                $('#create_task').modal('hide');
                location.reload();
            }
        });
    }
</script>
