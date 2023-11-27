@extends('admin')
@section('title','Protokollar')
@section('content-header')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Protokol Əlavə et</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('protocol.store')}}" method="post" id="addProtocolForm" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li class="alert-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="name">Ad</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="datapicker">Tarix</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control" name="date" id="date" value="{{ old('date') }}">
                        <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="other_side_name">Müqavilə</label>
                    <select class="form-select" aria-label="Default select example" name="contract_id">
                        @foreach($contracts as $key )
                            <option value="{{$key->id}}" {{ old('contract_id') == $key->id ? 'selected' : '' }}>{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="other_side_name">Təmsilçi</label>
                    <input
                        type="text"
                        class="form-control"
                        id="other_side_name"
                        name="other_side_name"
                        value="{{ old('other_side_name') }}">
                </div>

{{--                <div class="form-group">--}}
{{--                    <label>Etiket</label>--}}
{{--                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="tag" id="tag">--}}
{{--                        <option>Alabama</option>--}}
{{--                        <option>Alaska</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="form-group">
                    <label for="tag">Etiket</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tag"
                        name="tag"
                        value="{{ old('tag') }}">
                </div>

                <div class="form-group">
                    <label for="price">Dəyər</label>
                    <input
                        type="number"
                        class="form-control"
                        id="price"
                        name="price"
                        value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label for="currency">Valyuta</label>
                    <select class="form-control" id="currency" name="currency">
                        <option value="AZN" {{ old('currency') == 'AZN' ? 'selected' : '' }}>AZN</option>
                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Fayl seç</label>
                        <input
                            class="form-control"
                            type="file"
                            id="file"
                            name="file"
                            accept=".pdf">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="col-6 mx-auto d-flex">
                    <button class="btn btn-primary btn-lg active w-50 me-2" type="submit" aria-pressed="true">Yadda saxla</button>
                    <a href="{{route('protocol.index')}}" class="btn btn-secondary btn-lg active w-50" role="button" aria-pressed="true">Çıx</a>
                </div>
            </div>
        </form>
    </div>


    {{--    @include('protocol.create_modal')--}}
    {{--    @include('protocol.update_modal')--}}
    {{--    @include('protocol.delete_protocol')--}}
    @include('protocol.js')
@endsection
