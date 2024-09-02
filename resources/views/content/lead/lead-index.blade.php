@extends('layouts/layoutMaster')

@section('title', 'Lead Generation Management')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
<script type="text/javascript">
  $(function() {
    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('lead-gen.customer-list') }}",
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'customer_name',
          name: 'Customer Name'
        },
        {
          data: 'phone',
          name: 'Whatsapp'
        },
        {
          data: 'location',
          name: 'Location'
        },
        {
          data: 'age',
          name: 'Age'
        },
        {
          data: 'gender',
          name: 'Gender'
        },
        {
          data: 'income_level',
          name: 'Income Level'
        },
        {
          data: 'seniority',
          name: 'Seniority'
        },
        {
          data: 'job_title',
          name: 'Job Title'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    const token = $("meta[name='csrf-token']").attr("content");
    const formAddNewRecord = document.getElementById('form-add-new-record');
    let currentId = ''

    setTimeout(() => {
      const newRecord = document.querySelector('.create-new'),
        offCanvasElement = document.querySelector('#add-new-record');

      // To open offCanvas, to add new record
      newRecord.addEventListener('click', function() {
        offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        // Empty fields on offCanvas open
        (offCanvasElement.querySelector('.dt-customer-name').value = ''),
        (offCanvasElement.querySelector('.dt-phone').value = ''),
        (offCanvasElement.querySelector('.dt-location').value = ''),
        (offCanvasElement.querySelector('.dt-age').value = ''),
        (offCanvasElement.querySelector('.dt-gender').value = ''),
        (offCanvasElement.querySelector('.dt-income-level').value = ''),
        (offCanvasElement.querySelector('.dt-seniority').value = ''),
        (offCanvasElement.querySelector('.dt-job-title').value = ''),
        (offCanvasElement.querySelector('.dt-industry').value = ''),
        (offCanvasElement.querySelector('.dt-email').value = ''),
        (offCanvasElement.querySelector('.dt-link-linkedin').value = ''),
        (offCanvasElement.querySelector('.dt-url').value = ''),
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
        currentId = $(this).attr('data-id');

        // change attr id form update
        $('.form-customer-update').attr('action', `${baseUrl}api/lead-generation/${currentId}`)

        fetch(`${baseUrl}api/lead-generation/${currentId}`, {
          method: 'GET',
          headers: {
            'X-CSRF-TOKEN': token
          }
        })
        .then(r => r.json())
        .then(res => {
          const { age, customer_name, gender, income_level, seniority, job_title, phone, location, industry, email, linkedin, url } = res.data
          offCanvasElement2.querySelector('.dt-customer-name').value = res.data.customer_name
          offCanvasElement2.querySelector('.dt-phone').value = phone
          offCanvasElement2.querySelector('.dt-location').value = location
          offCanvasElement2.querySelector('.dt-age').value = age
          offCanvasElement2.querySelector('.dt-gender').value = gender
          offCanvasElement2.querySelector('.dt-income-level').value = income_level
          offCanvasElement2.querySelector('.dt-seniority').value = seniority
          offCanvasElement2.querySelector('.dt-job-title').value = job_title
          offCanvasElement2.querySelector('.dt-industry').value = industry
          offCanvasElement2.querySelector('.dt-email').value = email
          offCanvasElement2.querySelector('.dt-link-linkedin').value = linkedin
          offCanvasElement2.querySelector('.dt-url').value = url
        })
        // Open offCanvas with form
        offCanvasE2.show();
      });
    }, 200);


    setTimeout(() => {
      const btnDelete = $('.btn-danger')
      if (btnDelete && btnDelete.length > 0) {
        btnDelete.each(function() {
          $(this).on('click', function() {
            let postId = $(this).attr('data-id');
            fetch(`${baseUrl}api/lead-generation/${postId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': token
              }
            })
            .then(r => r.text())
            .then(res => {
              $(this).parent().parent().remove()
            })
          })
        })
      }
    }, 3000)
  });
</script>
@endsection

@section('content')
<div class="card">
  <div id="dataTables_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
    <div class="card-header flex-column flex-md-row">
      <div class="head-label text-left">
        <h5 class="card-title mb-0"> List Lead Generation Customer</h5>
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
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Income Level</th>
            <th>Seniority</th>
            <th>Job Title</th>
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

    {!! Form::open(['route' => 'lead-gen.create-customer']) !!}
    <div class="row">
      @include('content.lead.components.fields')
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
    <form class="form-customer-update pt-0 row g-2" id="" action="{{route('lead-gen.update-customer', 10)}}" method="POST">
      @csrf @method('put')
      <div class="row">
        @include('content.lead.components.fields')
      </div>
    </form>
  </div>
</div>


@endsection