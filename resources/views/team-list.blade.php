<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    @include('includes.list-navbar')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {!! session('message') !!}
            </div>
        @endif
        <div class="alert-message alert-success"></div>

        <h1>Team List</h1>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Status</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

</body>

<script type="text/javascript">
    var table = null;
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('team.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'logo',
                    name: 'logo'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.data-table').on('click', '#delete-btn', function() {
        var id = $(this).data("id");
        $.ajax({
            url: 'delete/' + id,
            type: 'get',
            dataType: "JSON",
            data: {
                "id": id,
            },
            success: function(response) {
                var table = $('.data-table').DataTable();
                table.ajax.reload();
                console.log(response.message);
                $('.alert-message').text('Team is deleted sucessfully.');
            }
        });
    });
</script>

</html>
