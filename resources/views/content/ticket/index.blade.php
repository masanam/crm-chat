@extends('layouts/layoutMaster')

@section('title', 'Kanban - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jkanban/jkanban.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('css/components/ticket-kanban.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor//libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor//libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor//libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor//libs/jkanban/jkanban.js')}}"></script>
<script src="{{asset('assets/vendor//libs/toastr/toastr.js')}}"></script>
<script src="{{asset('assets/vendor//libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor//libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/components/ticket-kanban.js')}}"></script>
<script>
  $(function () {
    // Select2
    var select2 = $('.select2');
    if (select2.length) {
      select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>').select2({
          dropdownParent: $this.parent(),
          placeholder: $this.data('placeholder'), // for dynamic placeholder
          dropdownCss: {
            minWidth: '150px' // set a minimum width for the dropdown
          }
        });
      });
      $('.select2-selection__rendered').addClass('w-px-150');
    }
  });

  $(document).ready(function () {
    $('#team_id').on('change', function (e) {
      var team_id = $(this).val();
      $.get(baseUrl + 'api/get-members?team_id=' + team_id, function (res) {
        const data = res.results;
        $("#member_id").empty()
        data.forEach((item) => {
          $("#member_id").append('<option value="' + item.id + '">' + item.name + '</option>')
        })
      })
    });
  });
</script>
@endsection

@section('content')
<div class="app-kanban">
  <!-- Add new board -->
  <!-- <div class="row">
    <div class="col-12">
      <form class="kanban-add-new-board">
        <label class="kanban-add-board-btn" for="kanban-add-board-input">
          <i class="ti ti-plus ti-xs"></i>
          <span class="align-middle">Add new</span>
        </label>
        <input type="text" class="form-control w-px-250 kanban-add-board-input mb-2 d-none" placeholder="Add Board Title" id="kanban-add-board-input" required />
        <div class="mb-3 kanban-add-board-input d-none">
          <button class="btn btn-primary btn-sm me-2">Add</button>
          <button type="button" class="btn btn-label-secondary btn-sm kanban-add-board-cancel-btn">Cancel</button>
        </div>
      </form>
    </div>
  </div> -->

  <div class="row">
    <div class="">
      <div class="app-chat customer overflow-hidden">
        <section class="d-flex flex-row justify-content-between align-items-center px-5 py-2 bg-white">
          <h4 class="fw-bolder text-dark mb-0">Tickets</h4>
          <div class="d-flex flex-row gap-4 align-items-center">
            <div class="d-flex flex-row align-items-center gap-2">
              <button type="button" class="btn btn-icon me-2 btn-primary rounded-circle" data-bs-toggle="offcanvas" data-bs-target="#addEditTask">
                <span class="ti ti-plus"></span>
              </button>
              <button type="button" class="btn btn-border" data-bs-toggle="modal" data-bs-target="#filter">
                <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">Filters
              </button>
            </div>
            <div class="d-flex align-items-center flex-grow-1 me-3 me-lg-0">
              <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                <span class="input-group-text form-search-custom" id="basic-addon-search31">
                  <i class="ti ti-search"></i>
                </span>
                <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search Tickets ..." aria-label="Search Tickets ..." aria-describedby="basic-addon-search31">
              </div>
            </div>
          </div>
        </section>
        <div class="row g-0"></div>
      </div>
    </div>
  </div>

  <!-- Kanban Wrapper -->
  <div class="kanban-wrapper"></div>

  <!-- Edit Task & Activities -->
  <div id="addEditTask" class="offcanvas offcanvas-end kanban-update-item-sidebar">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title">Add Task</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- <ul class="nav nav-tabs tabs-line">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
            <i class="ti ti-edit me-2"></i>
            <span class="align-middle">Edit</span>
          </button>
        </li> -->
        <!-- <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-activity">
            <i class="ti ti-trending-up me-2"></i>
            <span class="align-middle">Activity</span>
          </button>
        </li> -->
      <!-- </ul> -->
      <div class="tab-content px-0 pb-0">
        <!-- Update item/tasks -->
        <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
          <form action="{{ route('tickets.upsert') }}" method="post">
            @csrf
            <input type="hidden" id="task_id" name="task_id" value="">
            <div class="d-flex flex-row justify-content-between mb-3 gap-4">
              <div class="d-inline-flex p2">
                <!-- <label class="form-label" for="status_id">Status</label> -->
                <select name="client_id" id="client_id" class="select2 form-select">
                  @foreach($clients as $client)
                  <option value="{{ $client->id }}">{{ $client->text }}</option>
                  @endforeach
                </select>
              </div>
              <div class="p2 ms-auto">
                <!-- <label class="form-label" for="status_id">Status</label> -->
                {{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="title">Ticket Name</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Enter Ticket Name" />
            </div>
            <div class="d-flex flex-row mb-3 gap-4">
              <div class="mb-3">
                <label class="form-label" for="code">Ticket ID</label>
                <input type="text" name="code" id="code" class="form-control" placeholder="Enter Ticket ID" />
              </div>
              <div class="mb-3">
                <label class="form-label" for="deadline">Resolution Date</label>
                <input type="text" name="deadline" id="deadline" class="due-date form-control" placeholder="Enter Due Date" />
              </div>
            </div>
            <div class="d-flex flex-row gap-2">
              <div class="mb-3">
                <label class="form-label" for="type">Ticket Type</label>
                <select name="type" id="type" class="select2 form-select">
                  <option value="Document">Document</option>
                  <option value="Complaint">Complaint</option>
                  <option value="Technical">Technical</option>
                  <option value="Issue">Issue</option>
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="priority">Priority</label>
                <select name="priority" id="priority" class="form-select">
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label" for="status_id">Status</label>
                <select name="status_id" id="status_id" class="select2 form-select">
                  @foreach($statuses as $status)
                  <option value="{{ $status->id }}">{{ $status->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="team_id">Team</label>
              <select name="team_id" id="team_id" class="select2 form-select">
                <option value="">Select your team</option>
                @foreach($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="member_id">Members</label>
              <select name="member_id" id="member_id" class="select2 form-select"></select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="internal_note">Ticket Notes</label>
              <textarea name="internal_note" rows="4" id="internal_note" class="form-control"></textarea>
            </div>
            <!-- <div class="mb-3">
              <label class="form-label" for="label"> Label</label>
              <select class="select2 select2-label form-select" id="label">
                <option data-color="bg-label-success" value="UX">UX</option>
                <option data-color="bg-label-warning" value="Images">
                  Images
                </option>
                <option data-color="bg-label-info" value="Info">Info</option>
                <option data-color="bg-label-danger" value="Code Review">
                  Code Review
                </option>
                <option data-color="bg-label-secondary" value="App">
                  App
                </option>
                <option data-color="bg-label-primary" value="Charts & Maps">
                  Charts & Maps
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Assigned</label>
              <div class="assigned d-flex flex-wrap"></div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="attachments">Attachments</label>
              <input type="file" class="form-control" id="attachments" />
            </div>
            <div class="mb-4">
              <label class="form-label">Comment</label>
              <div class="comment-editor border-bottom-0"></div>
              <div class="d-flex justify-content-end">
                <div class="comment-toolbar">
                  <span class="ql-formats me-0">
                    <button class="ql-bold"></button>
                    <button class="ql-italic"></button>
                    <button class="ql-underline"></button>
                    <button class="ql-link"></button>
                    <button class="ql-image"></button>
                  </span>
                </div>
              </div>
            </div> -->
            <div class="d-flex flex-wrap">
              <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                Update
              </button>
              <button type="button" class="btn btn-label-danger" data-bs-dismiss="offcanvas">
                Delete
              </button>
            </div>
          </form>
        </div>
        <!-- Activities -->
        <div class="tab-pane fade" id="tab-activity" role="tabpanel">
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Jordan</span> Left the board.
              </p>
              <small class="text-muted">Today 11:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Dianna</span> mentioned
                <span class="text-primary">@bruce</span> in
                a comment.
              </p>
              <small class="text-muted">Today 10:20 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Martian</span> added moved
                Charts & Maps task to the done board.
              </p>
              <small class="text-muted">Today 10:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Barry</span> Commented on App
                review task.
              </p>
              <small class="text-muted">Today 8:32 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Bruce</span> was assigned
                task of code review.
              </p>
              <small class="text-muted">Today 8:30 PM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Clark</span> assigned task UX
                Research to
                <span class="text-primary">@martian</span>
              </p>
              <small class="text-muted">Today 8:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Ray</span> Added moved
                <span class="fw-medium">Forms & Tables</span> task
                from in progress to done.
              </p>
              <small class="text-muted">Today 7:45 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Barry</span> Complete all the
                tasks assigned to him.
              </p>
              <small class="text-muted">Today 7:17 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Jordan</span> added task to
                update new images.
              </p>
              <small class="text-muted">Today 7:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar" class="rounded-circle" />
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Dianna</span> moved task
                <span class="fw-medium">FAQ UX</span> from in
                progress to done board.
              </p>
              <small class="text-muted">Today 7:00 AM</small>
            </div>
          </div>
          <div class="media mb-4 d-flex align-items-start">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Clark</span> added new board
                with name <span class="fw-medium">Done</span>.
              </p>
              <small class="text-muted">Yesterday 3:00 PM</small>
            </div>
          </div>
          <div class="media d-flex align-items-center">
            <div class="avatar me-2 flex-shrink-0 mt-1">
              <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
            </div>
            <div class="media-body">
              <p class="mb-0">
                <span class="fw-medium">Bruce</span> added new task
                in progress board.
              </p>
              <small class="text-muted">Yesterday 12:00 PM</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
