@extends('admin')
@section('title','Protokollar')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Protokollar</h1>
            </div>
        </div>
        <div class="row ms-1">
            <ol class="breadcrumb">
                {{ Breadcrumbs::render('protocol-edit',$protocol) }}
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Protokol Redaktə et</h3>
        </div>
        <form role="form" action="{{route('protocols.update',$protocol->id)}}" method="post" id="editProtocolForm"
              enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                {{--                @if($errors->any())--}}
                {{--                    <div>--}}
                {{--                        <ul>--}}
                {{--                            @foreach($errors->all() as $error)--}}
                {{--                                <li style="color: red">{{$error}}</li>--}}
                {{--                            @endforeach--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                <input type="hidden" name="protocol_id" id="protocol_id" value="{{$protocol->id}}">

                <div class="form-group">
                    <label for="name">Ad</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$protocol->name}}">
                </div>

                <div class="form-group">
                    <label for="datapicker">Tarix</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control" name="date" id="date" value="{{$protocol->date}}">
                        <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="other_side_name">Müqavilə</label>
                    <select class="form-select" aria-label="Default select example" name="contract_id">
                        @foreach($contracts as $key )
                            <option
                                value="{{$key->id}}" {{$protocol->contract_id == $key->id ? "selected" : "" }}>{{$key->name}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="other_side_name">Təmsilçi</label>
                    <input type="text" class="form-control" aria-label="First name" id="other_side_name"
                           name="other_side_name" value="{{$protocol->other_side_name}}">
                </div>

                {{--                <div class="form-group">--}}
                {{--                    <label>Etiket</label>--}}
                {{--                    <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="tag" id="tag">--}}
                {{--                        <option>Alabama</option>--}}
                {{--                        <option>Alaska</option>--}}
                {{--                        <option>California</option>--}}
                {{--                        <option>Delaware</option>--}}
                {{--                        <option>Tennessee</option>--}}
                {{--                        <option>Texas</option>--}}
                {{--                        <option>Washington</option>--}}
                {{--                    </select>--}}
                {{--                </div>--}}

                <div class="form-group">
                    <label for="tag">Etiket</label>
                    <input type="text" class="form-control" aria-label="First name" id="tag"
                           name="tag" placeholder="" value="{{$protocol->tag}}">
                </div>

                <div class="form-group">
                    <label for="price">Dəyər</label>
                    <input type="text" class="form-control" aria-label="First name" id="price"
                           name="price" value="{{$protocol->price}}">
                </div>

                <div class="form-group">
                    <label for="currency">Valyuta</label>
                    <select class="form-control" id="currency" name="currency">
                        <option {{$protocol->currency=='AZN' ? "selected" : "" }}>AZN</option>
                        <option {{$protocol->currency=='USD' ? "selected" : "" }}>USD</option>
                    </select>
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Fayl seç</label><br>
                        <span>{{$protocol->file}}</span>
                        <a href="{{Storage::url('public/documents/protocols/' . $protocol->file)}}"
                           class="btn" download><i class="fa-solid fa-download"></i></a></td>

                        <input class="form-control" type="file" id="file" name="file" accept=".pdf">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="col-6 mx-auto d-flex">
                    <button class="btn btn-primary btn-lg active w-50 me-2 edit_protocol" type="submit" name="insert"
                            aria-pressed="true">Redaktə et
                    </button>
                    <a href="{{route('documents.index')}}" class="btn btn-secondary btn-lg active w-50" role="button"
                       aria-pressed="true">Çıx</a>
                </div>
            </div>
        </form>
    </div>
    @include('documents.protocol.js')
@endsection
