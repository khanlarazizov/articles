@extends('admin')
@section('title','Sənədlər')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sənədlər</h1>
            </div>
            <div class="col-sm-6 ">
                {{--                <a class="btn btn-primary ms-4 float-sm-right" href="{{route('documents.create')}}" role="button">Sənəd--}}
                {{--                    Əlavə Et</a>--}}


                <div class="btn-group ms-4 me-5 float-sm-right">
                    <button type="button" class="btn btn-primary">Sənəd əlavə et</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Sənəd əlavə et</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{route('documents.contracts.create')}}">Müqavilə</a>
                        <a class="dropdown-item" href="{{route('documents.contract-additions.create')}}">Müqaviləyə əlavə</a>
                        <a class="dropdown-item" href="{{route('documents.protocols.create')}}">Protokol</a>
                        <a class="dropdown-item" href="{{route('documents.delivery-statement.create')}}">Təhvil-təslim aktı</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{--                {{ Breadcrumbs::render('document') }}--}}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sənədlər</h3>
        </div>

        <div class="card-body">
            <div class="table_content">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col" class="col-4">Ad</th>
                        <th scope="col" class="col-4">Tip</th>
                        <th scope="col" class="col-3 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $document)
                        <tr id="row-{{$document->id}}">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$document->number}}</td>
                            <td>{{$document->document_type}}</td>
                            <td class="text-center">
{{--                                <button type="button" class="btn btnShowDocument" data-id="{{ $document->id }}"--}}
{{--                                        data-bs-toggle="modal" data-bs-target="#showDocumentModal">--}}
{{--                                    <i class="fa-solid fa-eye" style="color: #0f67ff;"></i>--}}
{{--                                </button>--}}

{{--                                <a href="{{route('documents.edit', $document->id)}}" class="btn"><i--}}
{{--                                        class="fa-regular fa-pen-to-square"--}}
{{--                                        style="color: #34c832;"></i></a>--}}

                                <a href="" class="btn btnDeleteDocument" data-id="{{$document->id}}">
                                    <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>


{{--                                <a href="{{Storage::url('public/documents/contracts/' . $document->file)}}"--}}
{{--                                   class="btn" download><i class="fa-solid fa-download"></i></a></td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--                <div class="pt-3">{{ $documents->appends(request()->all())->links() }}</div>--}}
            </div>
        </div>
    </div>

    @include('_documents.js')
@endsection
