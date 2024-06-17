@extends('layouts/layoutMaster')

@section('title', 'Customer Detail - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
    <script src="{{ asset('assets/js/customer.js') }}"></script>
@endsection

@php
    $insight1 = (object) [
        'name' => 'Last Follow Up',
        'value' => '4 Days'
    ];
    $insight2 = (object) [
        'name' => 'Customer Lifetime',
        'value' => '34 Days'
    ];
    $insight3 = (object) [
        'name' => 'Last Communication Date',
        'value' => 'Apr 11, 2024 05:12 PM'
    ];
    $insight4 = (object) [
        'name' => 'Last Communication Mode',
        'value' => 'WhatsApp'
    ];
    $insight5 = (object) [
        'name' => 'Last Communication by',
        'value' => 'Randy Haris'
    ];

    $listInsight = [$insight1, $insight2, $insight3, $insight4, $insight5];

    $team1 = (object) [
      'label' => 'Finance',
      'value' => 'finance',
    ];
    $team2 = (object) [
      'label' => 'Admin',
      'value' => 'admin',
    ];
    $listTeams = [$team1, $team2];

    $member1 = (object) [
      'label' => 'Jane Doe',
      'value' => 'jane doe',
    ];
    $member2 = (object) [
      'label' => 'John Doe',
      'value' => 'john doe',
    ];
    $listMembers = [$member1, $member2];

    [$stages, $alphabet, $quality, $status, $listChannels, $listTicketTypes, $listPrioritys, $listStatusProjects] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer-detail overflow-hidden">
                <div class="row g-0">
                    <div class="d-flex">
                        
                        <!-- Customer info -->
                        <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-customer-info" sidebarBodyClass="mt-2">
                            <div class="sidebar-card d-flex flex-column">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                                        <div class="flex-shrink-0 avatar">
                                            <span
                                                class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Acme Inc') }}</span>
                                        </div>
                                        <span class="text-dark fw-bold" style="font-size: 22px">Acme Inc</span>
                                        <x-badge-stage type="Lead"></x-badge-stage>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center px-2">
                                        <div>
                                            <img src="{{ asset('assets/svg/icons/icon-calendar.svg') }}" alt="calendar"
                                                width="15">
                                            <span style="font-size: 12px">April 22, 2024</span>
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/svg/icons/icon-dolar.svg') }}" alt="dolar"
                                                width="15">
                                            <span style="font-size: 12px">Rp. 2,000,000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-card d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-dark">Status</h6>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="active">Active</option>
                                        <option value="offline">Offline</option>
                                        <option value="away">Away</option>
                                        <option value="busy">Busy</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-dark">Quality</h6>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="warm">Warm</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-dark">Stage</h6>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="test-drive">Test drive</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="text-dark">Customer Type</h6>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="test-drive">B2B</option>
                                        <option value="test-drive">B2C</option>
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
                                            <span class="text-dark fw-bold">Rihanza Fadlitya</span>
                                            <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                                                width="15" data-bs-toggle="modal" data-bs-target="#add-edit-contact"
                                                class="cursor-pointer">
                                        </div>
                                        <span class="text-dark" style="font-size: 14px">Head of Sales</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                                                width="15">
                                            <span style="font-size: 12px">+82 821 4567 1234</span>
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
                                    <span>Acme Inc</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Industry</span>
                                    <span>Entertainment</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Location</span>
                                    <span>Indonesia</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Website</span>
                                    <span>http://www.acme.com</span>
                                </div>
                            </div>

                            <div class="sidebar-card d-flex flex-column gap-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark fw-bold" style="font-size: 18px">Deals Information</span>
                                    <i class="ti ti-chevron-down text-dark"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark" style="font-weight: 600;">Description</span>
                                    <span style="font-size: 13px; color: #616A75;">An entertainment company needing a CRM
                                        software for their creative teams</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Revenue</span>
                                    <span>Rp 2,000,000</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Close Date</span>
                                    <span>13 April 2024</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Source</span>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="test-drive">Outboned</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Field</span>
                                    <span>Options</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-dark" style="font-weight: 600;">Next Step</span>
                                    <span style="font-size: 13px; color: #616A75;">Follow up after 2 days by sending
                                        proposal</span>
                                </div>
                            </div>

                        </x-sidebar-right-info-chat>
                        <!-- /Customer info -->

                        <div class="d-flex flex-column" style="width: 45%">
                            <ul class="nav nav-tabs nav-tabs-customer-detail" role="tablist">
                                <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-activities" aria-controls="tab-activities" aria-selected="true">Activities</button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail" role="tab" data-bs-toggle="tab" data-bs-target="#tab-communication" aria-controls="tab-communication" aria-selected="false">Communication</button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail" role="tab" data-bs-toggle="tab" data-bs-target="#tab-ticket" aria-controls="tab-ticket" aria-selected="false">Tickets</button>
                                </li>
                            </ul>
                            <div class="tab-content-chat">
                                @include('content/customer/components/customer-tab-activities')
                                @include('content/customer/components/customer-tab-communication')
                                @include('content/customer/components/customer-tab-ticket')
                            </div>
                        </div>

                        <!-- Client info -->
                        <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-client-info" sidebarBodyClass="mt-2">
                            <x-card-progress></x-card-progress>
                            <div class="sidebar-card d-flex flex-column">
                                <h6 class="text-dark">Insights</h6>
                                <div class="d-flex flex-column gap-3">
                                    @foreach ($listInsight as $key => $value )
                                    <div class="d-flex gap-1">
                                        <i class="ti ti-clock-hour-4 text-dark" style="font-size: 17px;"></i>
                                        <div class="d-flex flex-column gap-1">
                                            <span class="text-xs">{{ $value->name }}</span>
                                            <span class="text-xs text-dark fw-bold">{{ $value->value }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="sidebar-card d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark">Assigned staff</h6>
                                    <i class="ti ti-chevron-right text-dark"></i>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex align-items-center tag gap-1">
                                        <span class="text-dark">Sally</span>
                                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                            data-target="#tag"></i>
                                    </div>
                                    <div class="d-flex align-items-center tag gap-1">
                                        <span class="text-dark">Princess</span>
                                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                            data-target="#tag"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-card d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark">Products</h6>
                                    <i class="ti ti-chevron-right text-dark"></i>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="d-flex align-items-center tag gap-1">
                                        <span class="text-dark">Mercedes EQE 350+</span>
                                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                            data-target="#tag"></i>
                                    </div>
                                    <div class="d-flex align-items-center tag gap-1">
                                        <span class="text-dark">Toyota Corolla</span>
                                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                            data-target="#tag"></i>
                                    </div>
                                    <div class="d-flex align-items-center tag gap-1">
                                        <span class="text-dark">Honda Jazz</span>
                                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                                            data-target="#tag"></i>
                                    </div>
                                </div>
                            </div>

                        </x-sidebar-right-info-chat>
                        <!-- Client info -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal add/edit contact --}}
    <x-modal
        title="Add Contact"
        name="add-edit-contact"
        submitText="Save contact"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between gap-5 w-100">
                    <x-input-floating
                        label="First Name"
                        id="first name"
                        name="first name"
                    >
                    </x-input-floating>
                    <x-input-floating
                        label="Last Name"
                        id="last name"
                        name="last name"
                    >
                    </x-input-floating>
                </div>
                <div class="d-flex justify-content-between gap-5 w-100">
                    <x-input-floating
                        label="Channel"
                        placeholder="Please select channel"
                        id="channel"
                        name="channel"
                        type="select"
                        :options="$listChannels"
                    >
                    </x-input-floating>
                    <x-input-floating
                        label="Contact"
                        id="contact"
                        name="contact"
                    >
                    </x-input-floating>
                </div>
                
                {{-- !! Dont remove this tag --}}
                <div class="hidden" id="wrapper-channel"></div>
                {{-- !! Dont remove this tag --}}

                <x-input-floating
                    label="Job Title"
                    id="job title"
                    name="job title"
                >
                </x-input-floating>
            </div>
            <button class="btn-link" id="btn-more-channel">
                + Add more channels
            </button>
        </div>
        {{-- !! Dont remove this tag --}}
        <div class="hidden" id="wrapper-dynamic-form"></div>
        {{-- !! Dont remove this tag --}}
        <div class="d-flex justify-content-center py-3">
            <button class="btn-link pb-3 add-contact" id="btn-more-contact">
                + Add more contacts
            </button>
        </div>
    </x-modal>

    {{-- modal new/reply email --}}
    <x-modal
        title="New Message"
        name="communication-email"
        submitText="Send"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-4">
            <x-input-floating
                label="Reply to"
                id="reply_to"
                name="reply_to"
            >
            </x-input-floating>
            <x-input-floating
                label="Subject"
                id="subject"
                name="subject"
            >
            </x-input-floating>
            <div class="full-editor" id="full-editor">
            </div>
        </div>
    </x-modal>
    
    {{-- modal add ticket --}}
    <x-modal
        title="Add Ticket"
        name="add-ticket"
        submitText="Submit"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-center"
        modalClass=""
    >
        <div class="d-flex flex-column gap-4">
            <x-input-floating
                label="Ticket Name"
                id="ticket_name"
                name="ticket_name"
            >
            </x-input-floating>
            <div class="d-flex justify-content-between gap-5 w-100">
                <x-input-floating
                    label="Ticket ID"
                    id="ticket_id"
                    name="ticket_id"
                >
                </x-input-floating>
                <x-input-floating
                    label="Resolution Date"
                    id="resolution-date"
                    name="resolution-date"
                >
                </x-input-floating>
            </div>
            <div class="d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex flex-column">
                    <span class="text-dark" style="font-size: 14px;">Ticket Type</span>
                    <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                        @foreach ($listTicketTypes as $key => $value)
                            <option value="{{ $value->value }}">{{ $value->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column">
                    <span class="text-dark" style="font-size: 14px;">Priority</span>
                    <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                        @foreach ($listPrioritys as $key => $value)
                            <option value="{{ $value->value }}">{{ $value->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column">
                    <span class="text-dark" style="font-size: 14px;">Status</span>
                    <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                        @foreach ($listStatusProjects as $key => $value)
                            <option value="{{ $value->value }}">{{ $value->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between gap-5 w-100">
                <x-input-floating
                    label="Team"
                    placeholder="Please select team"
                    id="team"
                    name="team"
                    type="select"
                    :options="$listTeams"
                >
                </x-input-floating>
                <x-input-floating
                    label="Member"
                    placeholder="Please select member"
                    id="member"
                    name="member"
                    type="select"
                    :options="$listMembers"
                >
                </x-input-floating>
            </div>
            <x-input-floating
                id="ticket_note"
                name="ticket_note"
                label="Ticket Notes"
                placeholder="Write a note"
                type="textarea"
                cols="33"
                rows="5"
            ></x-input-floating>
        </div>
    </x-modal> 
@endsection
