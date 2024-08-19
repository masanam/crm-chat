@extends('layouts/layoutMaster')

@section('title', 'Dealer Management')

@section('page-script')
<script type="text/javascript">
  $(function() {
    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('dealers.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'package',
          name: 'package'
        },
        {
          data: 'due_date',
          name: 'due_date'
        },
        {
          data: 'business_phone',
          name: 'business_phone'
        },
        {
          data: 'wa_account_phone_number_id',
          name: 'wa_account_phone_number_id'
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
        (offCanvasElement.querySelector('.dt-name').value = ''),
        (offCanvasElement.querySelector('.dt-package').value = ''),
        (offCanvasElement.querySelector('.dt-due-date').value = ''),
        (offCanvasElement.querySelector('.dt-phone').value = ''),
        (offCanvasElement.querySelector('.dt-whatsapp').value = ''),
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
        $.get("{{ route('dealers.index') }}" + '/' + data_id + '/edit', function(data) {
          console.log(data);
          (offCanvasElement2.querySelector('.dt-name').value = data.name),
          (offCanvasElement2.querySelector('.dt-package').value = data.package),
          (offCanvasElement2.querySelector('.dt-due-date').value = data.due_date),
          (offCanvasElement2.querySelector('.dt-phone').value = data.business_phone),
          (offCanvasElement2.querySelector('.dt-whatsapp').value = data.wa_account_phone_number_id);
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
        <h5 class="card-title mb-0"> List Dealer</h5>
      </div>
      <div class="dt-action-buttons text-end pt-3 pt-md-0">
        <div class="dt-buttons btn-group flex-wrap">
          <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span></span></button></div> <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="create-new d-none d-sm-inline-block waves-effect waves-light">Add New Record</span></span></button>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive pt-0">
      <table class="table table-bordered data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Package</th>
            <th>Due Date</th>
            <th>Business Phone</th>
            <th>Whatsapp</th>
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

    {!! Form::open(['route' => 'dealers.store']) !!}
    <div class="row">
      @include('content.dealer.fields')
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

    {!! Form::open(['route' => 'dealers.store']) !!}
    <div class="row">
      @include('content.lead.components.fields')
    </div>
    {!! Form::close() !!}
  </div>
</div>


@endsection