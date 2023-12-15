@extends('admin')
@section('title','Müqavilələr')
@section('content-header')
    <div class="row">
        <div class="col-10"><h1 class="ps-4">Müqavilələr</h1></div>
        <div class="col-2"><a class="btn btn-primary ms-4" href="{{route('contracts.create')}}" role="button">Müqavilə
                Əlavə Et</a></div>
    </div>
    @php
        use Carbon\Carbon;
    @endphp
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table_content">
            <table class="table table-striped-columns table-hover">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Ad</th>
{{--                    <th scope="col">Alqı-satqı</th>--}}
{{--                    <th scope="col">Vaxt</th>--}}
{{--                    <th scope="col">Qiymət</th>--}}
                    <th scope="col">Göstər</th>
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
{{--                        <td>{{$key->shopping}}</td>--}}
{{--                        <td>{{Carbon::now()->diffInMonths($key->date)}}</td>--}}
{{--                        <td>{{$key->price}}</td>--}}
                        <td>
                            <button type="button" class="btn btnShowContract" data-id="{{ $key->id }}"
                                    data-bs-toggle="modal" data-bs-target="#showContractModal">
                                <i class="fa-solid fa-eye" style="color: #0f67ff;"></i>
                            </button>
                        </td>

                        <td><a href="{{route('contracts.edit', $key->id)}}" class="btn"><i
                                    class="fa-regular fa-pen-to-square"
                                    style="color: #34c832;"></i></a></td>

                        <td><a href="" class="btn btnDeleteContract" data-id="{{$key->id}}">
                                <i class="fa-solid fa-trash" style="color: #ff0000;"></i></a>
                        </td>

                        <td><a href="{{route('contracts.download',$key->id)}}" class="btn"><i
                                    class="fa-solid fa-download"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pt-3">{{ $contracts->appends(request()->all())->links() }}</div>
        </div>
    </div>
    @include('documents.contract.js')
    @include('documents.contract.show')
@endsection
