<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="{{asset('plugins/amsify/jquery.amsify.suggestags.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.js"></script>--}}

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
                $('.textperson').attr('disabled', true);
            } else {
                $('.textperson').removeAttr('disabled');
                $('.textperson').focus();
            }
        });

        $('#addContractForm').validate({
            ignore: [],
            rules: {
                name: {
                    required: true
                },
                date: {
                    required: true
                },
                other_side_name: {
                    required: true
                },
                type: {
                    required: true
                },
                price: {
                    required: true
                },
                tag: {
                    required: true
                },
                shopping: {
                    required: true
                },
                other_side_type:{
                    required: true
                },
                currency: {
                    required: true
                },
                file: {
                    required: true,
                    accept: "pdf"
                }
            },
            messages: {
                name: {
                    required: 'Ad daxil edin'
                },
                date: {
                    required: 'Tarix daxil edin'
                },
                other_side_name: {
                    required: 'Təmsilçini daxil edin'
                },
                type: {
                    required: 'Tip daxil edin'
                },
                shopping: {
                    required: 'Alırıq/Satırıq daxil edin'
                },
                other_side_type: {
                    required: 'İmzalayan tərəfi daxil edin'
                },
                price: {
                    required: 'Dəyər daxil edin'
                },
                tag: {
                    required: 'Etiket daxil edin'
                },
                file: {
                    required: 'Fayl daxil edin',
                    accept: 'Fayl pdf olmalıdır'
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        $('#editContractForm').validate({
            ignore: [],
            rules: {
                name: {
                    required: true
                },
                date: {
                    required: true
                },
                other_side_name: {
                    required: true
                },
                type: {
                    required: true
                },
                price: {
                    required: true
                },
                tag: {
                    required: true
                },
                shopping: {
                    required: true
                },
                other_side_type: {
                    required: true
                },
                currency: {
                    required: true
                },
                file: {
                    accept: "pdf"
                }
            },
            messages: {
                name: {
                    required: 'Ad daxil edin'
                },
                date: {
                    required: 'Tarix daxil edin'
                },
                other_side_name: {
                    required: 'Təmsilçini daxil edin'
                },
                type: {
                    required: 'Tip daxil edin'
                },
                shopping: {
                    required: 'Alırıq/Satırıq daxil edin'
                },
                other_side_type: {
                    required: 'İmzalayan tərəfi daxil edin'
                },
                price: {
                    required: 'Dəyər daxil edin'
                },
                tag: {
                    required: 'Etiket daxil edin'
                },
                file: {
                    accept: "Fayl pdf olmalıdır"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $(document).on('click', '.btnShowContract', function (event) {
            event.preventDefault();
            var id = $(this).data("id");

            $.ajax({
                url: 'contracts/' + id,
                type: 'get',
                success: function (response) {
                    $('#contract_title').text(response.name)
                    $('#contract_name').text(response.name)
                    $('#contract_date').text(response.date)
                    $('#contract_folder_id').text(response.folder.name)
                    $('#contract_type').text(response.type)
                    $('#contract_shopping').text(response.shopping)
                    $('#contract_other_side_type').text(response.other_side_type)
                    $('#contract_other_side_name').text(response.other_side_name)
                    $('#contract_tag').text(response.tag)
                    $('#contract_price').text(response.price)
                    $('#contract_currency').text(response.currency)
                }
            });
        })

        $(document).on('click', '.btnDeleteContract', function (e) {
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
                        url: 'contracts' + '/' + id,
                        method: 'delete',
                        async: false,
                        success: function (response) {
                            console.log(response);
                            $("#row-" + id).remove();
                            Swal.fire(
                                'Silindi!',
                                'Müqavilə silindi.',
                                'success'
                            );
                        }
                    });
                }
            })
        });

        // $(document).on('click', '.contract_button', function (e) {
        //     $('.error-message').html('');
        //     $('.textperson').attr('value', '');
        //     $('.textperson').removeAttr('disabled');
        //     $('.checkperson').attr('checked', false);
        // });

        // $(document).on('click', '.add_contract', function (e) {
        //     e.preventDefault();
        //     $('.error-message').html('');
        //     let formData = new FormData(document.getElementById('addContractForm'));
        //     $.ajax({
        //         type: "POST",
        //         url: "store",
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function (response) {
        //             if (response.status == 'success') {
        //                 $('#addContractForm').trigger('reset');
        //                 $('.textperson').removeAttr('disabled');
        //                 $('#tag').html('');
        //
        //                 // $('#addModal').modal('hide');
        //                 // $('.modal-backdrop').remove();
        //                 $('input[name="tag"]').amsifySuggestags(response, 'refresh');
        //
        //                 // window.location.href = 'folder';
        //                 toastr.success('Uğurlu');
        //                 // $('.table').load(location.href + ' .table');
        //             }
        //         },
        //         error: function (err) {
        //             if (err) {
        //                 $('#nameError').html(err.responseJSON.errors.name);
        //                 $('#dateError').html(err.responseJSON.errors.date);
        //                 $('#folderError').html(err.responseJSON.errors.folder_id);
        //                 $('#typeErrorError').html(err.responseJSON.errors.type);
        //                 $('#shoppingError').html(err.responseJSON.errors.shopping);
        //                 $('#otherSideTypeError').html(err.responseJSON.errors.other_side_type);
        //                 $('#otherSideNameError').html(err.responseJSON.errors.other_side_name);
        //                 $('#tagError').html(err.responseJSON.errors.tag);
        //                 $('#priceError').html(err.responseJSON.errors.price);
        //                 $('#currencyError').html(err.responseJSON.errors.currency);
        //                 $('#fileError').html(err.responseJSON.errors.file);
        //             }
        //         }
        //     });
        // })

        // $(document).on('click', '.edit_contract_icon', function (e) {
        //     e.preventDefault();
        //
        //     var contract_id = $(this).data('id');
        //     $('#updateModal').modal('show');
        //     console.log(contract_id);
        //
        //     $.ajax({
        //         type: 'GET',
        //         url: 'edit/' + contract_id,
        //         success: function (response) {
        //             if (response.status == 'failure') {
        //                 alert(response.message);
        //                 $('#updateModal').modal('hide');
        //                 $('.modal-backdrop').remove();
        //             } else {
        //                 if (response.shopping == 'Biz alırıq') {
        //                     $('#edit_shopping2').attr('checked', false);
        //                     $('#edit_shopping1').attr('checked', true);
        //
        //                 } else {
        //                     $('#edit_shopping1').attr('checked', false);
        //                     $('#edit_shopping2').attr('checked', true);
        //                 }
        //                 ;
        //
        //                 if (response.other_side_type == 'Fiziki şəxs') {
        //                     $('.checkperson').attr('checked', true);
        //                     $('.textperson').attr('value', '');
        //                     $('.textperson').attr('disabled', true);
        //
        //                 } else {
        //                     $('.checkperson').attr('checked', false);
        //                     $('.textperson').removeAttr('disabled');
        //                     $('.textperson').attr('value', response.other_side_type);
        //                 }
        //
        //
        //                 $('#updateContractForm').trigger('reset');
        //
        //                 $('#contract_id').val(contract_id);
        //                 $('#edit_name').val(response.name);
        //                 $('#edit_date').val(response.date);
        //                 $('#edit_other_side_name').val(response.other_side_name);
        //                 $('#edit_tag').val(response.tag);
        //                 $('#edit_price').val(response.price);
        //                 // $('#edit_file').val(response.file);
        //             }
        //         }
        //     });
        //     $(document).on('click', '.update_contract', function (e) {
        //         e.preventDefault();
        //         let formData = new FormData(document.getElementById('updateContractForm'));
        //         $.ajax({
        //             url: 'update' + '/' + contract_id,
        //             type: 'post',
        //             data: formData,
        //             cache: false,
        //             contentType: false,
        //             processData: false,
        //             dataType: 'json',
        //             success: function (response) {
        //
        //                 $('#updateContractForm').trigger('reset');
        //                 $('.textperson').removeAttr('disabled');
        //                 $('#tag').html('');
        //
        //                 $('#updateModal').modal('hide');
        //                 $('.modal-backdrop').remove();
        //                 $('input[name="tag"]').amsifySuggestags(response, 'refresh');
        //                 Swal.fire(
        //                     'Updated!',
        //                     'Employee Updated Successfully!',
        //                     'success'
        //                 );
        //             }
        //         });
        //     });
        // });
    });
</script>
