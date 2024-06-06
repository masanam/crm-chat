<div class="card-datatable table-responsive-lg pt-0">
    <header class="row px-3">
      <div class="col-sm-12 col-md-6">
        <div class="d-flex align-item-center gap-2">
          <h5 class="text-dark fw-bold">{{ $title }}</h5>
          <small class="badge-team">{{ $badge }}</small>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
        <button
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#{{ $buttonHeaderTarget }}"
        >
          {{ $buttonHeaderName }}
        </button>
      </div>
    </header>
    <table class="datatables-basic table-striped table dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1395px;">
      <thead>
        <tr>
          <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 0px; display: none;" aria-label=""></th>
          @if($isSelectedTable)
          <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th>
          @endif
          
          @if($headers)
          @foreach($headers as $key => $value)
            <th
              class="sorting text-column-header"
              tabindex="0"
              aria-controls="DataTables_Table_0"
              rowspan="1"
              colspan="1"
              style="width: {{ $value->width ?  $value->width : '100px' }};"
              aria-label="{{ $value->name }}: activate to sort column ascending"
            >
              {{ $value->name }}
            </th>
          @endforeach
          @endif
          <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 94px;" aria-label="Actions"></th>
        </tr>
      </thead>
      <tbody>
        {{ $slot }}
      </tbody>
    </table>
    <div class="row px-3">
      <div class="d-flex justify-content-between align-items-center dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
        <a
          aria-controls="DataTables_Table_0"
          aria-disabled="true"
          role="link"
          data-dt-idx="previous"
          tabindex="-1"
          class="page-link btn-pagination"
        >
          <i class="ti ti-arrow-left text-dark"></i>
          Previous
        </a>
        <ul class="pagination">
          <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
          <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
          <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
          <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
          <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="4" tabindex="0" class="page-link">5</a></li>
          <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis"><a aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a></li>
          <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link" data-dt-idx="14" tabindex="0" class="page-link">15</a></li>
        </ul>
        <a
          href="#"
          aria-controls="DataTables_Table_0"
          role="link"
          data-dt-idx="next"
          tabindex="0"
          class="page-link btn-pagination"
        >
          Next
          <i class="ti ti-arrow-right text-dark"></i>
        </a>
      </div>
    </div>
</div>