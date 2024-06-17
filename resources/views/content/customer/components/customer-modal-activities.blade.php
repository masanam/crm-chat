{{-- modal log call --}}
<x-modal title="Log Call" name="log-call" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="call">Call</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Call Title" id="call_name" name="call_name">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <div class="d-flex gap-2 w-100">
            <x-input-floating label="Outcome" placeholder="Please select outcome" id="outcome" name="outcome"
                type="select" :options="$listMeetingMode">
            </x-input-floating>
            <x-input-floating label="Relationship" placeholder="Please select relationship" id="relationship"
                name="relationship" type="select" :options="$listMeetingMode">
            </x-input-floating>
        </div>
        <div class="full-editor" id="full-editor-log-call">
        </div>
    </div>
</x-modal>

{{-- modal log meeting --}}
<x-modal title="Log Meeting" name="log-meeting" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="meeting">Meeting</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Meeting Title" id="meeting_name" name="meeting_name">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <div class="d-flex gap-2 w-100">
            <x-input-floating label="Location" id="location" name="location">
            </x-input-floating>
            <x-input-floating label="Meeting Mode" placeholder="Please select meeting mode" id="meeting_mode"
                name="meeting_mode" type="select" :options="$listMeetingMode">
            </x-input-floating>
        </div>
        <div class="full-editor" id="full-editor-log-meeting">
        </div>
    </div>
</x-modal>

{{-- modal call task --}}
<x-modal title="Log Task" name="log-task" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="task">Task</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Title" id="title" name="title">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <x-input-floating label="Priority" placeholder="Please select priority" id="priority" name="priority"
            type="select" :options="$listMeetingMode">
        </x-input-floating>
        <div class="full-editor" id="full-editor-log-task">
        </div>
    </div>
</x-modal>

{{-- modal schedule call --}}
<x-modal title="Schedule Call" name="schedule-call" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="call">Call</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Call Title" id="call_name" name="call_name">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <div class="d-flex gap-2 w-100">
            <x-input-floating label="Outcome" placeholder="Please select outcome" id="outcome" name="outcome"
                type="select" :options="$listMeetingMode">
            </x-input-floating>
            <x-input-floating label="Relationship" placeholder="Please select relationship" id="relationship"
                name="relationship" type="select" :options="$listMeetingMode">
            </x-input-floating>
        </div>
        <div class="full-editor" id="full-editor-schedule-call">
        </div>
    </div>
</x-modal>

{{-- modal schedule meeting --}}
<x-modal title="Schedule Meeting" name="schedule-meeting" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="meeting">Meeting</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Meeting Title" id="meeting_name" name="meeting_name">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <div class="d-flex gap-2 w-100">
            <x-input-floating label="Location" id="location" name="location">
            </x-input-floating>
            <x-input-floating label="Meeting Mode" placeholder="Please select meeting mode" id="meeting_mode"
                name="meeting_mode" type="select" :options="$listMeetingMode">
            </x-input-floating>
        </div>
        <div class="full-editor" id="full-editor-schedule-meeting">
        </div>
    </div>
</x-modal>

{{-- modal schedule task --}}
<x-modal title="Schedule Task" name="schedule-task" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="task">Task</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Title" id="title" name="title">
        </x-input-floating>
        <div class="d-flex gap-2">
            <x-input-floating label="Date" id="date" name="date">
            </x-input-floating>
            <x-input-floating label="Start Date" id="start_date" name="start_date">
            </x-input-floating>
            <x-input-floating label="End Date" id="end_date" name="end_date">
            </x-input-floating>
        </div>
        <x-input-floating label="Priority" placeholder="Please select priority" id="priority" name="priority"
            type="select" :options="$listMeetingMode">
        </x-input-floating>
        <div class="full-editor" id="full-editor-schedule-task">
        </div>
    </div>
</x-modal>

{{-- modal add notes --}}
<x-modal title="Add Notes" name="add-notes" submitText="Submit" buttonSubmitClass="" modalClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-end">
    <x-slot name="header">
        <div class="d-flex justify-content-between modal-header">
            <div class="d-flex align-items-center gap-1">
                <label for="type">Type <small style="color: red;">*</small></label>
                <img src="{{asset('assets/svg/icons/icon-hint.svg')}}" alt="hint" width="15">
                <select class="ms-2" name="type" id="type">
                    <option value="notes">Notes</option>
                </select>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-dark fw-bold">PT Maju Bersama</span>
                <div class="flex-shrink-0 avatar avatar-sm">
                    <span
                        class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Haris') }}</span>
                </div>
                <span style="color: #33B6B9;">Ricky Haris</span>
            </div>
        </div>
    </x-slot>
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Notes Title" id="title" name="title">
        </x-input-floating>
        <div class="full-editor" id="full-editor-add-notes">
        </div>
    </div>
</x-modal>
