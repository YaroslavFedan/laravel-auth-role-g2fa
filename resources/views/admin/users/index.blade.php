@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users</div>

                    <div class="card-body">

                        <form action="{{ route('admin.users.index') }}" method="get">

                            <select name="role" id="role">
                                <option value> all </option>
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}" @if(Request::get('role') == $role->name) selected @endif>{{$role->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit">Filter</button>
                        </form>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ implode(', ',$user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.edit',$user->id) }}">
                                                <button type="button" class="btn btn-primary float-left">Edit</button>
                                            </a>
                                            <form action="{{ route('admin.users.destroy',$user) }}" method="post" class="float-left ml-1">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-warning">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->appends($filter)->links() }}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
