@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
    <script src="{{ asset('assets/js/customer.js') }}"></script>
@endsection

@php
   [$stages, $alphabet, $quality, $status] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer overflow-hidden">
                <x-page-title title="Customers" placeholderSearchText="Search leads" targetOpenModal="#customers"></x-page-title>
                <div class="row g-0">
                    @include('content/customer/components/customer-chat-view')
                    @include('content/customer/components/customer-kanban-view')
                    @include('content/customer/components/customer-list-view')
                </div>
            </div>
        </div>
    </div>

    {{-- modal add new customer --}}
    <x-modal
        title="Add New Customer"
        name="add-customer"
        submitText="Submit"
        isModalStack="{{ true }}"
        targetNameModalStack="customers"
        modalClass=""
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column gap-2">
                <h6 class="text-dark fw-bold">General Information</h6>
                <div class="d-flex flex-column gap-3">
                    <x-input-floating
                        label="Customer Name"
                        id="customer name"
                        name="customer name"
                    ></x-input-floating>
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex flex-column">
                            <span class="text-dark" style="font-size: 14px;">Customer Type</span>
                            <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                                <option value="b2c">B2C</option>
                                <option value="b2b">B2B</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-dark" style="font-size: 14px;">Stage</span>
                            <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                                @foreach ($stages as $key => $value)
                                    <option value="{{ $value->value }}">{{ $value->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-dark" style="font-size: 14px;">Quality</span>
                            <select id="status" class="form-select custom-select" data-allow-clear="true" style="border: none; padding-left: 0px;">
                                <option value="warm">Warm</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start">
                <h6 class="text-dark fw-bold">Contact Information</h6>
                <div class="d-flex flex-column align-items-start gap-3 w-100">
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
                    <button class="btn-link">
                        + Add more channels
                    </button>
                </div>
            </div>
            <button class="btn-link pb-3">
                + Add more contacts
            </button>
            <div class="d-flex flex-column gap-2">
                <h6 class="text-dark fw-bold">Deal Information</h6>
                <div class="d-flex flex-column gap-3 w-100">
                    <x-input-floating
                        label="Deal Revenue"
                        id="deal revenue"
                        name="deal revenue"
                    ></x-input-floating>
                    <div class="d-flex justify-content-between gap-5 w-100">
                        <x-input-floating
                            label="Close Date"
                            id="flatpickr-date"
                            name="flatpickr-date"
                        >
                        </x-input-floating>
                        <x-input-floating
                            label="Next Step"
                            id="next step"
                            name="next step"
                        >
                        </x-input-floating>
                    </div>
                    <x-input-floating
                        label="Description"
                        id="description"
                        name="description"
                    ></x-input-floating>
                </div>
            </div>
        </div>
    </x-modal>

    {{-- modal add/select customer --}}
    <x-modal title="Customers" name="customers" wrapperModalClass="modal-right" isUsingBtnFooter="{{ false }}">
        <div class="d-flex flex-column gap-3 modal-add-contact">
            <div class="d-flex flex-column gap-2 border-bottom">
                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                    <span class="input-group-text form-search-custom" id="basic-addon-search31"><i
                            class="ti ti-search"></i></span>
                    <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search contacts"
                            aria-label="Search contacts" aria-describedby="basic-addon-search31">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <x-button-add-contact target="#add-customer" name="Add New Customer"></x-button-add-contact>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column modal-contact">
                    <div class="d-flex flex-column">
                        <h6 class="text-dark fw-bold">R</h6>
                        <div class="d-flex align-items-center gap-2 modal-contact-body">
                            <div class="flex-shrink-0 avatar">
                                <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">AR</span>
                            </div>
                            <div class="">
                                <h6 class="text-dark fw-bold modal-contact-title">Ricky Jonathan</h6>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge badge-sm badge-status rounded-pill text-dark">
                                    Status
                                </span>
                                <span class="badge badge-sm rounded-pill badge-quality text-dark">
                                    Quality
                                </span>
                                <small class="text-muted">Product name</small>    
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="alphabet">
                    @foreach($alphabet as $alpha)
                    <small>{{ $alpha }}</small>
                    @endforeach
                </div>   
            </div>
        </div>
    </x-modal>

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
                <x-input-floating
                    label="Job Title"
                    id="job title"
                    name="job title"
                >
                </x-input-floating>
            </div>
            <button class="btn-link">
                + Add more channels
            </button>
        </div>
        <div class="d-flex justify-content-center py-3">
            <button class="btn-link pb-3 add-contact">
                + Add more contacts
            </button>
        </div>
    </x-modal>

    {{-- modal filter --}}
    <x-modal
        title="Filter"
        name="filter"
        submitText="Apply"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
        isUsingBtnFooterClose="{{ true }}"
    >
        <div class="d-flex flex-column gap-5">
            <div class="d-flex justify-content-between gap-5 w-100">
                <x-input-floating
                    label="Start Date"
                    id="start-date"
                    name="start-date"
                >
                </x-input-floating>
                <x-input-floating
                    label="End Date"
                    id="end-date"
                    name="end-date"
                >
                </x-input-floating>
            </div>
            <x-input-floating
                label="Status"
                id="status"
                name="status"
                type="select"
                :options="$status"
            >
            </x-input-floating>
            <x-input-floating
                label="Quality"
                id="quality"
                name="quality"
                type="select"
                :options="$quality"
            >
            </x-input-floating>
            <x-input-floating
                label="Stage"
                id="stage"
                name="stage"
                type="select"
                :options="$stages"
            >
            </x-input-floating>
        </div>
    </x-modal>
@endsection
