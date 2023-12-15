<!-- Create Modal -->
<div class="modal fade show" id="addFolderModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qovluq əlavə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addFolderForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="project_id">Bağlı olduğu Proyekt</label>--}}
{{--                        <select class="form-control" aria-label="Default select example" name="project_id" id="project_id">--}}
{{--                            @foreach($projects as $key )--}}
{{--                                <option value="{{$key->id}}" {{ old('project_id') == $key->id ? 'selected' : '' }}>{{$key->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnFolderStore">Save change</button>
            </div>
        </div>
    </div>

</div>

