@extends('admin')
@section('title','Layihələr')
@section('content-header')
    <div class="row">
        <div class="col-10"><h1 class="ps-4">Layihələr</h1></div>
        <div class="col-2"><a class="btn btn-primary ms-4" role="button" data-bs-toggle="modal"
                              data-bs-target="#addProjectModal">
                Layihə Əlavə Et</a></div>
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
                @foreach($projects as $project)
                    <tr id="row-{{$project->id}}">
                        <th>{{ $loop->iteration }}</th>
                        <td><a href="{{ route('companies.projects.folders.index',['company' => $project->company_id,'project'=>$project->id]) }}">{{$project->name}}</a></td>
                        <td><a href="" class="btn btnProjectEdit" data-id="{{$project->id}}"><i
                                    class="fa-regular fa-pen-to-square"
                                    style="color: #34c832;"></i></a></td>
                        <td><a href="" class="btn btnProjectDelete" data-id="{{$project->id}}"><i class="fa-solid fa-trash"
                                                                                             style="color: #ff0000;"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--            <div class="pt-3">{{ $Project->appends(request()->all())->links() }}</div>--}}
        </div>
    </div>
    @include('folders.project.create_modal')
    @include('folders.project.edit_modal')
    @include('folders.project.js')
@endsection
