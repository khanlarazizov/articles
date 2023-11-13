<!-- Modal -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <form action="" method="post" id="updateContractForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Müqavilə Redaktə</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="text" name="contract_id" id="contract_id">

                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="edit_nameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="datapicker">Tarix</label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" name="date" id="edit_date">
                            <span class="input-group-append">
                        <span class="input-group-text bg-white d-block">
                            <i class="fa fa-calendar"></i></span></span>
                        </div>
                        <span id="edit_dateError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="type">Növ</label>
                        <select class="form-control" id="edit_type" name="type">
                            <option>Partnyorluq</option>
                            <option>Xidmət</option>
                            <option>Alqı-satqı</option>
                        </select>
                        <span id="edit_typeError" class="text-danger error-message"></span>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 shopping">
                            <input class="otherside-input" type="radio" name="shopping" id="edit_shopping1"
                                   value="Biz alırıq">
                            <label class="otherside-label" for="otherside">
                                Biz alırıq
                            </label>
                        </div>
                        <div class="form-group col-6 shopping">
                            <input class="otherside-input" type="radio" name="shopping" id="edit_shopping2"
                                   value="Biz satırıq">
                            <label class="otherside-label" for="otherside">
                                Biz satırıq
                            </label>
                        </div>
                        <span id="edit_shoppingError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <input class="otherside-input checkperson" type="checkbox" name="other_side_type"
                                   id="edit_other_side_type1"
                                   value="Fiziki şəxs">
                            <label class="otherside-label" for="otherside">Fiziki şəxs</label>
                        </div>
                        <div class="col-6">
                            <input class="otherside-input textperson" type="text" name="other_side_type"
                                   id="edit_other_side_type2"
                                   placeholder="Şirkət adı">
                        </div>
                        <span id="edit_otherSideTypeError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="other_side_name">Təmsilçi</label>
                        <input type="text" class="form-control" aria-label="First name" id="edit_other_side_name"
                               name="other_side_name">
                        <span id="edit_otherSideNameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="tag">Etiket</label>
                        <input type="text" class="form-control" aria-label="First name" id="edit_tag"
                               name="tag" placeholder="">
                        <span id="edit_tagError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="price">Dəyər</label>
                        <input type="text" class="form-control" aria-label="First name" id="edit_price"
                               name="price">
                        <span id="edit_priceError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="currency">Valyuta</label>
                        <select class="form-control" id="edit_currency" name="currency">
                            <option>AZN</option>
                            <option>USD</option>
                        </select>
                        <span id="edit_currencyError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Fayl seç</label>
                            <input class="form-control" type="file" id="edit_file" name="file">
                        </div>
                        <span id="edit_fileError" class="text-danger error-message"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Çıx</button>
                    <button type="button" class="btn btn-primary update_contract">Redaktə et</button>
                </div>
            </div>
        </div>
    </form>
</div>
