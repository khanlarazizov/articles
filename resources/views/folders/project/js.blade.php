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

    $(document).on('click', '.btnProjectStore', function (e) {
        e.preventDefault();
        $('.error-message').html('');
        let formData = new FormData(document.getElementById('addProjectForm'));

        $.ajax({
            type: "POST",
            url: "projects",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "success") {
                    $("#addProjectModal").modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addProjectForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");
                }

            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name);
            }

        });
    });

    $(document).on('click', '.btnProjectEdit', function (e) {
        e.preventDefault();
        $('.error-message').html('');
        let project_id = $(this).data('id');

        $('#editProjectModal').modal('show');

        $.ajax({
            type: "GET",
            url: "projects/" + project_id + "/edit",
            success: function (response) {
                $('#project_id').val(project_id);
                $('#edit_name').val(response.name);
            }
        });
    });

    $(document).on('click', '.btnProjectUpdate', function (e) {
        e.preventDefault();

        let project_id = $('#project_id').val();
        let formData = new FormData(document.getElementById('editProjectForm'));

        $.ajax({
            method: "POST",
            url: "projects/" + project_id,
            data: formData,
            // cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#editProjectModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editProjectForm").trigger('reset');

                    $(".table_content").load(location.href + " .table_content");
                }
            },
            error: function (error) {
                $('#projectNameError').html(error.responseJSON.errors.name);
            }
        });
    });

    $(document).on('click', '.btnProjectDelete', function (e) {
        e.preventDefault();
        let project_id = $(this).data('id');
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
                    url: 'projects/' + project_id,
                    async: false,
                    success: function (response) {
                        $("#row-" + project_id).remove();
                        Swal.fire(
                            'Silindi!',
                            'Layihə silindi.',
                            'success'
                        );
                    }
                });
            }
        })
    });


</script>
