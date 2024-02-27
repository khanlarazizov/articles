@extends('admin')
@section('title','Layihələr')
@section('content-header')

    @php
    $url = request()->getPathInfo();
    $items = explode('/',$url);
    @endphp
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Layihələr</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary ms-4 float-sm-right" role="button" data-bs-toggle="modal"
                   data-bs-target="#addProjectModal">
                    Layihə Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('project',$company) }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Layihələr</h3>
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
                    @foreach($projects as $project)
                        <tr id="row-{{$project->id}}">
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('companies.projects.folders.index',['company' => $project->company->id,'project'=>$project->id]) }}">{{$project->name}}</a>
                            </td>
                            <td class="text-center"><a href="" class="btn btnProjectEdit" data-id="{{$project->id}}"><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a>
                                <a href="" class="btn btnProjectDelete" data-id="{{$project->id}}"><i
                                        class="fa-solid fa-trash"
                                        style="color: #ff0000;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pt-3">{{ $projects->appends(request()->all())->links() }}</div>

            </div>
        </div>
    </div>
    @include('folders.project.create_modal')
    @include('folders.project.edit_modal')
    @include('folders.project.js')
@endsection
