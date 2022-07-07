@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->roles->pluck('name')->first() ?? 'Not assigned' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle bg-transparent" type="button"
                                        id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item btn-change-role" data-user_id='{{ $user->id }}'
                                            href="#">Change Role</a>
                                        <a class="dropdown-item " href="#">Change permission</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
@stop
@yield('javascript')
<script></script>
@endsection
