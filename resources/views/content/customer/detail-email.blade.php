@extends('layouts/layoutMaster')

@section('title', 'Customers - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script src="{{ asset('assets/js/customer-detail-email.js') }}"></script>
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
                            <button class="btn-back d-flex gap-2 fw-bold text-dark" onclick="window.history.back()">
                                <i class="ti ti-arrow-left text-dark"></i>
                            </button>
                            <x-card-activities title="Email Send" subtitle="by you" createdAt="04 / Jun / 24 21:00">
                                <div class="d-flex flex-column gap-1">
                                    <span class="text-dark" style="font-size: 16px">Follow Up the next step</span>
                                    <small style="font-size: 14px">Hi John, Hi Aaron, Thank you for your time on the call today. Regarding to our conversation toda...</small>
                                </div>
                            </x-card-activities>
                            <x-card-activities title="Email Receive" subtitle="" createdAt="04 / Jun / 24 21:00">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark" style="font-size: 16px">Follow Up the next step</span>
                                        <span class="badge bg-success">Opened</span>
                                    </div>
                                    <small style="font-size: 14px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
                                    <div class="mt-4">
                                        <button class="btn-reply" data-bs-toggle="modal" data-bs-target="#reply-email">Reply</button>
                                    </div>
                                </div>
                            </x-card-activities>
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

    
    {{-- modal new/reply email --}}
    <x-modal
        title="Reply Email"
        name="reply-email"
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
            <div class="full-editor" id="full-editor-reply-email">
            </div>
        </div>
    </x-modal>
@endsection