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
                                    <button class="btn dropdown-toggle bg-transparent" type="button" id="triggerId"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        style="border: 1px solid black">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item btn-change-role" data-user_id='{{ $user->id }}'
                                            data-role_id='{{ $user->roles->pluck('id')->first() }}' href="#">Change
                                            Role</a>
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



    <!-- Modal -->
    <div class="modal fade" id="change-role-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/users/change-role">
                        @csrf
                        <input type="hidden" name="user_id" id="user-id-role">
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <select class="form-control" aria-label="Default select example" id='role' name='role'
                                required>
                                @foreach ($roles as $role)
                                    <option value='{{ $role->id }}' selected>{{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                </div>
                <div class="form-group my-4">
                    {{-- <button class="btn btn-block btn-info" type="submit">Close</button> --}}
                </div>

            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-change-role', function(e) {
                e.preventDefault();
                let modal = $(document).find('#change-role-modal'),
                    user_id = $(this).data('user_id');

                $(modal).find('input#user-id-role').val(user_id);

                $(modal).modal('show');

            })
        });
    </script>
@endsection
