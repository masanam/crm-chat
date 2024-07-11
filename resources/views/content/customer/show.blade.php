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
    <style>
        .frmb-control li {
            cursor: pointer;
            list-style: none;
            margin: 0 0 -1px 0;
            padding: 10px;
            text-align: left;
            background: #fff;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px #c5c5c5;
        }
        </style>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script type="text/javascript">

    $(document).ready(function(){      
      var postURL = "<?php echo url('customers/addmore'); ?>";
      var i=0;  
      $('#add-more').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="text" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#add-submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  

      });  


      function printErrorMsg (msg) {

         $(".print-error-msg").find("ul").html('');

         $(".print-error-msg").css('display','block');

         $(".print-success-msg").css('display','none');

         $.each( msg, function( key, value ) {

            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');

         });

      }

    });  

</script>
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

    $meetingModeOnline = (object) [
      'label' => 'Online',
      'value' => 'online',
    ];
    $meetingModeOffline = (object) [
      'label' => 'Offline',
      'value' => 'offline',
    ];
    $listMeetingMode = [$meetingModeOnline, $meetingModeOffline];

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
                                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                                                width="15" data-bs-toggle="modal" data-bs-target="#add-deals-info"
                                                class="cursor-pointer">

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
                                    <span>{{ $lead->budget }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Close Date</span>
                                    <span>{{ $lead->closed_date }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">Source</span>
                                    <select id="status" class="form-select custom-select" data-allow-clear="true">
                                        <option value="test-drive">Outboned</option>
                                    </select>
                                </div>
                                @foreach (array_combine($labels, $names) as $label => $name)
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-dark" style="font-weight: 600;">{{ $label }}</span>
                                    <span>{{ $name }}</span>
                                </div>    
                                @endforeach

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

    {{-- modal activities --}}
    @include('content/customer/components/customer-modal-activities')
    
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
    
    {{-- modal add/edit Deals Info --}}

    <div class="modal fade" id="add-deals-info" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="d-flex align-items-center justify-content-between border border-bottom-2">
          <div class="d-flex align-items-center p-3">
            <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel2">Add Deals Info</h5>
          </div>
        </div>
        
        <div class="modal-body px-4 py-3">
        <div class="row">
            <div class="col-8">
            <div class="form-group">
            <form name="add_name" id="add_name">  
                @csrf
                <div class="table-responsive">
                    <table class="table table-borderless" id="dynamic_field">
                        <tr>  
                                <td>
                                    Revenue
                                </td>  
                                <td>
                                    <input type="text" name="revenue" placeholder="" value="{{ $lead->budget }}" class="form-control name_list" />
                                </td>  
                            </tr>  
                            <tr>  
                                <td>
                                    Close Date
                                </td>  
                                <td>
                                    <input type="text" name="close-date" placeholder="" value="{{ $lead->closed_date }}" class="form-control name_list" />
                                </td>  
                            </tr>  
                            <tr>  
                                <td>
                                    Source
                                </td>  
                                <td>
                                    <select name="close-date" class="form-select name_list">
                                        <option>Web</option>
                                        <option>Chat</option>
                                        <option>Call</option>
                                    </select>
                                </td>  
                            </tr>  
                            @foreach (array_combine($labels, $names) as $label => $name)
                            @php 
                            $i=0;
                            $i++;

                            @endphp
                            <tr id="row{{ $i }}" class="dynamic-added">
                                <td><input type="text" name="label[]" placeholder="" class="form-control label_list" value="{{ $label }}" /></td>
                                <td><input type="text" name="name[]" placeholder="" class="form-control name_list" value="{{ $name }}"/></td>
                                <td width="5%"><button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove btn-sm">X</button></td>
                            </tr>

                            <!-- <tr>  
                                <td>
                                {{ $label }}
                                </td>  
                                <td>
                                {{ $name }}                                
                            </td>  
                            </tr>   -->
                                @endforeach

                    </table>  
                </div>
                <button type="button" class="btn-link" id="add-more" >
                    + Add more fields
                </button>

                <div class="modal-footer d-flex justify-content-center align-items-center w-100 p-4">
                    <button type="button" data-bs-dismiss="modal" id="add-submit" class="btn btn-primary" >Save Info</button>
                    <button type="button" data-bs-dismiss="modal" class="btn" style="background: #667085; color: #FFF;">Close</button>
                </div>
            </form>  
        </div>

            </div>
            <div class="col-4">
            <ul id="frmb-1720708539167-control-box" class="frmb-control ui-sortable">
                <li class="formbuilder-icon-checkbox-group input-control input-control-6 ui-sortable-handle" data-type="checkbox-group"><span>Checkbox Group</span>
                </li>
                <li class="formbuilder-icon-date input-control input-control-11 ui-sortable-handle" data-type="date"><span>Date Field</span>
                </li>
                <li class="formbuilder-icon-number input-control input-control-12 ui-sortable-handle" data-type="number"><span>Number</span>
                </li>
                <li class="formbuilder-icon-radio-group input-control input-control-7 ui-sortable-handle" data-type="radio-group"><span>Radio Group</span>
                </li>
                <li class="formbuilder-icon-select input-control input-control-5 ui-sortable-handle" data-type="select"><span>Select</span>
                </li>
                <li class="formbuilder-icon-text input-control input-control-9 ui-sortable-handle" data-type="text"><span>Text Field</span>
                </li>
                <li class="formbuilder-icon-textarea input-control input-control-13 ui-sortable-handle" data-type="textarea"><span>Text Area</span>
                </li>
            </ul>
            </div>            
        </div>
        

    </div>
</div>

    {{-- modal add/edit Deals Info --}}
    <x-modal
        title="Add Deals Info"
        name="add-deals-info1"
        submitText="Save Info"
        buttonSubmitClass=""
        buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
    >
        <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between gap-5 w-100">
                <span class="text-dark" style="font-weight: 600;">Revenue</span>
                <span>{{ $lead->budget }}</span>
                </div>
                <div class="d-flex justify-content-between gap-5 w-100">
                <span class="text-dark" style="font-weight: 600;">Close Date</span>
                <span>{{ $lead->closed_date }}</span>
                </div>

                <div class="d-flex justify-content-between gap-5 w-100">
                <span class="text-dark" style="font-weight: 600;">Source</span>
                    <x-input-floating
                        label="Source"
                        placeholder="Please select source"
                        id="source"
                        name="source"
                        type="select"
                        :options="$listChannels"
                    >
                    </x-input-floating>
                </div>
                
                {{-- !! Dont remove this tag --}}
                <div class="hidden" id="wrapper-source"></div>
                {{-- !! Dont remove this tag --}}

            </div>
            <button class="btn-link" id="btn-more">
                + Add more fields
            </button>
        </div>
        {{-- !! Dont remove this tag --}}
        <div class="hidden" id="wrapper-dynamic-form"></div>
        {{-- !! Dont remove this tag --}}
    </x-modal>


@endsection
