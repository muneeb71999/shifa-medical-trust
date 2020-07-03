@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="p-0 py-2 card-header d-flex justify-content-between align-items-center">
        <span class="h2">{{ $page_title }}</span>
        <div>
            <a href={{ route('register') }} class="btn btn-success text-white">Create New User</a>
            <a href={{ $page_url }} class="btn btn-success text-white">{{ $btn_title }}</a>
        </div>
    </h1>
    <div class="card mt-4">
        <h5 class="card-header">Employees Details</h5>
        <div class="card-body p-0">
            <table class="table" id="table">
                <thead id="table-head">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Montly Salary</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($employees as $employee)
                    <tr>
                        <td scope="row">{{ $employee->id }}</td>
                        <td>
                            <button type="button" class="border-0 text-primary detailModal-btn" detailModal"
                                data-id="{{$employee->id}}" data-toggle="modal" data-target="#detailModal"
                                data-link="/employees/{{$employee->id}}/show">
                                {{ $employee->name . '  ' . $employee->guardian_name }}
                            </button>
                        </td>
                        <td>{{ $employee->age }}</td>
                        <td>{{ $employee->monthly_salary }}</td>
                        <td>{{ $employee->designation}}</td>
                        <td>
                            @admin
                            <form method="POST" action="{{route('employees.destroy', $employee->id)}}" class="form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Delete
                                </button>
                            </form>
                            @endadmin
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-4">
        <h5 class="card-header">Users Details</h5>
        <div class="card-body p-0">
            <table class="table" id="table">
                <thead id="table-head">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body ">
                    @foreach ($users as $user)
                    <tr>
                        <td scope="row">{{ $user->id }}</td>
                        <td>
                            <button type="button" class="border-0 text-primary detailModal-btn" detailModal"
                                data-id="{{$user->id}}" data-toggle="modal" data-target="#detailModal"
                                data-link="/users/{{$user->id}}/show">
                                {{ $user->name  }}
                            </button>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @admin
                            <form method="POST" action="{{route('users.destroy', $user->id)}}" class="form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    Delete
                                </button>
                            </form>
                            @endadmin
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="detailModal-body">
                <div class="row py-1">
                    <h1>No data found</h1>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
