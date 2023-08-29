<!-- Modal -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="addContractForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Müqavilə əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="datapicker">Tarix</label>
                        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" name="date" id="date">
                            <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                        </div>
                        <span id="dateError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="type">Növ</label>
                        <select class="form-control" id="type" name="type">
                            <option>Partnyorluq</option>
                            <option>Xidmət</option>
                            <option>Alqı-satqı</option>
                        </select>
                        <span id="typeError" class="text-danger error-message"></span>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 shopping">
                            <input class="otherside-input" type="radio" name="shopping" id="shopping1"
                                   value="Biz alırıq" checked>
                            <label class="otherside-label" for="otherside">
                                Biz alırıq
                            </label>
                        </div>
                        <div class="form-group col-6 shopping">
                            <input class="otherside-input" type="radio" name="shopping" id="shopping1"
                                   value="Biz satırıq">
                            <label class="otherside-label" for="otherside">
                                Biz satırıq
                            </label>
                        </div>
                        <span id="shoppingError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <input class="otherside-input checkperson" type="checkbox" name="other_side_type"
                                   id="other_side_type"
                                   value="Fiziki şəxs">
                            <label class="otherside-label" for="otherside">Fiziki şəxs</label>
                        </div>
                        <div class="col-6">
                            <input class="otherside-input textperson" type="text" name="other_side_type"
                                   id="other_side_type"
                                   placeholder="Şirkət adı">
                        </div>
                        <span id="otherSideTypeError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="other_side_name">Təmsilçi</label>
                        <input type="text" class="form-control" aria-label="First name" id="other_side_name"
                               name="other_side_name">
                        <span id="otherSideNameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="tag">Etiket</label>
                        <input type="text" class="form-control" aria-label="First name" id="tag"
                               name="tag" placeholder="">
                        <span id="tagError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="price">Dəyər</label>
                        <input type="text" class="form-control" aria-label="First name" id="price"
                               name="price">
                        <span id="priceError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="currency">Valyuta</label>
                        <select class="form-control" id="currency" name="currency">
                            <option>AZN</option>
                            <option>USD</option>
                        </select>
                        <span id="currencyError" class="text-danger error-message"></span>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <div class="custom-file">--}}
{{--                            <input type="file" class="custom-file-input" id="file" name="file">--}}
{{--                            <label class="custom-file-label" for="customFile">Fayl seç</label>--}}
{{--                        </div>--}}
{{--                        <span id="fileError" class="text-danger error-message"></span>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Fayl seç</label>
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                        <span id="fileError" class="text-danger error-message"></span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Çıx</button>
                    <button type="button" class="btn btn-primary add_contract">Əlavə et</button>
                </div>
            </div>
        </div>
    </form>
</div>
