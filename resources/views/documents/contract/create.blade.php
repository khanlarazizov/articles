@extends('admin')
@section('title','Müqavilələr')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Müqavilələr</h1>
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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Müqavilə Əlavə et</h3>
        </div>
        <form action="{{route('contracts.store')}}" method="post" id="addContractForm" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
{{--                @if($errors->any())--}}
{{--                    <div>--}}
{{--                        <ul>--}}
{{--                            @foreach($errors->all() as $error)--}}
{{--                                <li class="alert-danger">{{$error}}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
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
                        <input
                            type="text"
                            class="form-control"
                            name="date"
                            id="date"
                            value="{{ old('date') }}">
                        <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="other_side_name">Qovluq</label>
                    <select class="form-select" aria-label="Default select example" name="folder_id">
                        @foreach($folders as $key)
                            <option
                                value="{{$key->id}}" {{ old('folder_id') == $key->id ? 'selected' : ''}}>{{$key->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Növ</label>
                    <select class="form-control" id="type" name="type">
                        <option value="Partnyorluq" {{old('type')=='Partnyorluq' ? 'selected' : ''}}>Partnyorluq
                        </option>
                        <option value="Xidmət" {{old('type')=='Xidmət' ? 'selected' : ''}}>Xidmət</option>
                        <option value="Alqı-satqı" {{old('type')=='Alqı-satqı' ? 'selected' : ''}}>Alqı-satqı</option>
                    </select>
                </div>

                <div class="row">
                    <div class="form-group col-6 shopping">
                        <input
                            class="otherside-input"
                            type="radio"
                            name="shopping"
                            id="shopping1"
                            value="Biz alırıq"
                            {{ old('shopping') =='Biz alırıq' ? 'checked' : ''}} checked>
                        <label class="otherside-label" for="shopping1">
                            Biz alırıq
                        </label>
                    </div>
                    <div class="form-group col-6 shopping">
                        <input
                            class="otherside-input"
                            type="radio"
                            name="shopping"
                            id="shopping2"
                            value="Biz satırıq"
                            {{ old('shopping') == 'Biz satırıq' ? 'checked' : ''}}>
                        <label class="otherside-label" for="shopping2">
                            Biz satırıq
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <input
                            class="otherside-input checkperson"
                            type="checkbox"
                            name="other_side_type_check"
                            id="checkperson"
                            value="Fiziki şəxs"
                            {{ old('other_side_type_check') == 'Fiziki şəxs' ? 'checked' : ''}}>
                        <label class="otherside-label" for="checkperson">Fiziki şəxs</label>
                    </div>
                    <div class="form-group col-6">
                        <input
                            class="otherside-input textperson"
                            type="text"
                            name="other_side_type"
                            id="textperson"
                            placeholder="Şirkət adı"
                            @if(old('other_side_type') == 'Fiziki şəxs')
                                disabled
                            @else
                                value="{{ old('other_side_type') }}"
                            @endif>
                    </div>
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
                        <input class="form-control" type="file" id="file" name="file" accept=".pdf">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="col-6 mx-auto d-flex">
                    <button class="btn btn-primary btn-lg active w-50 me-2" type="submit" aria-pressed="true">Yadda saxla</button>
                    <a href="{{route('contracts.index')}}" class="btn btn-secondary btn-lg active w-50" role="button"
                       aria-pressed="true">Çıx</a>
                </div>
            </div>
        </form>
    </div>
    @include('documents.contract.js')
@endsection
