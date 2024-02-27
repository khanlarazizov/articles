@extends('admin')
@section('title','Şirkətlər')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Şirkətlər</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary ms-4 float-sm-right" role="button" data-bs-toggle="modal"
                   data-bs-target="#addCompanyModal">
                    Şirkət Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('company') }}

{{--                <li class="breadcrumb-item"><a href="{{route('home')}}">Ana səhifə</a></li>--}}
{{--                <li class="breadcrumb-item active">Şirkətlər</li>--}}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Şirkətlər</h3>
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
                    @foreach($companies as $company)
                        <tr id="row-{{$company->id}}">
                            <th>{{ $loop->iteration }}</th>
                            <td><a href="{{ route('companies.projects.index',$company->id) }}">{{$company->name}}</a>
                            </td>
                            <td class="text-center"><a href="" class="btn btnCompanyEdit" data-id="{{$company->id}}"><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a>
                                <a href="" class="btn btnCompanyDelete" data-id="{{$company->id}}"><i
                                        class="fa-solid fa-trash"
                                        style="color: #ff0000;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pt-3">{{ $companies->appends(request()->all())->links() }}</div>
            </div>
        </div>
    </div>

    @include('folders.company.create_modal')
    @include('folders.company.edit_modal')
    @include('folders.company.js')
@endsection
