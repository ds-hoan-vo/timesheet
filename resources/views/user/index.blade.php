@extends('app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="pl-4">{{ $user->id }}</td>
                                        <td>
                                            <h5 class="font-medium mb-0">{{ $user->name }}</h5>
                                            <span class="text-muted">{{ $user->address }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $user->username }}</span><br>
                                            <span class="text-muted">{{ $user->phone }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $user->created_at }}</span><br>
                                            <span class="text-muted">10: 55 AM</span>
                                        </td>
                                        <td>

                                            <select class="form-control category-select" id="exampleFormControlSelect1">
                                                @if ($user->role == 'Admin')
                                                    <option selected>Admin</option>
                                                    <option>Manager</option>
                                                    <option>User</option>
                                                @elseif ($user->role == 'User')
                                                    <option>Admin</option>
                                                    <option>Manager</option>
                                                    <option selected>User</option>
                                                @elseif($user->role == 'Manager')
                                                    <option>Admin</option>
                                                    <option selected>Manager</option>
                                                    <option>User</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info ml-2 delete"><i
                                                    class="fa fa-trash"></i> </button>
                                            <button type="button" class="btn btn-outline-info ml-2"><i
                                                    class="fa fa-edit"></i> </button>
                                            <button type="button" class="btn btn-outline-info ml-2"><i
                                                    class="fa fa-upload"></i> </button>
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
    <script>
        //ajax update by id
        $(document).on('change', '.category-select', function() {
            //get id from first td of the row
            var id = $(this).closest('tr').find('td:first').text();
            var category = $(this).val();
            $.ajax({
                url: '/user/' + id,
                type: 'PUT',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "id": id,
                    "role": category
                },
                success: function(data) {
                    alert('User Updated!');
                    location.reload();
                },
                error: function() {
                    alert('Error occured');
                }
            });
        });
        //ajax delete by id
        $(document).on('click', '.delete', function() {
            //get id from first td of the row
            var id = $(this).closest('tr').find('td:first').text();
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: '/user/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        "id": id
                    },
                    success: function(data) {
                        alert('User Deleted!');
                        location.reload();
                    },
                    error: function() {
                        alert('Error occured');
                    }
                });
            }
        });
    </script>
@endsection
