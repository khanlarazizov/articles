@extends('admin')
@section('title','Qovluqlar')
@section('content-header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <div class="col-10"><h1 class="ps-4">Qovluqlar</h1></div>
{{--        <div class="col-2"><a class="btn btn-primary" href="{{route('protocol.create')}}" role="button">Qovluq--}}
{{--                Əlavə Et</a></div>--}}
        <div class="col-2"><a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#addFolderModal">Qovluq
                        Əlavə Et</a></div>
    </div>
    @php
        use Carbon\Carbon;
    @endphp
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table_content">
            <table class="table table-hover table-fixed">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col" class="col-6">Ad</th>
                    <th scope="col" class="col-2">Redaktə et</th>
                    <th scope="col" class="col-2">Sil</th>
                </tr>
            </thead>
            <tbody>
            @foreach($folder as $key)
                <tr id="row-{{$key->id}}">
                    <th>{{$loop->iteration}}</th>
                    <td><a href="{{route('folder',$key->slug)}}">{{$key->name}}</a></td>
                    <td><a href="" class="btn edit_folder" data-id="{{$key->id}}"><i class="fa-regular fa-pen-to-square"
                                                                style="color: #34c832;"></i></a></td>
                    <td><a href="" class="btn delete_folder" data-id="{{$key->id}}"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
            <div class="pt-3">{{ $folder->appends(request()->all())->links() }}</div>
        </div>
    </div>
    @include('folder.create_modal')
    @include('folder.edit_modal')
    @include('folder.js')
@endsection
