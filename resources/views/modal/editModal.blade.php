@extends('sheettask')
@section('modal')

<!-- Modal -->
<div class="modal fade" id="edit_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit TimeSheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form action="{{ url('sheettask/')}}" method="put">
                    @csrf
                    <input type="text" class="form-control" name="id" id="e-id" hidden>
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
@endsection