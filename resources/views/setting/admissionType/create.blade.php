<div class="modal-body">
    <div class="text-center mb-4">
        <h3 class="mb-2">Add Admission Type</h3>
        <p class="text-muted">Add Admission Type for Setting.</p>
    </div>
    <form id="admission_types" action="{{ route('setting.admission_types.store') }}" method="POST" class="row">
        <div class="col-12 mb-3">
            <label class="form-label" for="name">Admission Type Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="ex: Regular"
                autofocus />
        </div>
        <div class="col-12 text-center demo-vertical-spacing">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Save</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                aria-label="Close">Cancel</button>
        </div>
    </form>
</div>

<script>
    $("#admission_types").validate({
        rules: {
            name: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter Admission Type"
            }
        }
    });

    $("#admission_types").submit(function(e) {
        e.preventDefault();
        if ($("#admission_types").valid()) {
            $(':input[type="submit"]').prop('disabled', true);
            var formData = new FormData(this);
            formData.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    $(':input[type="submit"]').prop('disabled', false);
                    if (response.status == 'success') {
                        toastr.success(response.message);
                        $(".modal").modal('hide');
                        $('#admission_types-table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(response) {
                    $(':input[type="submit"]').prop('disabled', false);
                    toastr.error(response.responseJSON.message);
                }
            });
        }
    })
</script>
