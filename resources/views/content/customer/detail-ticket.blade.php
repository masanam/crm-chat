@extends('layouts/layoutMaster')

@section('title', 'Customers - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <!-- <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-editable/bootstrap-editable.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/components/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
    <style>
        .app-chat .app-chat-history .chat-history-header { padding-right: 0; padding-left: 0; }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
@endsection

@section('page-script')
    <!-- <script src="{{ asset('assets/libs/bootstrap-editable/bootstrap-editable.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script src="{{ asset('assets/js/customer-detail-email.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#ticket-created').text(moment("{{ date('Y-m-d H:i:s', strtotime($model->created_at)) }}").fromNow())
            $('#ticket-deadline').text(moment("{{ date('Y-m-d H:i:s', strtotime($model->deadline)) }}").fromNow())

            function postData(id, text, type, url) {
                let fd = new FormData();
                    fd.set('text', text);
                    fd.set('id', id);
                    fd.set('type', type);

                fetch(baseUrl + url, { method: 'post', body: fd, mode: 'cors' })
                    .then(r => r.text())
                    .then(text => {
                        console.log('Do something with returned response: %s', text)
                    })
            }

            $('.company-editable').each(function() {
                $(this).attr('contenteditable', 'true');
            });

            $('.company-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.task-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.lead-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.select-lead-editable').on('change', function() {
                const newValue = $(this).val();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.select-task-editable').on('change', function() {
                const newValue = $(this).val();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });
        });
    </script>
@endsection

@php
[$stages, $alphabet, $quality, $status, $listChannels, $listTicketTypes, $listPrioritys, $listStatusProjects] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer-detail-email overflow-hidden">
                <div class="row g-0">
                    <div class="d-flex row justify-content-between">
                        <div class="col-3 p2">
                            <!-- Customer info -->
                            <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-customer-info" sidebarBodyClass="mt-2">
                                <div class="sidebar-card d-flex flex-column">
                                    <div class="d-flex flex-column gap-3">
                                        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                                            <div class="flex-shrink-0 avatar">
                                                <span
                                                    class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial($model->client->organization->name) }}</span>
                                            </div>
                                            <span class="text-dark fw-bold" style="font-size: 22px">{{ $model->client->organization->name }}</span>
                                            @php $is_lead = $model->lead_id ? 'Lead' : '' @endphp
                                            <x-badge-stage type="{{ $is_lead }}"></x-badge-stage>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center px-2">
                                            <div>
                                                <img src="{{ asset('assets/svg/icons/icon-calendar.svg') }}" alt="calendar"
                                                    width="15">
                                                <span style="font-size: 12px">{{ date('M d, Y', strtotime($model->client->created_at)) }}</span>
                                            </div>
                                            <div>
                                                <img src="{{ asset('assets/svg/icons/icon-dolar.svg') }}" alt="dolar"
                                                    width="15">
                                                <span style="font-size: 12px">{{ $model->lead ? 'Rp ' . number_format($model->lead->amount, 0, ',', '.') : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-card d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-dark">Status</h6>
                                        <select id="status" data-id="{{ $model->lead_id }}" data-type="status" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
                                            <option value="new" {{ strtolower($model->lead->status) == "new" ? 'selected' : '' }}>New</option>
                                            <option value="active" {{ strtolower($model->lead->status) == "active" ? 'selected' : '' }}>Active</option>
                                            <option value="closed" {{ strtolower($model->lead->status) == "closed" ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-dark">Quality</h6>
                                        <select id="quality" data-id="{{ $model->lead_id }}" data-type="quality" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
                                            <option value="cold" {{ strtolower($model->lead->quality) == "cold" ? 'selected' : '' }}>Cold</option>
                                            <option value="warm" {{ strtolower($model->lead->quality) == "warm" ? 'selected' : '' }}>Warm</option>
                                            <option value="hot" {{ strtolower($model->lead->quality) == "hot" ? 'selected' : '' }}>Hot</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-dark">Stage</h6>
                                        <select id="stage" data-id="{{ $model->lead_id }}" data-type="stage" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
                                            <option value="Test Drive" {{ $model->lead->stage == 'Test Drive' ? 'selected' : '' }}>Test Drive</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="text-dark">Customer Type</h6>
                                        <select id="customer_type" data-id="{{ $model->lead_id }}" data-type="customer_type" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
                                            <option value="B2B" {{ strtoupper($model->lead->customer_type) == 'b2b' ? 'selected' : '' }}>B2B</option>
                                            <option value="B2C" {{ strtoupper($model->lead->customer_type) == 'b2c' ? 'selected' : '' }}>B2C</option>
                                            <option value="C2B" {{ strtoupper($model->lead->customer_type) == 'c2b' ? 'selected' : '' }}>C2B</option>
                                            <option value="C2C" {{ strtoupper($model->lead->customer_type) == 'c2c' ? 'selected' : '' }}>C2C</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sidebar-card d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark fw-bold" style="font-size: 18px">Contact Information</span>
                                        <i class="ti ti-chevron-down text-dark"></i>
                                    </div>
                                    <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark fw-bold">{{ $model->lead->assignedLead ? $model->lead->assignedLead->profile->first_name . ' ' . $model->lead->assignedLead->profile->last_name : '' }}</span>
                                                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                                                    width="15" data-bs-toggle="modal" data-bs-target="#add-edit-contact"
                                                    class="cursor-pointer">
                                            </div>
                                            <span class="text-dark" style="font-size: 14px">{{ $model->lead->assignedLead->profile->job_title }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                                                    width="15">
                                                <span style="font-size: 12px">{{ $model->lead->phone_number }}</span>
                                            </div>
                                            <div>
                                                <img src="{{ asset('assets/svg/icons/icon-circle-outline.svg') }}"
                                                    alt="circle" width="15">
                                                <span style="font-size: 12px">WhatsApp</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-link" data-bs-toggle="modal" data-bs-target="#add-edit-contact">
                                        + Add more contacts
                                    </button>
                                </div>

                                <div class="sidebar-card d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark fw-bold" style="font-size: 18px">Company Information</span>
                                        <i class="ti ti-chevron-down text-dark"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark">Company Name</span>
                                        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="name" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->name ?? ' - ' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark">Industry</span>
                                        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="industry" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->industry ?? ' - ' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark">Location</span>
                                        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="address" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->address ?? ' - ' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark">Website</span>
                                        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="website" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->website ?? ' - ' }}</span>
                                    </div>
                                </div>

                                <div class="sidebar-card d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark fw-bold" style="font-size: 18px">Deals Information</span>
                                        <i class="ti ti-chevron-down text-dark"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark" style="font-weight: 600;">Description</span>
                                        <span style="font-size: 13px; color: #616A75;" contenteditable="true" class="lead-editable" data-id="{{ $model->lead_id }}" data-type="notes" data-url="api/leads/{{ $model->lead_id }}/change">{{ $model->lead->notes ?? ' - ' }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark" style="font-weight: 600;">Revenue</span>
                                        <span>Rp {{ number_format($model->lead->amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark" style="font-weight: 600;">Close Date</span>
                                        <span>{{ date('m D Y', strtotime($model->lead->closed_date)) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark" style="font-weight: 600;">Source</span>
                                        <select id="status" class="form-select custom-select" data-allow-clear="true">
                                            <option value="test-drive">{{ $model->lead->source }}</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark" style="font-weight: 600;">Field</span>
                                        <span>Options</span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark" style="font-weight: 600;">Next Step</span>
                                        <span style="font-size: 13px; color: #616A75;">{{ $model->lead->next_step }}</span>
                                    </div>
                                </div>

                            </x-sidebar-right-info-chat>
                            <!-- /Customer info -->
                        </div>

                        <div class="col-6 p2">
                            <x-chat-history
                                isUsingHeader={{ true }}
                                type="cold"
                                :people="['Rihanza']"
                                title="{{ $model->title }}"
                                typeTask="{{ $model->code }}"
                            >
                            </x-chat-history>
                        </div>

                        <div class="col-3 p-2">
                            <!-- Client info -->
                            <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-client-info" sidebarBodyClass="mt-2">
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
                                            @foreach ($listTicketTypes as $key => $value)
                                                <option value="{{ $value->value }}" {{ $value->value == $model->type ? 'selected' : '' }}>{{ $value->label }}</option>
                                            @endforeach
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
                                            <option value="LOW" {{ strtoupper($model->priority) == 'LOW' ? 'selected' : '' }}>LOW</option>
                                            <option value="MEDIUM" {{ strtoupper($model->priority) == 'MEDIUM' ? 'selected' : '' }}>MEDIUM</option>
                                            <option value="HIGH" {{ strtoupper($model->priority) == 'HIGH' ? 'selected' : '' }}>HIGH</option>
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
                                    <div class="d-flex justify-content-between">
                                        <span class="text-dark">Teams</span>
                                        <span>{{ $model->team->name }}</span>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        @if($model->team)
                                        @foreach($model->team->members as $member)
                                        <div class="d-flex align-items-center tag gap-1">
                                            <span class="text-dark">{{ $member->profile->first_name }} {{ $member->profile->last_name }}</span>
                                            <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                                data-target="#tag"></i>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>

                            </x-sidebar-right-info-chat>
                            <!-- Client info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection