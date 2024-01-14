<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btnCompanyStore', function (e) {
        e.preventDefault();
        $('.error-message').html('');
        let formData = new FormData(document.getElementById('addCompanyForm'));

        $.ajax({
            type: "POST",
            url: "companies",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "success") {
                    $("#addCompanyModal").modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addCompanyForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }

            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name);
            }

        });
    });

    $(document).on('click', '.btnCompanyEdit', function (e) {
        e.preventDefault();
        let company_id = $(this).data('id');

        $('#editCompanyModal').modal('show');

        $.ajax({
            type: "GET",
            url: "companies/" + company_id + "/edit",
            success: function (response) {
                $('#company_id').val(company_id);
                $('#edit_name').val(response.name);
            }
        });
    });

    $(document).on('click', '.btnCompanyUpdate', function (e) {
        e.preventDefault();

        let company_id = $('#company_id').val();
        $('.error-message').html('');
        let formData = new FormData(document.getElementById('editCompanyForm'));

        $.ajax({
            type: "POST",
            url: "companies/" + company_id,
            data: formData,
            // cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#editCompanyModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editCompanyForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#companyNameError').html(error.responseJSON.errors.name);
            }
        });
    });

    $(document).on('click', '.btnCompanyDelete', function (e) {
        e.preventDefault();
        let company_id = $(this).data('id');
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
                    method: 'delete',
                    url: 'companies/' + company_id,
                    async: false,
                    success: function (response) {
                        $("#row-" + company_id).remove();
                        toastr.success('Uğurlu!');
                    }
                });
            }
        })
    });


</script>
