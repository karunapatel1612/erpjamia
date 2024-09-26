@extends('layouts.main')

@section('content')
<div class="">
    <button type="button" onclick="addBoard()" class="btn btn-primary" id="addUniversityBtn">
        Add University
    </button>
</div>

<div class="modal fade" id="universityModal" tabindex="-1" role="dialog" aria-labelledby="universityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalContent">
        </div>
    </div>
</div>

<script type="text/javascript">
    function addBoard() {
        $.ajax({
            url: "{{ route('academics.board.add') }}",
            type: 'GET',
            success: function(data) {
                $('#modalContent').html(data);
                $('#universityModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>
@endsection