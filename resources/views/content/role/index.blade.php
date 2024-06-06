@extends('layouts/layoutMaster')

@section('title', 'Role Management')
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
      ajax: "{{ route('roles.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'display_name',
          name: 'display_name'
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
        $.get("{{ route('roles.index') }}" + '/' + data_id + '/edit', function(data) {
          console.log(data);
          (offCanvasElement2.querySelector('.dt-name').value = data.name),
          (offCanvasElement2.querySelector('.dt-description').value = data.description),
          (offCanvasElement2.querySelector('.dt-code').value = data.code);

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
        url: "{{ route('roles.store') }}" + '/' + data_id,
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
        <h5 class="card-title mb-0"> List Role</h5>
      </div>
      <div class="dt-action-buttons text-end pt-3 pt-md-0">
        <div class="dt-buttons btn-role flex-wrap">
          <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-2 text-nowrap add-new-role waves-effect waves-light">Add New Role</button>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive pt-0">
      <table class="table table-bordered data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Label</th>
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

    {!! Form::open(['route' => 'roles.store']) !!}
    <div class="row">
      @include('content.role.fields')
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

    {!! Form::open(['route' => 'roles.store']) !!}
    <div class="row">
      @include('content.role.fields')
    </div>
    {!! Form::close() !!}
  </div>
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
    <div class="modal-content p-3 p-md-5">
      <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
        <div class="text-center mb-4">
          <h3 class="role-title mb-2">Add New Role</h3>
          <p class="text-muted">Set role permissions</p>
        </div>
        <!-- Add role form -->
        <form id="addRoleForm" class="row g-3" onsubmit="return false">
          <div class="col-12 mb-4">
            <label class="form-label" for="modalRoleName">Role Name</label>
            <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter a role name" tabindex="-1" />
          </div>
          <div class="col-12">
            <h5>Role Permissions</h5>
            <!-- Permission table -->
            <div class="table-responsive">
              <table class="table table-flush-spacing">
                <tbody>
                  <tr>
                    <td class="text-nowrap fw-medium">Administrator Access <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll" />
                        <label class="form-check-label" for="selectAll">
                          Select All
                        </label>
                      </div>
                    </td>
                  </tr>
                  @foreach($permissions as $key=>$value)

                  <tr>
                    <td class="text-nowrap fw-medium">{{$value->display_name}}</td>
                    <td>
                      <div class="d-flex">
                        <div class="form-check me-3 me-lg-5">
                          <input class="form-check-input" type="checkbox" id="userManagementRead" />
                          <label class="form-check-label" for="userManagementRead">
                            Read
                          </label>
                        </div>
                        <div class="form-check me-3 me-lg-5">
                          <input class="form-check-input" type="checkbox" id="userManagementWrite" />
                          <label class="form-check-label" for="userManagementWrite">
                            Write
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="userManagementCreate" />
                          <label class="form-check-label" for="userManagementCreate">
                            Create
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- Permission table -->
          </div>
          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
        <!--/ Add role form -->
      </div>
    </div>
  </div>
</div>
<!--/ Add Role Modal -->
@endsection