@extends('admin')
@section('title','Müqavilələr')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Müqavilələr</h1>
            </div>
            <div class="col-sm-6 ">
                <a class="btn btn-primary ms-4 float-sm-right" href="{{route('contracts.create')}}" role="button">Müqavilə
                    Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('contract') }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Müqavilələr</h3>
        </div>

        <div class="card-body">
            <div class="table_content">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col" class="col-8">Ad</th>
                        <th scope="col" class="col-3 text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        <tr id="row-{{$contract->id}}">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$contract->name}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btnShowContract" data-id="{{ $contract->id }}"
                                        data-bs-toggle="modal" data-bs-target="#showContractModal">
                                    <i class="fa-solid fa-eye" style="color: #0f67ff;"></i>
                                </button>

                                <a href="{{route('contracts.edit', $contract->id)}}" class="btn"><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a>

                                <a href="" class="btn btnDeleteContract" data-id="{{$contract->id}}">
                                    <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>


                                <a href="{{Storage::url('public/documents/contracts/' . $contract->file)}}"
                                   class="btn" download><i class="fa-solid fa-download"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pt-3">{{ $contracts->appends(request()->all())->links() }}</div>
            </div>
        </div>
    </div>

    @include('documents.contract.js')
    @include('documents.contract.show')
@endsection
