@extends('admin')
@section('title','Müqavilələr')
@section('content-header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
        <div class="col-10"><h1 class="ps-4">Müqavilələr</h1></div>
        <div class="col-2"><a class="btn btn-primary" href="{{route('contract.create')}}" role="button">Müqavilə
                Əlavə Et</a></div>
{{--        <div class="col-2"><a class="btn btn-primary contract_button" role="button" data-bs-toggle="modal" data-bs-target="#addModal">Müqavilə--}}
{{--                Əlavə Et</a></div>--}}
    </div>
    @php
        use Carbon\Carbon;
    @endphp
@endsection
@section('content')
    <table class="table table-striped-columns">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Ad</th>
            <th scope="col">Alqı-satqı</th>
            <th scope="col">Vaxt</th>
            <th scope="col">Qiymət</th>
            <th scope="col">Redaktə et</th>
            <th scope="col">Sil</th>
            <th scope="col">Yüklə</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $key)
            <tr id="row-{{$key->id}}">
                <th>{{$loop->iteration}}</th>
                <td>{{$key->name}}</td>
                <td>{{$key->shopping}}</td>
                <td>{{Carbon::now()->diffInMonths($key->date)}}</td>
                <td>{{$key->price}}</td>

                <td><a href="{{route('contract.edit', $key->id)}}" class="btn"><i class="fa-regular fa-pen-to-square"
                                                                                  style="color: #34c832;"></i></a></td>
                <td><a href="" class="btn delete_contract" data-id="{{$key->id}}"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></td>
                <td><a href="{{route('contract.download',$key->id)}}" class="btn"><i class="fa-solid fa-download"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    <div class="pt-3">{{ $contracts->appends(request()->all())->links() }}</div>--}}
{{--    @include('contract.create_modal')--}}
{{--    @include('contract.update_modal')--}}
    @include('contract.js')
@endsection
