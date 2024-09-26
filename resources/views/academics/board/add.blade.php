<div class="modal-header">
    <h5 class="modal-title" id="universityModalLabel">Add University</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="universityForm" action="{{ route('boards.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <!-- University Type Selection -->
            <div class="col-md-12">
                <div class="form-group form-group-default required">
                    <label>Dealing with</label>
                    <select class="form-control" name="university_type" id="university_type" aria-label="Select University Type" required>
                        <option value="0">Outsourced Partners</option>
                        <option value="1">Inhouse i.e. Students</option>
                        <option value="2">Both</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Name and Short Name -->
            <div class="col-md-6">
                <div class="form-group form-group-default required">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="e.g., XYZ University" required aria-label="University Name">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group form-group-default required">
                    <label for="short_name">Short Name</label>
                    <input type="text" name="short_name" id="short_name" class="form-control" placeholder="e.g., XYZU" required aria-label="University Short Name">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Vertical and Address -->
            <div class="col-md-6">
                <div class="form-group form-group-default required">
                    <label for="vertical">Vertical</label>
                    <input type="text" name="vertical" id="vertical" class="form-control" placeholder="e.g., Technical" required aria-label="Vertical">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group form-group-default required">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="2" placeholder="e.g., 23 Street, California, USA 681971" required aria-label="Address"></textarea>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <!-- Logo Upload -->
            <div class="col-md-12">
                <label for="logo">Logo*</label>
                <input type="file" name="logo" id="logo" class="dropify" accept="image/png, image/jpg, image/jpeg, image/svg" data-height="200" required aria-label="Upload Logo">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <i class="ti-save mr-2"></i> Save
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#universityForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'University added successfully!',
                    }).then(() => {
                        $('#universityForm')[0].reset();
                        $('#universityModal').modal('hide');
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error adding the university: ' + xhr.responseJSON.message || 'Unexpected error.',
                    });
                }
            });
        });
    });
</script>