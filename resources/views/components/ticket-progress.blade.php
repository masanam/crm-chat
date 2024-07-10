<x-card-progress statusId="{{ $model->status_id }}" statusName="{{ $model->status->name }}"></x-card-progress>
<div class="sidebar-card d-flex flex-column">
    <h6 class="text-dark">Insights</h6>
    <div class="d-flex flex-column gap-3">
        <div class="d-flex gap-1">
            <i class="ti ti-clock-hour-4 text-dark" style="font-size: 17px;"></i>
            <div class="d-flex flex-column gap-1">
                <span class="text-xs">Ticket Open For</span>
                <span class="text-xs text-dark fw-bold" id="ticket-created">0 days</span>
            </div>
        </div>
        <div class="d-flex gap-1">
            <i class="ti ti-clock-hour-4 text-dark" style="font-size: 17px;"></i>
            <div class="d-flex flex-column gap-1">
                <span class="text-xs">Resolution</span>
                <span class="text-xs text-dark fw-bold" id="ticket-deadline">0 days</span>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-card d-flex flex-column gap-2">
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Ticket Type</span>
        <select class="form-select select-task-editable custom-select" data-id="{{ $model->id }}" data-type="type" data-url="api/tasks/{{ $model->id }}/change" data-allow-clear="true" style="border: none; padding-left: 0px; bottom: 0px;">
            <option value="document" {{ $model->type == 'document' ? 'selected' : '' }}>Document</option>
            <option value="complaint" {{ $model->type == 'complaint' ? 'selected' : '' }}>Complaint</option>
            <option value="technical" {{ $model->type == 'technical' ? 'selected' : '' }}>Technical</option>
            <option value="issue" {{ $model->type == 'issue' ? 'selected' : '' }}>Issue</option>
            <option value="others" {{ $model->type == 'others' ? 'selected' : '' }}>Others</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Ticket ID</span>
        <span contenteditable="true" class="task-editable" data-id="{{ $model->id }}" data-type="code" data-url="api/tasks/{{ $model->id }}/change">{{ $model->code ?? ' - ' }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Resolution Date</span>
        <span>{{ date('d M Y', strtotime($model->deadline)) }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Priority</span>
        <select class="form-select select-task-editable custom-select" data-id="{{ $model->id }}" data-type="priority" data-url="api/tasks/{{ $model->id }}/change" data-allow-clear="true" style="border: none; padding-left: 0px; bottom: 0px;">
            <option value="Low" {{ $model->priority == 'Low' ? 'selected' : '' }}>Low</option>
            <option value="Medium" {{ $model->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
            <option value="High" {{ $model->priority == 'High' ? 'selected' : '' }}>High</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Created by</span>
        <span>{{ $model->user->first_name }} {{ $model->user->last_name }}</span>
    </div>
</div>

<div class="sidebar-card d-flex flex-column">
    <div class="">
        <h6 class="text-dark">Notes</h6>
        <span contenteditable="true" class="text-dark task-editable" data-id="{{ $model->id }}" data-type="internal_note" data-url="api/tasks/{{ $model->id }}/change">{{ $model->internal_note }}</span>
    </div>
</div>

<div class="sidebar-card d-flex flex-column">
    <span class="text-dark">Teams</span>
    <div>
        <div class="d-flex flex-wrap mb-3 gap-2">
            <div class="d-flex align-items-center tag gap-1">
                <span class="text-dark">{{ $model->team->name ?? ' - ' }}</span>
            </div>
        </div>
    </div>
    <span class="text-dark">Assignee</span>
    <div>
        <div class="d-flex flex-wrap mb-3 gap-2">
            @if($chats)
            @foreach($chats as $chat)
            <div class="d-flex align-items-center tag gap-1">
                <span class="text-dark">{{ $chat->profile->first_name }} {{ $chat->profile->last_name }}</span>
                <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                    data-target="#tag"></i>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-assignee" data-task="{{ $model->id }}" class="btn-link">
        + Add Assignee
    </a>
</div>