@extends('admin')
@section('title','İstifadəçilər')
@section('content-header')
    <div class="row">
        <div class="col-10"><h1 class="ps-4">İstifadəçilər</h1></div>
        <div class="col-2"><a class="btn btn-primary ms-4" role="button" data-bs-toggle="modal"
                              data-bs-target="#addUserModal">
                İstifadəçi Əlavə Et</a></div>
    </div>
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table_content">
            <table class="table table-striped-columns table-hover">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col" class="col-6">Ad</th>
                    <th scope="col" class="col-2">Redaktə et</th>
                    <th scope="col" class="col-2">Sil</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="row-{{ $user->id }}">
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td><a href="" class="btn btnUserEdit" data-id="{{ $user->id }}"><i
                                    class="fa-regular fa-pen-to-square"
                                    style="color: #34c832;"></i></a></td>
                        <td><a href="" class="btn btnUserDelete" data-id="{{ $user->id }}"><i
                                    class="fa-solid fa-trash"
                                    style="color: #ff0000;"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            <div class="pt-3">{{ $users->appends(request()->all())->links() }}</div>--}}
        </div>
    </div>
    @include('users.create_modal')
    @include('users.edit_modal')
    @include('users.js')
@endsection
