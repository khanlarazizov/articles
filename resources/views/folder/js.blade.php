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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.add_folder',function (e) {
        e.preventDefault();
        $('.error-message').html('');
        let formData = new FormData(document.getElementById('addFolderForm'));

        $.ajax({
            type:"POST",
            url:"store",
            data:formData,
            contentType:false,
            processData:false,
            success: function (response) {
                if (response.status=="success"){
                    $("#addFolderModal").modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addFolderForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");
                }

            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name);
            }

        });
    });

    $(document).on('click','.edit_folder',function (e) {
        e.preventDefault();
        $('.error-message').html('');
        let folder_id = $(this).data('id');

        $('#editFolderModal').modal('show');

        $.ajax({
            type:"GET",
            url:"edit" + "/" + folder_id,
            success: function (response) {
                $('#folder_id').val(folder_id);
                $('#edit_folder_name').val(response.name);
            }
        });
    });

    $(document).on('click','.update_folder',function (e) {
        e.preventDefault();

        let folder_id = $('#folder_id').val();
        let formData = new FormData(document.getElementById('editFolderForm'));

        $.ajax({
            type: 'post',
            url: "update" + "/" + folder_id,
            data: formData,
            dataType: 'json',
            contentType:false,
            processData:false,
            success: function (response) {
                if (response.status == 'success'){
                    console.log('asdad');
                    $('#editFolderModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editFolderForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");
                }
            },
            error: function (error) {
                console.log('ddd');
                $('#folderNameError').html(error.responseJSON.errors.name);
            }

        });


    });

    $(document).on('click','.delete_folder',function (e) {
        e.preventDefault();
        let folder_id = $(this).data('id');
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
                    url:'delete' + '/' + folder_id,
                    async:false,
                    success: function (response) {
                        $("#row-" + folder_id).remove();
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





</script>
