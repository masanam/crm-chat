@extends('layouts/layoutMaster')

@section('title', 'Team Management')

@section('page-script')
<script type="text/javascript">
  $(function() {
    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('teams.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'description',
          name: 'description'
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
        $.get("{{ route('teams.index') }}" + '/' + data_id + '/edit', function(data) {
          console.log(data);
          (offCanvasElement2.querySelector('.dt-name').value = data.name),
          (offCanvasElement2.querySelector('.dt-description').value = data.description);

        })
        // Open offCanvas with form
        offCanvasE2.show();
      });
    }, 200);




  });
</script>
@endsection

@section('content')
<div class="card">
  <div id="dataTables_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
    <div class="card-header flex-column flex-md-row">
      <div class="head-label text-left">
        <h5 class="card-title mb-0"> List Team</h5>
      </div>
      <div class="dt-action-buttons text-end pt-3 pt-md-0">
        <div class="dt-buttons btn-team flex-wrap">
          <div class="btn-team"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span></span></button></div> <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="create-new d-none d-sm-inline-block waves-effect waves-light">Add New Record</span></span></button>
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

    {!! Form::open(['route' => 'teams.store']) !!}
    <div class="row">
      @include('content.team.fields')
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

    {!! Form::open(['route' => 'teams.store']) !!}
    <div class="row">
      @include('content.team.fields')
    </div>
    {!! Form::close() !!}
  </div>
</div>


@endsection