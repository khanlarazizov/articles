<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/amsify/jquery.amsify.suggestags.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        // $('.table').DataTable();

        $('input[name="tag"]').amsifySuggestags({
            tagLimit: 10
        });

        $('#datepicker').datepicker({
            format: 'yy-mm-dd',
        });

        $('.checkperson').click(function () {
            if ($(this).is(':checked')) {
                $('.textperson').attr('disabled', 'disabled');
            } else {
                $('.textperson').removeAttr('disabled');
                $('.textperson').focus();
            }
        })
        fetch()

        function fetch() {
            var i = 1;
            var urlpdf = '{{ URL::asset('/public/documents/contracts/') }}'
            $.ajax({
                type: "GET",
                url: "contract.fetch",
                dataType: "json",
                success: function (response) {
                    $('tbody').html('');
                    $.each(response.contract, function (key, item) {
                        $('tbody').append('<tr>\
                            <td>' + i++ + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.shopping + '</td>\
                            <td>' + item.date + '</td>\
                            <td>' + item.price + " " + item.currency + '</td>\
                            <td><a href="" class="btn edit_contract_icon" data-id="' + item.id + '"><i class="fa-regular fa-pen-to-square" style="color: #34c832;"></i></a></td>\
                            <td><a href="" class="btn delete_contract" data-id="' + item.id + '"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></a></td>\
                           </tr>');
                    });
                }
            });
        };
        // <td><a href="" class="btn download_contract" data-id="' + item.id + '" data-file="'+item.file+'"><i class="fa-solid fa-download" style="color: #000000;"></i></a></td>\

        // <td><a href="" download="/public/storage/documents/contracts/' + item.file + '" ><i class="fa-solid fa-download" style="color: #000000;"></i></a></td>\
        {{--$(document).on('click', '.download_contract', function(e) {--}}
        {{--    e.preventDefault();--}}
        {{--    var fileName = $(this).data('file');--}}
        {{--    var valFileDownloadPath = '{{ asset('public/documents/contracts/') }}/' + fileName;--}}
        {{--    console.log(valFileDownloadPath);--}}
        {{--    window.open(valFileDownloadPath, '_blank');--}}
        {{--});--}}

        $(document).on('click', '.add_contract', function (e) {
            e.preventDefault();

            $('.error-message').html('');

            let formData = new FormData(document.getElementById('addContractForm'));
            $.ajax({
                type: "POST",
                url: "contract.store",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#addContractForm').trigger('reset');

                        $('.textperson').removeAttr('disabled');
                        $('#tag').html('');

                        $('#addModal').modal('hide');
                        $('.modal-backdrop').remove();
                        $('input[name="tag"]').amsifySuggestags(response, 'refresh');

                        Swal.fire({
                            icon: 'success',
                            title: 'Müqavilə əlavə edildi.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        fetch();
                        // $('.table').load(location.href + ' .table');
                    }
                },
                error: function (err) {
                    if (err) {
                        console.log('123')
                        $('#edit_nameError').html(err.responseJSON.errors.name);
                        $('#edit_dateError').html(err.responseJSON.errors.date);
                        $('#edit_typeErrorError').html(err.responseJSON.errors.type);
                        $('#edit_shoppingError').html(err.responseJSON.errors.shopping);
                        $('#edit_otherSideTypeError').html(err.responseJSON.errors.other_side_type);
                        $('#edit_otherSideNameError').html(err.responseJSON.errors.other_side_name);
                        $('#edit_tagError').html(err.responseJSON.errors.tag);
                        $('#edit_priceError').html(err.responseJSON.errors.price);
                        $('#edit_currencyError').html(err.responseJSON.errors.currency);
                        $('#edit_fileError').html(err.responseJSON.errors.file);
                    }
                }
            });
        })

        $(document).on('click', '.edit_contract_icon', function (e) {
            e.preventDefault();

            var contract_id = $(this).data('id');
            $('#updateModal').modal('show');
            console.log(contract_id);

            $.ajax({
                type: 'GET',
                url: 'contract.edit.' + contract_id,
                success: function (response) {
                    if (response.status == 'failure') {
                        alert(response.message);
                        $('#updateModal').modal('hide');
                        $('.modal-backdrop').remove();
                    } else {
                        $('#contract_id').val(contract_id);
                        $('#edit_name').val(response.name);
                        $('#edit_date').val(response.date);
                        $('#edit_type').val(response.type);
                        $('#edit_shopping1').val(response.shopping);
                        $('#edit_other_side_type').val(response.other_side_type);
                        $('#edit_other_side_name').val(response.other_side_name);
                        $('#edit_tag').val(response.tag);
                        $('#edit_price').val(response.price);
                        // $('#edit_file').val(response.file);
                    }
                }
            });
            $(document).on('click', '.update_contract', function (e) {
                e.preventDefault();
                let formData = new FormData(document.getElementById('updateContractForm'));
                $.ajax({
                    url: 'contract.update' + '.' + contract_id,
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire(
                            'Updated!',
                            'Employee Updated Successfully!',
                            'success'
                        )
                        fetch();

                        $('#updateContractForm').trigger('reset');

                        $('.textperson').removeAttr('disabled');

                        $('#updateModalModal').modal('hide');
                        $('.modal-backdrop').remove();
                        $('input[name="tag"]').amsifySuggestags(response, 'refresh');
                    }
                });
            });
        });

        $(document).on('click', '.delete_contract', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Əminsinizmi?',
                text: "Bunu geri qaytara bilməyəcəksiniz!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'contract.delete' + '.' + id,
                        method: 'delete',
                        success: function (response) {
                            console.log(response);
                            Swal.fire(
                                'Silindi!',
                                'Müqavilə silindi.',
                                'success'
                            )
                            fetch();
                        }
                    });
                }
            })
        });
    });
</script>
