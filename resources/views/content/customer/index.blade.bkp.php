@extends('layouts/layoutMaster')

@section('title', 'Task Management')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tasks.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'status_id',
                    name: 'status_id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'deadline',
                    name: 'deadline'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'priority',
                    name: 'priority'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        const formAddNewRecord = document.getElementById('form-add-new-record');
        setTimeout(() => {
            const newRecord = document.querySelector('.create-new'),
                offCanvasElement = document.querySelector('#add-new-record');
            // To open offCanvas, to add new record
            newRecord.addEventListener('click', function() {
                offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                (offCanvasElement.querySelector('.dt-data-id').value = '');
                // Empty fields on offCanvas open
                // (offCanvasElement.querySelector('.dt-name').value = ''),
                // (offCanvasElement.querySelector('.dt-location').value = ''),
                // (offCanvasElement.querySelector('.dt-due-date').value = ''),
                // (offCanvasElement.querySelector('.dt-phone').value = ''),
                // (offCanvasElement.querySelector('.dt-whatsapp').value = ''),
                // Open offCanvas with form
                offCanvasEl.show();
            });
        }, 200);
        const formEditRecord = document.getElementById('form-edit-record');
        setTimeout(() => {
            const editRecord = document.querySelector('.editRecord'),
                offCanvasElement2 = document.querySelector('#edit-record');
            // To open offCanvas, to add new record
            $('body').on('click', '.editRecord', function() {
                offCanvasE2 = new bootstrap.Offcanvas(offCanvasElement2);
                // Empty fields on offCanvas open
                var data_id = $(this).data('id');
                $.get("{{ route('tasks.index') }}" + '/' + data_id + '/edit', function(data) {
                    console.log(data);
                    (offCanvasElement2.querySelector('.dt-project').value = data.project_id),
                    (offCanvasElement2.querySelector('.dt-user').value = data.user_id),
                    (offCanvasElement2.querySelector('.dt-status').value = data.status_id);
                    (offCanvasElement2.querySelector('.dt-title').value = data.title),
                    (offCanvasElement2.querySelector('.dt-deadline').value = data.deadline),
                    (offCanvasElement2.querySelector('.dt-description').value = data.description),
                    (offCanvasElement2.querySelector('.dt-priority').value = data.priority);
                    (offCanvasElement2.querySelector('.dt-data-id').value = data.id);
                })
                // Open offCanvas with form
                offCanvasE2.show();
            });
        }, 200);
        $('body').on('click', '.deleteRecord', function() {
            var data_id = $(this).data('id');
            confirm("Are You sure want to delete !");
            $.ajax({
                type: "DELETE",
                url: "{{ route('tasks.store') }}" + '/' + data_id,
                data: {
                    'id': data_id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>
@endsection

@section('content')

<div class="card">
    <div id="dataTables_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
        <div class="card-header flex-column flex-md-row">
            <div class="head-label text-left">
                <h5 class="card-title mb-0"> List Task</h5>
            </div>
            <div class="dt-action-buttons text-end pt-3 pt-md-0">
                <div class="dt-buttons btn-task flex-wrap">
                    <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="create-new d-none d-sm-inline-block waves-effect waves-light">Add New Record</span></span></button>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive pt-0">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">

        {!! Form::open(['route' => 'tasks.store']) !!}
        <div class="row">
            @include('content.task.fields')
        </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- Modal to edit record -->
<div class="offcanvas offcanvas-end" id="edit-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Edit Record</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">

        {!! Form::open(['route' => 'tasks.store']) !!}
        <div class="row">
            @include('content.task.fields')
        </div>
        {!! Form::close() !!}
    </div>
</div>


@endsection