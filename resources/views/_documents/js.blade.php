<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{asset('plugins/amsify/jquery.amsify.suggestags.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"></script>

<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    // $('#reservationdate').datetimepicker({
    //     format: 'L'
    // });

    $('#datepicker').datepicker({
        format: 'yy-mm-dd',
    });

    $(document).on('click','.btnClearFilter', function (event) {
        event.preventDefault();
        $("#protocolFilter").val('').trigger('reset');
    });

    $(document).on('click', '.btnShowDocument', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: 'documents/' + id,
            type: 'get',
            success: function (response) {
                $('#protocol_id').text(response.id);
                $('#protocol_title').text(response.name);
                $('#protocol_name').text(response.name);
                $('#protocol_date').text(response.date);
                $('#protocol_contract_id').text(response.contract.name);
                $('#protocol_other_side_name').text(response.other_side_name);
                $('#protocol_tag').text(response.tag);
                $('#protocol_price').text(response.price);
                $('#protocol_currency').text(response.currency);
            }
        });
    })

    $(document).on('click', '.btnDeleteDocument', function (event) {
        event.preventDefault();
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
                    url: 'documents/' + id,
                    method: 'delete',
                    async:false,
                    success: function (response) {
                        console.log(response);
                        $("#row-" + id).remove();
                        Swal.fire(
                            'Silindi!',
                            'Sənəd silindi.',
                            'success'
                        );
                    }
                });
            }
        });
    });
</script>
