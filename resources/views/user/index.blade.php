@extends('app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                </div>
                <div class="table-responsive">
                    <table class="table no-wrap user-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Added</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Category</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="pl-4">{{$user->id}}</td>
                                <td>
                                    <h5 class="font-medium mb-0">{{$user->name}}</h5>
                                    <span class="text-muted">{{$user->address}}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{$user->username}}</span><br>
                                    <span class="text-muted">{{$user->phone}}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->created_at}}</span><br>
                                    <span class="text-muted">10: 55 AM</span>
                                </td>
                                <td>
                                    <select class="form-control category-select" id="exampleFormControlSelect1">
                                        <option>Modulator</option>
                                        <option>Admin</option>
                                        <option>User</option>
                                        <option>Subscriber</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection