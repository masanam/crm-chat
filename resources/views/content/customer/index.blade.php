@extends('layouts/layoutMaster')

@section('title', 'Customers - Apps')

@section('vendor-style')
<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/jkanban/jkanban.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/components/ticket-kanban.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/box-chat.css')}}" />

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
    <script src="{{asset('assets/vendor//libs/select2/select2.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script src="{{asset('js/components/ticket-kanban.js')}}"></script>
    <script src="{{ asset('js/chatify/autosize.js') }}"></script>
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
    <script src="{{asset('js/components/ticket-kanban.js')}}"></script>
    <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
    <script >
        // Gloabl Chatify variables from PHP to JS
        window.chatify = {
            name: "{{ config('chatify.name') }}",
            sounds: {!! json_encode(config('chatify.sounds')) !!},
            allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
            allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
            maxUploadSize: {{ Chatify::getMaxUploadSize() }},
            pusher: {!! json_encode(config('chatify.pusher')) !!},
            pusherAuthEndpoint: '{{route("pusher.auth")}}'
        };
        window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
    </script>
    <script src="{{ asset('js/chatify/utils.js') }}"></script>
    <script src="{{ asset('assets/js/box-chat.js') }}"></script>

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

@php
   [$stages, $alphabet, $quality, $status, $listChannels] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
        <div class="messenger-favorites app-scroll-hidden" style="display: none;"></div>

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

                    {{-- !! Dont remove this tag --}}
                    <div class="hidden" id="wrapper-channel-customer"></div>
                    {{-- !! Dont remove this tag --}}
                    
                    <button class="btn-link"  id="btn-more-channel-customer">
                        + Add more channels
                    </button>
                </div>
            </div>
            
            {{-- !! Dont remove this tag --}}
            <div class="hidden" id="wrapper-dynamic-form-customer"></div>
            {{-- !! Dont remove this tag --}}

            <button class="btn-link pb-3" id="btn-more-contact-customer">
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
        isPost="true"
        url="{{ route('leads.change') }}"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between gap-5 w-100">
                    <x-input-floating
                        label="First Name"
                        id="first-name"
                        name="first_name"
                        class="client-name"
                    >
                    </x-input-floating>
                    <x-input-floating
                        label="Last Name"
                        id="last_name"
                        name="last_name"
                    >
                    </x-input-floating>
                </div>
                <x-input-floating
                    label="Job Title"
                    id="client-job"
                    name="job_title"
                >
                </x-input-floating>
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
                    <div class="container-input">
                    <div class="material-textfield">

                    <input placeholder="" type="text" id="client-whatsapp" name="contact" value="" readonly/>
                    <label for="client-whatsapp">Contact</label>
                    </div>
                    </div>
                </div>
                
                {{-- !! Dont remove this tag --}}
                <div class="hidden" id="wrapper-channel"></div>
                {{-- !! Dont remove this tag --}}

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

    {{-- modal template --}}
    <x-modal
        title="Template"
        name="template-chat"
        submitText="Send Template"
        isPost="true"
        url="{{ route('send.template') }}"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-5">
            <div class="d-flex flex-column gap-2 w-100 py-2 px-3" style="border: 1px solid #DDE0E4; border-radius: 12px;">
                <span style="color: #000; font-weight: 600; font-size: 16px;">Introduction</span>
                <span style="color: #616A75; font-size: 14px;">👋 Hello! My name is <span class="first_name"></span> from <span class="client-company"></span>. I hear you are interested in purchasing a car. Before we proceed, I need some information from you.</span>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-5">
            <input type="hidden" name="type" id="type" value="templateChat">
            <input type="hidden" id="client-phone" name="id"/>

            <button type="button" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#create-new-template" style="border: none; background: transparent; color: #33B6B9;">+ create new template</button>
            <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Send</button> -->
        </div>
    </x-modal>

    {{-- modal create new template --}}
    <x-modal
        title="Create New Template"
        name="create-new-template"
        buttonSubmitClass=""
        modalClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
        isUsingBtnFooter="{{ false }}"
    >
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column gap-4 w-100">
                <x-input-floating
                    label="Title"
                    id="title"
                    name="title"
                >
                </x-input-floating>
                <x-input-floating
                    label="Write template here"
                    placeholder=""
                    id="template"
                    name="template"
                    type="textarea"
                >
                </x-input-floating>
            </div>
            <div class="d-flex gap-2">
                <span style="font-size: 14px; width: 30%;">Add placeholder</span>
                <select name="placeholder" id="placeholder" style="width: 100%; border-radius: 5px; padding: 10px;">
                    <option value="">-Select-</option>
                    <option value="staff_name">staff name</option>
                    <option value="company_name">company name</option>
                </select>
            </div>
            <div class="d-flex justify-content-end w-100 mt-2">
                <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </x-modal>

@endsection