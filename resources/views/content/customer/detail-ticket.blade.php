@extends('layouts/layoutMaster')

@section('title', 'Customers - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script src="{{ asset('assets/js/customer-detail-email.js') }}"></script>
@endsection

@php
    $insight1 = (object) [
        'name' => 'Ticket Open for',
        'value' => '4 Days'
    ];
    $insight2 = (object) [
        'name' => 'Resolution',
        'value' => '34 Days'
    ];

    $listInsight = [$insight1, $insight2];

    [$stages, $alphabet, $quality, $status, $listChannels, $listTicketTypes, $listPrioritys, $listStatusProjects] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer-detail-email overflow-hidden">
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

                        <div class="d-flex flex-column align-items-start gap-3 mt-2" style="width: 45%">
                            <x-chat-history
                                isUsingHeader={{ true }}
                                type="cold"
                                :people="['Johnson']"
                                title="Issue SPK"
                                typeTask="TY-010209"
                            >
                            </x-chat-history>
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
                            <div class="sidebar-card d-flex flex-column gap-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Ticket Type</span>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px; bottom: 0px;">
                                        @foreach ($listTicketTypes as $key => $value)
                                            <option value="{{ $value->value }}">{{ $value->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Ticket ID</span>
                                    <span>TY-010209</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Resolution Date</span>
                                    <span>6 June 2024</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Priority</span>
                                    <select id="priority" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px; bottom: 0px;">
                                        <option value="high">High</option>
                                        <option value="medium">Mediu </option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark">Created by</span>
                                    <span>Randy Haris</span>
                                </div>
                            </div>
                            <div class="sidebar-card d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark">Team</h6>
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

                        </x-sidebar-right-info-chat>
                        <!-- Client info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection