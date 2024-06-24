<section class="tab-pane fade app-kanban" id="kanban-view" role="tabpanel">
    <!-- Kanban Wrapper -->
    <div class="kanban-wrapper"></div>
    <!-- Edit Task & Activities -->
  <div class="offcanvas offcanvas-end kanban-update-item-sidebar">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title">Edit Task</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav nav-tabs tabs-line">
        <li class="nav-item">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
            <i class="ti ti-edit me-2"></i>
            <span class="align-middle">Edit</span>
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-activity">
            <i class="ti ti-trending-up me-2"></i>
            <span class="align-middle">Activity</span>
          </button>
        </li>
      </ul>
      <div class="tab-content px-0 pb-0">
        <!-- Update item/tasks -->
        <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
          <form>
            <div class="mb-3">
              <label class="form-label" for="title">Title</label>
              <input type="text" id="title" class="form-control" placeholder="Enter Title" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="due-date">Due Date</label>
              <input type="text" id="due-date" class="form-control" placeholder="Enter Due Date" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="company">Company</label>
                <select id="company" class="select2 form-select">
                    <option value="PT. Maju Bersama">PT. Maju Bersama</option>
                    <option value="ABC">ABC</option>
                    <option value="XYZ">XYZ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="priority">Priority</label>
                <select id="priority" class="form-select">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Slow">Slow</option>
                </select>
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
              <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
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
</section>