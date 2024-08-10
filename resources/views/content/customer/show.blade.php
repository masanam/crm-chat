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
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            box-shadow: inset 0 0 0 1px #c5c5c5;
        }
        .container-input input, .container-input select, .container-input textarea {
            font-size: 0.9385rem;
            outline: none;
            border: 1px solid #c5c5c5;
            border-radius: 5px;
            padding: 0.5rem 0.7rem;
            color: gray;
            transition: 0.1s ease-out;
            width: 100%;
            }
            .container-input {
                height: 100%;
                display: block;
                -ms-flex-pack: center;
                justify-content: center;
                -ms-flex-align: center;
                align-items: center;
                width: 100%;
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
      var total = $('#totalData').val();

      var i=total + 1;  
      
      $(document).on('click', "input[type='radio'][name='optRadio']", function() {
            switch(Number($(this).val())){
            case 1:
                document.getElementById('optionCheckBox').style.display = 'block';
                document.getElementById('optionRadioBtn').style.display = 'none';
                document.getElementById('optionSelect').style.display = 'none';
                break;
            case 2:
                document.getElementById('optionCheckBox').style.display = 'none';
                document.getElementById('optionRadioBtn').style.display = 'block';
                document.getElementById('optionSelect').style.display = 'none';
                break;
            case 3:
                document.getElementById('optionCheckBox').style.display = 'none';
                document.getElementById('optionRadioBtn').style.display = 'none';
                document.getElementById('optionSelect').style.display = 'block';
                break;
            default:
            document.getElementById('optionCheckBox').style.display = 'none';
                document.getElementById('optionRadioBtn').style.display = 'none';
                document.getElementById('optionSelect').style.display = 'none';
                break;
        }

        });

      $('#add-more').click(function(){  
        i++;  
        var radioValue = $("input[type='radio'][name='optRadio']:checked").val();

        var checkBox1 = $("#checkBox1").val();
        var checkBox2 = $("#checkBox2").val();
        var checkBox3 = $("#checkBox3").val();

        var radioBtn1 = $("#radioBtn1").val();
        var radioBtn2 = $("#radioBtn2").val();
        var radioBtn3 = $("#radioBtn3").val();

        var optionVal1 = $("#option1").val();
        var optionVal2 = $("#option2").val();
        var optionVal3 = $("#option3").val();


        switch(Number(radioValue)){
            case 1:
                console.log(radioValue);
                $('#dynamic_field').append(`<tr id="row`+i+`" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>
                    <label class="form-check-label custom-option-content col-12" for="customCheck1">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+checkBox1+`" id="customCheck1">
                        <span>`+checkBox1+`</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customCheck2">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+checkBox2+`" id="customCheck2">
                        <span>`+checkBox2+`</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customCheck3">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+checkBox3+`" id="customCheck3">
                        <span>`+checkBox3+`</span>
                    </label>

                </td><td width="5%"><button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);  
                break;
            case 2:
                console.log(radioValue);
                $('#dynamic_field').append(`<tr id="row`+i+`" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>    
                    <label class="form-check-label custom-option-content col-12" for="customRadio1">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+radioBtn1+`" id="customRadio1">
                        <span>`+radioBtn1+`</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customRadio2">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+radioBtn2+`" id="customRadio2">
                        <span>`+radioBtn2+`</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customRadio3">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+radioBtn3+`" id="customRadio3">
                        <span>`+radioBtn3+`</span>
                    </label>

                    </td><td width="5%"><button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);  
                break;
            case 3: 
                console.log(optionVal1);
                $('#dynamic_field').append(`<tr id="row`+i+`" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>
                <select name="name[]" id="name[]" class="form-control name_list">
                    <option value="`+optionVal1+`">`+optionVal1+`</option>
                    <option value="`+optionVal2+`">`+optionVal2+`</option>
                    <option value="`+optionVal3+`">`+optionVal3+`</option>
                </select>
                </td><td width="5%"><button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);  
                break;
            case 4: 
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><textarea id="name" name="name[]" rows="4" cols="50" class="form-control name_list"></textarea></td><td width="5%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');  
                break;
            case 5: 
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="date" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');  
                break;
            case 6: 
                $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="number" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');  
                break;

            default: 
            console.log(radioValue);
            $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="text" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');  
        }

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

      $('#add-submit').click(function(e){      
            e.preventDefault();      
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
                        window.location.reload();
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
    $option = \App\Models\Option::first();
        $stat = explode (",", $option->status); 
        $type = explode (",", $option->type); 
        $qty = explode (",", $option->quality); 
        $stg = explode (",", $option->stage); 

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
                                            <span class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial($lead->client_name); }}</span>
                                        </div>
                                        <span class="text-dark fw-bold" style="font-size: 22px">{{ $lead->client_name}}</span>
                                        <x-badge-stage type="Lead"></x-badge-stage>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center px-2">
                                        <div>
                                            <img src="{{ asset('assets/svg/icons/icon-calendar.svg') }}" alt="calendar"
                                                width="15">
                                            <span style="font-size: 12px">{{ $lead->closed_date }}</span>
                                        </div>
                                        <div>
                                            <img src="{{ asset('assets/svg/icons/icon-dolar.svg') }}" alt="dolar"
                                                width="15">
                                            <span style="font-size: 12px">{{ $lead->budget }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                                                width="15" data-bs-toggle="modal" data-bs-target="#update-status"
                                                class="cursor-pointer">

                                    <span class="text-dark fw-bold" style="font-size: 18px">Status</span>
                                </div>

            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Status</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    @foreach ($stat as $itemStatus)
                    <option value="{{ $itemStatus }}">{{ $itemStatus }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Quality</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($qty as $itemQty)
                    <option value="{{ $itemQty }}">{{ $itemQty }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Stage</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($stg as $itemStage)
                    <option value="{{ $itemStage }}">{{ $itemStage }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Customer Type</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($type as $itemType)
                    <option value="{{ $itemType }}">{{ $itemType }}</option>
                    @endforeach
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
                <span class="client-company">{{ $lead->company_name}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Industry</span>
                <span>Entertainment</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Location</span>
                <span>{{ $lead->location}}</span>
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
                                <!-- <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-activities" aria-controls="tab-activities" aria-selected="true">Activities</button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail" role="tab" data-bs-toggle="tab" data-bs-target="#tab-communication" aria-controls="tab-communication" aria-selected="false">Communication</button>
                                </li> -->
                                <li class="nav-item">
                                  <button type="button" class="nav-link nav-item-customer-detail active" role="tab" data-bs-toggle="tab" data-bs-target="#tab-ticket" aria-controls="tab-ticket" aria-selected="false">Tickets</button>
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
            <div class="col-xl-8" style="padding: 16px;
    border-radius: 12px;
    border: 1px solid #DDE0E4;
    background: #FFF;">
            <div class="form-group ">
            <form name="add_name" id="add_name">  
                @csrf
                <div class="table-responsive">
                    <table class="table table-borderless table-condensed" id="dynamic_field">
                        <tr>  
                                <td style="width:1px; white-space:nowrap;">
                                    Revenue
                                </td>  
                                <td style="width:1px; white-space:nowrap;">
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
                            @php
                            $i=0;
                            @endphp
                            @foreach (array_combine($labels, $names) as $label => $name)
                            @php
                            $i++;
                            @endphp
                            <tr id="row{{ $i }}" class="dynamic-added">
                                <td>
                                <div class="container-input">
                                    <input type="text" name="label[]" placeholder="" id="label{{ $i }}" class="form-control label_list" value="{{ $label }}" />
                                </td>
                                <td>
                                    <input type="text" name="name[]" placeholder="" id="name{{ $i }}" class="form-control name_list" value="{{ $name }}"/>
                                </td>
                                <td width="5%"><button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn-sm btn_remove">X</button></td>
                            </tr>
                            @endforeach
                            <input type="hidden" name="totalData" id="totalData" class="form-control" value="{{ $i }}"/>

                    </table>  
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center w-100 p-4">
                    <button type="button" data-bs-dismiss="modal" id="add-submit" class="btn btn-primary" >Save Info</button>
                    <button type="button" data-bs-dismiss="modal" class="btn" style="background: #667085; color: #FFF;">Close</button>
                </div>
            </form>  
        </div>

            </div>
            <div class="bg-lighter rounded col-xl-4" style="padding: 16px;border-radius: 12px;border: 1px solid #DDE0E4;background: #FFF;">
            <div class="row py-8">

            <ul id="frmb-control-box" class="frmb-control">
                <li class="input-control" data-type="checkbox-group">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio1">
                  <input name="optRadio" class="form-check-input" type="radio" value="1" id="customOptRadio1">
                  <span>Checkbox Group</span>
                </label>
                </li>
                <li class="input-control" data-type="radio-group">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio2">
                  <input name="optRadio" class="form-check-input" type="radio" value="2" id="customOptRadio2">
                  <span>Radio Group</span>
                  </label>
                </li>
                <li class="input-control" data-type="select">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio3">
                  <input name="optRadio" class="form-check-input" type="radio" value="3" id="customOptRadio3">
                  <span>Select</span>
                  </label>
                </li>
                <li class="input-control" data-type="textarea">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio4">
                  <input name="optRadio" class="form-check-input" type="radio" value="4" id="customOptRadio4">
                  <span>Text Area</span>
                  </label>
                </li>
                <li class="input-control" data-type="date">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio5">
                  <input name="optRadio" class="form-check-input" type="radio" value="5" id="customOptRadio5">
                  <span>Date Field</span>
                </label>
                </li>
                <li class="input-control" data-type="number">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio6">
                  <input name="optRadio" class="form-check-input" type="radio" value="6" id="customOptRadio6">
                  <span>Number</span>
                </label>
                </li>
                <li class="input-control" data-type="text">
                <label class="form-check-label custom-option-content form-check-input-payment" for="customOptRadio7">
                  <input name="optRadio" class="form-check-input" type="radio" value="7" id="customOptRadio7">
                  <span>Text Field</span>
                  </label>
                </li>
            </ul>

            <div class="container-input" id="optionCheckBox" style="display:none;">
                <div class="text-dark" style="font-size: 14px;">
                Check Box :
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="checkBox1" id="checkBox1" value="" />
                    <label for="checkBox1">Checkbox 1</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="checkBox2" id="checkBox2" value="" />
                    <label for="checkBox2">Checkbox 2</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="checkBox3" id="checkBox3" value="" />
                    <label for="checkBox3">Checkbox 3</label>
                </div>
            </div>     

            <div class="container-input" id="optionRadioBtn" style="display:none;">
                <div class="text-dark" style="font-size: 14px;">
                Radio Button :
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="radioBtn1" id="radioBtn1" value="" />
                    <label for="radioBtn1">radioBtn 1</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="radioBtn2" id="radioBtn2" value="" />
                    <label for="radioBtn2">radioBtn 2</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="radioBtn3" id="radioBtn3" value="" />
                    <label for="radioBtn3">radioBtn 3</label>
                </div>
            </div>     


            <div class="container-input" id="optionSelect" style="display:none;">
                <div class="text-dark" style="font-size: 14px;">
                Select Option :
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="option1" id="option1" value="" />
                    <label for="option1">Option 1</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="option2" id="option2" value="" />
                    <label for="option2">Option 2</label>
                </div>
                <div class="material-textfield mt-3">
                    <input type="text" name="option3" id="option3" value="" />
                    <label for="option3">Option 3</label>
                </div>
            </div>     



                <button type="button" class="btn btn-primary btn-sm mx-auto mt-2" id="add-more" >
                    + Add more fields
                </button>
       
        </div>
        

    </div>
</div>


@endsection
