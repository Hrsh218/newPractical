@extends('layouts.home')
@section('content')
    @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="container">
        <h2>Create Player</h2>
        <form method="POST" action="javascript:void(0)">
            <div class="form-group">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                <span class="name-error error-message" id="name"></span>
            </div>
            <div class="form-group">
                <label for="pwd">Date of birth:</label>
                <input type="text" class="form-control" name="dateofbirth" id="datepicker">
                <span class="dob-error error-message" id="date-of-birth"></span>
            </div>

            <div class="form-group">
                <label for="pwd">Teams:</label>
                <select name="teams" class="form-control" id="teams">
                    <option value="">Select Team</option>
                    @foreach ($teams as $team)
                        @if ($team->status == 'active')
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="team-error error-message" id="team"></span>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <label for="status">Activate:</label>
                <input type="radio" id="activate" class="radio-select" name="status" value="active">
                <label for="status">Deactivate:</label>
                <input type="radio" id="deactivate" class="radio-select" name="status" value="deactive">
                <br/>
                <span class="status-error error-message" id="status"></span>
            </div>
            <button type="submit" id="submit-btn" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
@push('extra-js-scripts')
<script>
    $(document).ready(function() {
        // Initialize the datepicker
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd', // Set your desired date format here
            startDate: 'today',
            autoclose: true,
            todayHighlight: true
        });

    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#submit-btn').on('click', function() {
        var message_pri = $(".radio-select:checked").val();
        $.ajax({
            url: '{{ route('player.store') }}',
            type: 'post',
            dataType: "JSON",
            data: {
                "team_id": $('#teams').val(),
                "name": $('#name').val(),
                "date_of_birth": $('#datepicker').val(),
                "status": message_pri
            },
            success: function(response) {
                if (response.redirect) {
                    window.location.href = response.redirect;
                }

            },
            error: function(xhr, status, error) {
                if (xhr.responseJSON.errors.name) {
                    $('.name-error').text('name cannot be empty.');
                } else {
                    $('.name-error').text('');
                }

                if (xhr.responseJSON.errors.date_of_birth) {
                    $('.dob-error').text('Please select date of birth.');
                } else {
                    $('.dob-error').text('');
                }

                if (xhr.responseJSON.errors.team_id) {
                    $('.team-error').text('Please select team.');
                } else {
                    $('.team-error').text('');
                }


                if (xhr.responseJSON.errors.status) {
                    $('.status-error').text('Please select status.');
                } else {
                    $('.status-error').text('');
                }
            }

        });
    });
</script>
@endpush
