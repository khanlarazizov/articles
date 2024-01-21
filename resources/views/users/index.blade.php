@extends('admin')
@section('title','İstifadəçilər')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>İstifadəçilər</h1>
            </div>
            <div class="col-sm-6 ">
                <a class="btn btn-primary ms-4 float-sm-right" role="button" data-bs-toggle="modal"
                   data-bs-target="#addUserModal">
                    İstifadəçi Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('user') }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">İstifadəçilər</h3>
        </div>

        <div class="card-body">
            <div class="table_content">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col" class="col-8">Ad</th>
                        <th scope="col" class="col-3 text-center">ne yazim</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr id="row-{{ $user->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td class="text-center"><a href="" class="btn btnUserEdit" data-id="{{ $user->id }}"><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a>
                                <a href="" class="btn btnUserDelete" data-id="{{ $user->id }}"><i
                                        class="fa-solid fa-trash"
                                        style="color: #ff0000;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @include('users.create_modal')
    @include('users.edit_modal')
    @include('users.js')
@endsection
