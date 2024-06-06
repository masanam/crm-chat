@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}">
<!-- Form Validation -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<!-- Form Validation -->
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/tables-datatables-basic.js')}}"></script>
@endsection

@section('content')
<div class="card">
  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
    <div class="card-header flex-column flex-md-row">
      <div class="head-label text-center">
        <h5 class="card-title mb-0">DataTable with Buttons</h5>
      </div>
      <div class="dt-action-buttons text-end pt-3 pt-md-0">
        <div class="dt-buttons btn-group flex-wrap">
          <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span></span></button></div> <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="create-new d-none d-sm-inline-block waves-effect waves-light">Add New Record</span></span></button>
        </div>
      </div>
    </div>

    <div class="card-datatable table-responsive pt-0">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                <option value="7">7</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
                <option value="100">100</option>
              </select> entries</label></div>
        </div>
        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
          <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0"></label></div>
        </div>
      </div>
      <table class="datatables-basic table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1395px;">
        <thead>
          <tr>
            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
            <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 324px;" aria-label="Name: activate to sort column ascending">Name</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 308px;" aria-label="Email: activate to sort column ascending">Email</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 110px;" aria-label="Date: activate to sort column ascending">Date</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 107px;" aria-label="Salary: activate to sort column ascending">Salary</th>
            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 128px;" aria-label="Status: activate to sort column ascending">Status</th>
            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 94px;" aria-label="Actions">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="odd">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">GG</span></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Glyn Giacoppo</span><small class="emp_post text-truncate text-muted">Software Test Engineer</small></div>
              </div>
            </td>
            <td>ggiacoppo2r@apache.org</td>
            <td>04/15/2021</td>
            <td>$24973.48</td>
            <td><span class="badge  bg-label-success">Professional</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="even">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle"></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Evangelina Carnock</span><small class="emp_post text-truncate text-muted">Cost Accountant</small></div>
              </div>
            </td>
            <td>ecarnock2q@washington.edu</td>
            <td>01/26/2021</td>
            <td>$23704.82</td>
            <td><span class="badge  bg-label-warning">Resigned</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="odd">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle"></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Olivette Gudgin</span><small class="emp_post text-truncate text-muted">Paralegal</small></div>
              </div>
            </td>
            <td>ogudgin2p@gizmodo.com</td>
            <td>04/09/2021</td>
            <td>$15211.60</td>
            <td><span class="badge  bg-label-success">Professional</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="even">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">RP</span></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Reina Peckett</span><small class="emp_post text-truncate text-muted">Quality Control Specialist</small></div>
              </div>
            </td>
            <td>rpeckett2o@timesonline.co.uk</td>
            <td>05/20/2021</td>
            <td>$16619.40</td>
            <td><span class="badge  bg-label-warning">Resigned</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="odd">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">AB</span></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Alaric Beslier</span><small class="emp_post text-truncate text-muted">Tax Accountant</small></div>
              </div>
            </td>
            <td>abeslier2n@zimbio.com</td>
            <td>04/16/2021</td>
            <td>$19366.53</td>
            <td><span class="badge  bg-label-warning">Resigned</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="even">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle"></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Edwina Ebsworth</span><small class="emp_post text-truncate text-muted">Human Resources Assistant</small></div>
              </div>
            </td>
            <td>eebsworth2m@sbwire.com</td>
            <td>09/27/2021</td>
            <td>$19586.23</td>
            <td><span class="badge bg-label-primary">Current</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
          <tr class="odd">
            <td class="  control" style="display: none;" tabindex="0"></td>
            <td class="  dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
            <td>
              <div class="d-flex justify-content-start align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">RH</span></div>
                </div>
                <div class="d-flex flex-column"><span class="emp_name text-truncate">Ronica Hasted</span><small class="emp_post text-truncate text-muted">Software Consultant</small></div>
              </div>
            </td>
            <td>rhasted2l@hexun.com</td>
            <td>07/04/2021</td>
            <td>$24866.66</td>
            <td><span class="badge  bg-label-warning">Resigned</span></td>
            <td>
              <div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                <ul class="dropdown-menu dropdown-menu-end m-0">
                  <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                  <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                  <div class="dropdown-divider"></div>
                  <li><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></li>
                </ul>
              </div><a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-primary ti ti-pencil"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 100 entries</div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1" class="page-link">Previous</a></li>
              <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
              <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
              <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
              <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
              <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li>
              <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a></li>
              <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a></li>
              <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div style="width: 1%;"></div>
  </div>

</div>

<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-header flex-column flex-md-row">
    <div class="head-label text-center">
      <h5 class="card-title mb-0">DataTable with Buttons</h5>
    </div>
    <div class="dt-action-buttons text-end pt-3 pt-md-0">
      <div class="dt-buttons btn-group flex-wrap">
        <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2 waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span></span></button></div> <button class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><i class="ti ti-plus me-sm-1"></i> <span class="create-new d-none d-sm-inline-block waves-effect waves-light">Add New Record</span></span></button>
      </div>
    </div>
  </div>



  <div class="card-body table-responsive pt-0">
    <table class="datatables-basic table">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th>id</th>
          <th>Name</th>
          <th>Email</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
      <div class="col-sm-12">
        <label class="form-label" for="basicFullname">Full Name</label>
        <div class="input-group input-group-merge">
          <span id="basicFullname2" class="input-group-text"><i class="ti ti-user"></i></span>
          <input type="text" id="basicFullname" class="form-control dt-full-name" name="basicFullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basicFullname2" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="basicPost">Post</label>
        <div class="input-group input-group-merge">
          <span id="basicPost2" class="input-group-text"><i class='ti ti-briefcase'></i></span>
          <input type="text" id="basicPost" name="basicPost" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="basicEmail">Email</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-mail"></i></span>
          <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
        </div>
        <div class="form-text">
          You can use letters, numbers & periods
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="basicDate">Joining Date</label>
        <div class="input-group input-group-merge">
          <span id="basicDate2" class="input-group-text"><i class='ti ti-calendar'></i></span>
          <input type="text" class="form-control dt-date" id="basicDate" name="basicDate" aria-describedby="basicDate2" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label" for="basicSalary">Salary</label>
        <div class="input-group input-group-merge">
          <span id="basicSalary2" class="input-group-text"><i class='ti ti-currency-dollar'></i></span>
          <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary" placeholder="12000" aria-label="12000" aria-describedby="basicSalary2" />
        </div>
      </div>
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </div>
    </form>

  </div>
</div>
<!--/ DataTable with Buttons -->

<hr class="my-5">

<!-- Complex Headers -->
<div class="card">
  <h5 class="card-header">Complex Headers</h5>
  <div class="card-datatable text-nowrap">
    <table class="dt-complex-header table table-bordered">
      <thead>
        <tr>
          <th rowspan="2">Name</th>
          <th colspan="2">Contact</th>
          <th colspan="3">HR Information</th>
          <th rowspan="2">Action</th>
        </tr>
        <tr>
          <th>E-mail</th>
          <th>City</th>
          <th>Position</th>
          <th>Salary</th>
          <th class="border-1">Status</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Complex Headers -->

<hr class="my-5">

<!-- Row grouping -->
<div class="card">
  <h5 class="card-header">Row Grouping</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-row-grouping table">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Position</th>
          <th>Email</th>
          <th>City</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Position</th>
          <th>Email</th>
          <th>City</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
<!--/ Row grouping -->

<hr class="my-5">

<!-- Multilingual -->
<div class="card">
  <h5 class="card-header">Multilingual</h5>
  <div class="card-datatable table-responsive">
    <table class="dt-multilingual table">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Position</th>
          <th>Email</th>
          <th>Date</th>
          <th>Salary</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Multilingual -->

@endsection