@extends('app')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0">Manage Teams</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Name</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Leader</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <td class="pl-4">{{ $team->id }}</td>
                                        <td>
                                            <h5 class=" font-medium mb-0">{{ $team->name }}</h5>
                                            {{-- <span class="text-muted">{{ $user->address }}</span> --}}
                                        </td>
                                        <td>
                                            @foreach ($team->users as $user)
                                                @if ($user->pivot->role == 'leader')
                                                    {{ $user->name }} ,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('deleteTeam', $team)
                                                <button type="button" class="btn btn-outline-info ml-2 delete"><i
                                                        class="fa fa-trash"></i> </button>
                                            @endcan

                                            @can('updateTeam', $team)
                                                <button type="button" class="btn btn-outline-info ml-2"><i
                                                        class="fa fa-edit"></i> </button>
                                            @endcan
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
        //ajax delete by id
        $(document).on('click', '.delete', function() {
            //get id from first td of the row
            var id = $(this).closest('tr').find('td:first').text();
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: '/user/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                    },
                    success: function(result) {
                        //do something with the result
                        alert('Deleted');
                    }
                });
            }
        });
    </script>
@endsection
