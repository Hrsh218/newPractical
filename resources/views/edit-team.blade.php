@extends('layouts.home')
@section('content')
    <div class="container">
        <h2>Edit Team</h2>
        <form action="javascript:void(0)" id="fileeditdata" method="post" enctype="multipart/form-data">
            <input type="hidden" name="team_id" id="team_id" value="{{ $team->id }}">
            <div class="form-group">
                <label for="email">Name:</label>
                <input type="text" class="form-control" id="name" value="{{ $team->name }}"
                    placeholder="Enter name" name="name">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" id="status">
                    <option value="active" {{ $team->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="deactive" {{ $team->status == 'deactive' ? 'selected' : '' }}>Deactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="logo">Logo:</label>
                <input type="file" class="form-control" id="logo" name="logo">
                <img src='{{ URL::to('/storage/' . $team->logo) }}' border="0" width="100" height = "100"
                    class="img-rounded" align="center" />;

                @if ($errors->has('logo'))
                    <div class="error-logo">{{ $errors->first('logo') }}</div>
                @endif
            </div>
            <button type="submit" id="submitbutton" class="btn btn-default">Submit</button>
        </form>
    </div>
@endsection
@push('extra-js-scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#submitbutton').on('click', function() {
            var id = $('#team_id').val();
            console.log(id);
            var formData = new FormData($('#fileeditdata')[0]);

            $.ajax({
                url: 'update/' + id,
                type: 'POST',
                dataType: "JSON",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.errors.logo) {
                        $('.error-logo').text('please enter valid file format.');
                    } else {
                        $('.error-logo').text('');
                    }
                }
            });
        });
    </script>
@endpush
