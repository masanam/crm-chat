<section class="tab-pane tab-activities fade active show" id="tab-activities" role="tabpanel">
    <div class="d-flex flex-wrap justify-content-between card-filter mt-3">
        <button class="btn btn-sm button-new" id="add-dropdown">
            New
            <i class="ti ti-dots-vertical"></i>
        </button>
        <div class="modal-dropdown hidden">
            <div class="d-flex flex-column gap-1 align-items-start">
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#log-call">
                    <img src="{{asset('assets/svg/icons/call-end.svg')}}" alt="call" width="15">
                    Log a Call
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#log-meeting">
                    <img src="{{asset('assets/svg/icons/icon-log-meeting.svg')}}" alt="log-meeting" width="15">
                    Log a Meeting
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#log-task">
                    <img src="{{asset('assets/svg/icons/icon-log-task.svg')}}" alt="log-task" width="15">
                    Log a Task
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#add-notes">
                    <img src="{{asset('assets/svg/icons/icon-add-note.svg')}}" alt="add-note" width="15">
                    Add Notes
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#schedule-call">
                    <img src="{{asset('assets/svg/icons/icon-schedule-call.svg')}}" alt="schedule-call" width="15">
                    Schedule Call
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#schedule-meeting">
                    <img src="{{asset('assets/svg/icons/icon-schedule-calendar.svg')}}" alt="schedule-calendar" width="15">
                    Schedule Meeting
                </button>
                <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#schedule-task">
                    <img src="{{asset('assets/svg/icons/icon-schedule-task.svg')}}" alt="schedule-task" width="15">
                    Schedule Task
                </button>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex header-filter gap-1">
                <button class="active btn-list-view">
                    <img src="{{asset('assets/svg/icons/icon-list-view.svg')}}" alt="list" width="17">
                </button>
                <button>
                    <img src="{{asset('assets/svg/icons/icon-note-alt.svg')}}" alt="note" width="17">
                </button>
                <button>
                    <img src="{{asset('assets/svg/icons/calls-icon.svg')}}" alt="call" width="17">
                </button>
                <button>
                    <img src="{{asset('assets/svg/icons/groups-icon.svg')}}" alt="group" width="20">
                </button>
                <button>
                    <img src="{{asset('assets/svg/icons/icon-chat-view.svg')}}" alt="chat" width="17">
                </button>
                <button class="btn-library">
                    <img src="{{asset('assets/svg/icons/icon-library-books.svg')}}" alt="book" width="17">
                </button>
            </div>
            <button class="btn btn-sm button-filter">
                <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="17">
                Filters
            </button>
        </div>
    </div>
    <div class="d-flex flex-column gap-3 wrapper-content-ticket" id="customer-detail-content-email">
        <span class="text-dark">Upcoming (2)</span>
        <x-card-activities title="Note Added" subtitle="by you" createdAt="04 / Jun / 24 21:00">
            <div class="d-flex flex-column gap-1">
                <small style="font-size: 12px">Contact - Abel Maclead - Sample Contact</small>
                <small style="font-size: 12px">Abel is excited to implement a new software soon. We have already given a demo to Aaron from his team, and Abbie seems to be interested in the upcoming features as well. </small>
            </div>
        </x-card-activities>
        <x-card-activities title="Meeting" createdAt="04 / Jun / 24 21:00">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex flex-column gap-1">
                    <span class="text-dark fw-bold">Meeting - sales demo with Customer Name</span>
                    <div class="d-flex flex-column gap-1 p-3">
                        <div class="d-flex gap-1 align-items-center">
                            <img src="{{asset('assets/svg/icons/icon-calendar.svg')}}" alt="calendar" width="15">
                            <small style="font-size: 12px">June 11, 2024 12:00 PM</small>
                        </div>
                        <div class="d-flex gap-1 align-items-center">
                            <img src="{{asset('assets/svg/icons/icon-card-travel.svg')}}" alt="company" width="15">
                            <small style="font-size: 12px">PT Maju Bersama</small>
                        </div>
                    </div>
                </div>
                <img src="{{asset('assets/svg/icons/icon-check-circle.svg')}}" alt="check" width="20">
            </div>
        </x-card-activities>
    </div>
</section>