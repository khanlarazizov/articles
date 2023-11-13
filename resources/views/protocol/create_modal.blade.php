<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="addProtocolForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Protokol əlavə et</h5>
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
                        <label for="other_side_name">Müqavilə</label>
                        <select class="form-select" aria-label="Default select example" name="contract_id">
                            @foreach($contracts as $key )
                                <option value="{{$key->id}}">{{$key->name}}</option>
                            @endforeach
                        </select>
                        <span id="contractError" class="text-danger error-message"></span>
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

                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Fayl seç</label>
                            <input class="form-control" type="file" id="file" name="file">
                        </div>
                        <span id="fileError" class="text-danger error-message"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_protocol">Save change</button>
                </div>
            </div>
        </div>
    </form>
</div>
