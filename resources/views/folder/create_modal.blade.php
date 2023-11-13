<!-- Create Modal -->
<div class="modal fade show" id="addFolderModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="addFolderForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Qovluq əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_folder">Save change</button>
                </div>
            </div>
        </div>
    </form>
</div>

