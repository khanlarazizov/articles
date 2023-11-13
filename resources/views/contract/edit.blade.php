@extends('admin')
@section('title','Müqavilələr')
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
            <h3 class="card-title">Müqavilə Redaktə et</h3>
        </div>
        <form action="{{route('contract.update',$contract->id)}}" method="post" id="addContractForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @if($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li><div>{{$error}}</div></li>
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
                        value="{{$contract->name}}">
                    <span id="nameError" class="text-danger error-message"></span>
                </div>

                <div class="form-group">
                    <label for="datapicker">Tarix</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input
                            type="text"
                            class="form-control"
                            name="date"
                            id="date"
                            value="{{$contract->date}}">
                        <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                    </div>
                    <span id="dateError" class="text-danger error-message"></span>
                </div>

                    <div class="form-group">
                        <label for="other_side_name">Qovluq</label>
                        <select class="form-select" aria-label="Default select example" name="folder_id">
                            @foreach($folders as $key )
                                <option value="{{$key->id}}" {{$contract->folder_id == $key->id ? "selected" : "" }}>{{$key->name}}</option>
                            @endforeach
                        </select>
                        <span id="folderError" class="text-danger error-message"></span>
                    </div>

                <div class="form-group">
                    <label for="type">Növ</label>
                    <select class="form-control" id="type" name="type">
                        <option value="Partnyorluq" {{$contract->type=='Partnyorluq' ? 'selected' : ''}}>Partnyorluq</option>
                        <option value="Xidmət" {{$contract->type=='Xidmət' ? 'selected' : ''}}>Xidmət</option>
                        <option value="Alqı-satqı" {{$contract->type=='Alqı-satqı' ? 'selected' : ''}}>Alqı-satqı</option>
                    </select>
                    <span id="typeError" class="text-danger error-message"></span>
                </div>

                <div class="row">
                    <div class="form-group col-6 shopping">
                        <input
                            class="otherside-input"
                            type="radio"
                            name="shopping"
                            id="shopping1"
                            value="Biz alırıq"
                            {{$contract->shopping=='Biz alırıq' ? 'checked' : ''}}>
                        <label class="otherside-label" for="otherside">
                            Biz alırıq
                        </label>
                    </div>
                    <div class="form-group col-6 shopping">
                        <input

                            class="otherside-input"
                            type="radio"
                            name="shopping"
                            id="shopping1"
                            value="Biz satırıq"
                            {{$contract->shopping=='Biz satırıq' ? 'checked' : ''}}>
                        <label class="otherside-label" for="otherside">
                            Biz satırıq
                        </label>
                    </div>
                    <span id="shoppingError" class="text-danger error-message"></span>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <input
                            class="otherside-input checkperson"
                            type="checkbox"
                            name="other_side_type"
                            id="other_side_type"
                            value="Fiziki şəxs"
                            {{$contract->other_side_type=='Fiziki şəxs' ? 'checked' : ''}}>
                        <label class="otherside-label" for="otherside">Fiziki şəxs</label>
                    </div>
                    <div class="col-6">
                        <input
                            class="otherside-input textperson"
                            type="text"
                            name="other_side_type"
                            id="other_side_type"
                            placeholder="Şirkət adı"
                            @if($contract->other_side_type=='Fiziki şəxs')
                                disabled
                            @else
                                value="{{$contract->other_side_type}}"
                            @endif
                        >
                    </div>
                    <span id="otherSideTypeError" class="text-danger error-message"></span>
                </div>

                <div class="form-group">
                    <label for="other_side_name">Təmsilçi</label>
                    <input
                        type="text"
                        class="form-control"
                        aria-label="First name"
                        id="other_side_name"
                        name="other_side_name"
                        value="{{$contract->other_side_name}}">
                    <span id="otherSideNameError" class="text-danger error-message"></span>
                </div>

                <div class="form-group">
                    <label for="tag">Etiket</label>
                    <input
                        type="text"
                        class="form-control"
                        aria-label="First name"
                        id="tag"
                        name="tag"
                        value="{{$contract->tag}}">
                    <span id="tagError" class="text-danger error-message"></span>
                </div>

                <div class="form-group">
                    <label for="price">Dəyər</label>
                    <input
                        type="text"
                        class="form-control"
                        aria-label="First name"
                        id="price"
                        name="price"
                        value="{{$contract->price}}">
                    <span id="priceError" class="text-danger error-message"></span>
                </div>

                <div class="form-group">
                    <label for="currency">Valyuta</label>
                    <select class="form-control" id="currency" name="currency">
                        <option value="AZN" {{$contract->currency == 'AZN' ? 'selected' : ''}}>AZN</option>
                        <option value="USD" {{$contract->currency == 'USD' ? 'selected' : ''}}>USD</option>
                    </select>
                    <span id="currencyError" class="text-danger error-message"></span>
                </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Fayl seç</label>
                            <iframe
                                src="{{asset('storage/documents/contracts/')}}/{{$contract->file}}"
                                type="application/pdf"
                                height="100%"
                                width="100%"
                            ></iframe>
                            <input class="form-control" type="file" id="file" name="file" accept=".pdf">
                        </div>
                        <span id="fileError" class="text-danger error-message"></span>
                    </div>
            </div>

            <div class="card-footer">
                <div class="col-6 mx-auto d-flex">
                    <button class="btn btn-primary btn-lg active w-50 me-2" type="submit" aria-pressed="true">Redaktə et</button>
                    <a href="{{route('contract.index')}}" class="btn btn-secondary btn-lg active w-50" role="button" aria-pressed="true">Çıx</a>
                </div>
            </div>
        </form>
    </div>


    {{--    @include('protocol.create_modal')--}}
    {{--    @include('protocol.update_modal')--}}
    {{--    @include('protocol.delete_protocol')--}}
    @include('contract.js')
@endsection
