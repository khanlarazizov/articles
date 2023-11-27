@extends('admin')
@section('title','Protokollar')
@section('content-header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <div class="col-10"><h1 class="ps-4">Protokollar</h1></div>
        <div class="col-2"><a class="btn btn-primary" href="{{route('protocol.create')}}" role="button">Protokol
                Əlavə Et</a></div>
        {{--        <div class="col-2"><a class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#addModal">Protokol--}}
        {{--                Əlavə Et</a></div>--}}
    </div>
    @php
        use Carbon\Carbon;
    @endphp
@endsection
@section('content')
    <form action="" id="protocolFilter">
            <div class="row">
                <div class="col-3 my-2">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Ad" value="{{ request()->get('name') }}">
                </div>
                <div class="col-3 my-2">
                    <select name="contract_id" id="contract_id" class="form-select">
                        <option value="{{ null }}">Müqavilə seç</option>
                        @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}" {{ request()->get('contract_id') == $contract->id ? "selected" : "" }}>{{ $contract->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 my-2">
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control" name="date" id="date" value="{{ request()->get('date') }}">
                        <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span></div>
                </div>
                <div class="col-3 my-2">
                    <input type="text" class="form-control" name="price" id="price" placeholder="Qiymət" value="{{ request()->get('price') }}">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 mx-auto d-flex">
                    <button type="submit" class="btn btn-primary w-50 me-2">Axtar</button>
                    <button type="submit" class="btn btn-danger w-50 btnClearFilter">Təmizlə</button>
                </div>
            </div>
            <hr>
        </form>
    <table class="table table-striped-columns">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Ad</th>
                <th scope="col">Bağlı olduğu müqavilə</th>
                <th scope="col">Vaxt</th>
                <th scope="col">Qiymət</th>
                <th scope="col">Redaktə et</th>
                <th scope="col">Sil</th>
                <th scope="col">Yüklə</th>
            </tr>
            </thead>
            <tbody>
            @foreach($protocols as $key)
                <tr id="row-{{$key->id}}">
                    <th>{{$loop->iteration}}</th>
                    <td>{{$key->name}}</td>
                    <td>{{isset($key->contract->name) ? $key->contract->name : 'Müqaviləsiz'}}</td>
                    <td>{{$key->date}}</td>
                    <td>{{$key->price}}</td>

                    <td><a href="{{route('protocol.edit', $key->id)}}" class="btn" data-id="{{$key->id}}"><i class="fa-regular fa-pen-to-square"
                                                                                                             style="color: #34c832;"></i></a></td>
                    <td><a href="" class="btn delete_protocol_icon" data-id="{{$key->id}}"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></td>
                    <td><a href="{{asset('storage/documents/protocols/')}}/{{$key->file}}" class="btn" data-id="{{$key->id}}" download><i class="fa-solid fa-download"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    <div class="pt-3">{{ $protocols->appends(request()->all())->links() }}</div>

    @include('protocol.js')
@endsection
