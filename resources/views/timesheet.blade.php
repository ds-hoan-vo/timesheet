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
<!-- Modal -->
<div class="modal fade" id="edit_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">TimeSheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{ route('sheettask.update') }}" method="post">
                    @csrf
                    <div class="row" mb-2>
                        <div class="col">
                            <span>Date:</span>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="date" id="e-date" readonly>
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
                            <input type="text" class="form-control" name="checkin" id="e-checkin">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="checkout" id="e-checkout">
                        </div>
                    </div>
                    <span>Difficultie</span>
                    <input type="text" class="form-control mb-2" placeholder="difficutltie" name="difficult" id="e-difficult">
                    <span>Plan</span>
                    <input type="text" class="form-control mb-2" placeholder="plan" name="plan" id="e-plan">
                    <span>Status</span>
                    <input type="text" class="form-control mb-2" placeholder="status" name="status" id="e-status">
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

<script>
    $(document).ready(function() {
        var sheets = @json($sheets);
        var event = [];
        sheets.forEach(function(sheet) {
            check_in = sheet.check_in;
            check_out = sheet.check_out;
            if (check_out == null)
                check_out = ' ';
            event.push({
                id: sheet.id,
                title: sheet.check_in + ' - ' + check_out,
                start: sheet.date + ' ' + check_in,
                end: sheet.date + ' ' + check_out,
            });
        });
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            navLinks: true,
            editable: true,
            displayEventTime: false,
            events: event,

            eventRender: function(event, element, view) {
                if (event.allDay === 'true') {
                    event.allDay = true;
                } else {
                    event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                //using modal
                var date = $.fullCalendar.formatDate(start, "Y-MM-DD");
                var start = $.fullCalendar.formatDate(start, "HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "HH:mm:ss");
                $('#edit_task').modal('show');
                $('#e-date').val(date);
                $('#e-checkin').val('');
                $('#e-checkout').val();
                $('#e-difficult').val('');
                $('#e-plan').val('');
                $('#e-status').val('');
                $('#e-task').val('');
                    
                // console.log(id);
                //add new event
                // ajax({
                //     url: 'sheettask/create',
                //     type: 'POST',
                //     data: {
                //         title: title,
                //         start: start,
                //         end: end,
                //         allDay: allDay
                //     },
                //     success: function(response) {
                //         console.log(response);
                //     }
                // });
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                );
                calendar.fullCalendar('unselect');
            },
        });
    });
</script>
@endsection