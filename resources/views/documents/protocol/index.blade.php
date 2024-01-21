@extends('admin')
@section('title','Protokollar')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Protokollar</h1>
            </div>
            <div class="col-sm-6 ">
                <a class="btn btn-primary ms-4 float-sm-right" href="{{route('protocols.create')}}" role="button">Protokol
                    Əlavə Et</a>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('protocol') }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Axtarış</h3>
        </div>
        <div class="card-body">
            <form action="" id="protocolFilter">
                <div class="row">
                    <div class="col-3 my-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Ad"
                               value="{{ request()->get('name') }}">
                    </div>
                    <div class="col-3 my-2">
                        <select name="contract_id" id="contract_id" class="form-select">
                            <option value="{{ null }}">Müqavilə seç</option>
                            @foreach($contracts as $contract)
                                <option
                                    value="{{ $contract->id }}" {{ request()->get('contract_id') == $contract->id ? "selected" : "" }}>{{ $contract->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 my-2">
                        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" name="date" id="date" placeholder="Tarix"
                                   value="{{ request()->get('date') }}">
                            <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span></div>
                    </div>
                    <div class="col-3 my-2">
                        <input type="text" class="form-control" name="price" id="price" placeholder="Qiymət"
                               value="{{ request()->get('price') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary col-2">Axtar</button>
                        {{--                <button type="submit" class="btn btn-danger w-50 btnClearFilter">Təmizlə</button>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Protokollar</h3>
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
                    @foreach($protocols as $protocol)
                        <tr id="row-{{$protocol->id}}">
                            <th>{{$loop->iteration}}</th>
                            <td>{{$protocol->name}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btnShowProtocol" data-id="{{ $protocol->id }}"
                                        data-bs-toggle="modal" data-bs-target="#showProtocolModal">
                                    <i class="fa-solid fa-eye" style="color: #0f67ff;"></i>
                                </button>

                                <a href="{{route('protocols.edit', $protocol->id)}}" class="btn" ><i
                                        class="fa-regular fa-pen-to-square"
                                        style="color: #34c832;"></i></a>

                                <a href="" class="btn btnDeleteProtocol" data-id="{{$protocol->id}}"><i
                                        class="fa-solid fa-trash" style="color: #ff0000;"></i></a>

                                <a href="{{Storage::url('public/documents/protocols/' . $protocol->file)}}"
                                   class="btn" download><i class="fa-solid fa-download"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pt-3">{{ $protocols->appends(request()->all())->links() }}</div>
            </div>
        </div>
    </div>


    @include('documents.protocol.js')
    @include('documents.protocol.show')
@endsection
