<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container mt-3">


        <a href="{{ url('user/create') }}" style="display-inline:block" class="btn btn-success">Create User</a>
        <a style="float: right" href="{{ url('logout') }}" class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>

        <div style="float: right ; margin-right:20px" >
            <form action="{{ url('user/list') }}">

                <input style="background-color:#ddd;padding-bottom:5px" type="text" name="search" placeholder="Search Here" value="{{$search}}" >
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="row mt-3">
            @include('suc_or_err')
            <table  class="table table-striped ">
                <thead>
                    <tr>
                        <th>Index</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Hobby</th>
                        <th>Gender</th>
                        <th>Image</th>
                        <th>Action</th>
                        <th>Detail's</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr class="@if ($user->id == Auth::user()->id) {{ 'table-warning' }} @endif">
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->phone) {{ $user->phone  }}

                                @else
                                ---
                                @endif
                            </td>
                            <td>{{ $user->hobby }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                {!! $user->getImage() !!}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a class="btn btn-primary btn-sm " href="{{ url('user/edit/'.$user->id) }}">Edit</a>

                                    <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>

                                    <form id="delete-form-{{ $user->id }}" action="{{ url('user/delete/'.$user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>

                            <td>
                                <a href="{{ url('user/show/'.$user->id) }}">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->appends(['search' => $search])->links('pagination::bootstrap-5') }}

        </div>
    </div>
</body>
</html>
