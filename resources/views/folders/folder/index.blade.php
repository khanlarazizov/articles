@extends('admin')
@section('title','Qovluqlar')
@section('content-header')
    <div class="row">
        <div class="col-10"><h1 class="ps-4">Qovluqlar</h1></div>
        <div class="col-2"><a class="btn btn-primary ms-4" role="button" data-bs-toggle="modal"
                              data-bs-target="#addFolderModal">
                Qovluq Əlavə Et</a></div>
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
                @foreach($folders as $folder)
                    <tr id="row-{{ $folder->id }}">
                        <th>{{ $folder->id }}</th>
                        <td>{{ $folder->name }}</td>
                        <td><a href="" class="btn btnFolderEdit" data-id="{{ $folder->id }}"><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a></td>
                        <td><a href="" class="btn btnFolderDelete" data-id="{{ $folder->id }}"><i
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
