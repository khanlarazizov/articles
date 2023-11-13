<!-- Edit Modal -->
<div class="modal fade show" id="editFolderModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <form action="" method="post" id="editFolderForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Qovluq əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="text" name="folder_id" id="folder_id">

                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_folder_name">
                        <span id="folderNameError" class="text-danger error-message"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_folder">Save change</button>
                </div>
            </div>
        </div>
    </form>
</div>

