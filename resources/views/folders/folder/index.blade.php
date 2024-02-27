@extends('admin')
@section('title','Qovluqlar')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Qovluqlar</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary ms-4 float-sm-right" role="button" data-bs-toggle="modal"
                   data-bs-target="#addFolderModal">
                    Qovluq Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('folder',$company,$project) }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Qovluqlar</h3>
        </div>

        <div class="card-body">
            <div class="table_content">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col" class="col-8">Ad</th>
                        <th scope="col" class="col-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($folders as $folder)
                        <tr id="row-{{ $folder->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $folder->name }}</td>
                            <td class="text-center"><a href="" class="btn btnFolderEdit" data-id="{{ $folder->id }}"><i
                                            class="fa-regular fa-pen-to-square"
                                            style="color: #34c832;"></i></a>
                                <a href="" class="btn btnFolderDelete" data-id="{{ $folder->id }}"><i
                                            class="fa-solid fa-trash"
                                            style="color: #ff0000;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pt-3">{{ $folders->appends(request()->all())->links() }}</div>
            </div>
        </div>
    @include('folders.folder.create_modal')
    @include('folders.folder.edit_modal')
    @include('folders.folder.js')
@endsection
