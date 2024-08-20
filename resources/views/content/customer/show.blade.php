@extends('layouts/layoutMaster')

@section('title', 'Customer Detail - Apps')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
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

    .container-input input,
    .container-input select,
    .container-input textarea {
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

@section('vendor-script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>   
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/app-chat.js') }}"></script>
<script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="{{ asset('assets/js/customer.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var postURL = "<?php echo url('customers/addmore'); ?>";
        var total = $('#totalData').val();

        var i = total + 1;

        $(document).on('click', "input[type='radio'][name='optRadio']", function () {
            switch (Number($(this).val())) {
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

        $('#add-more').click(function () {
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

            switch (Number(radioValue)) {
                case 1:
                    console.log(radioValue);
                    $('#dynamic_field').append(`<tr id="row` + i + `" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>
                    <label class="form-check-label custom-option-content col-12" for="customCheck1">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+ checkBox1 + `" id="customCheck1">
                        <span>`+ checkBox1 + `</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customCheck2">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+ checkBox2 + `" id="customCheck2">
                        <span>`+ checkBox2 + `</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customCheck3">
                        <input name="customCheck" class="form-check-input" type="checkbox" value="`+ checkBox3 + `" id="customCheck3">
                        <span>`+ checkBox3 + `</span>
                    </label>

                </td><td width="5%"><button type="button" name="remove" id="`+ i + `" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);
                    break;
                case 2:
                    console.log(radioValue);
                    $('#dynamic_field').append(`<tr id="row` + i + `" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>    
                    <label class="form-check-label custom-option-content col-12" for="customRadio1">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+ radioBtn1 + `" id="customRadio1">
                        <span>`+ radioBtn1 + `</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customRadio2">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+ radioBtn2 + `" id="customRadio2">
                        <span>`+ radioBtn2 + `</span>
                    </label>
                    <label class="form-check-label custom-option-content col-12" for="customRadio3">
                        <input name="customRadio" class="form-check-input" type="radio" value="`+ radioBtn3 + `" id="customRadio3">
                        <span>`+ radioBtn3 + `</span>
                    </label>

                    </td><td width="5%"><button type="button" name="remove" id="`+ i + `" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);
                    break;
                case 3:
                    console.log(optionVal1);
                    $('#dynamic_field').append(`<tr id="row` + i + `" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td>
                <select name="name[]" id="name[]" class="form-control name_list">
                    <option value="`+ optionVal1 + `">` + optionVal1 + `</option>
                    <option value="`+ optionVal2 + `">` + optionVal2 + `</option>
                    <option value="`+ optionVal3 + `">` + optionVal3 + `</option>
                </select>
                </td><td width="5%"><button type="button" name="remove" id="`+ i + `" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>`);
                    break;
                case 4:
                    $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><textarea id="name" name="name[]" rows="4" cols="50" class="form-control name_list"></textarea></td><td width="5%"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');
                    break;
                case 5:
                    $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="date" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');
                    break;
                case 6:
                    $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="number" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');
                    break;

                default:
                    console.log(radioValue);
                    $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="label[]" placeholder="" class="form-control label_list" /></td><td><input type="text" name="name[]" placeholder="" class="form-control name_list" /></td><td width="5%"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-sm">X</button></td></tr>');
            }
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#add-submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: postURL,
                method: "POST",
                data: $('#add_name').serialize(),
                type: 'json',
                success: function (data) {
                    if (data.error) {
                        printErrorMsg(data.error);
                    } else {
                        window.location.reload();
                        i = 1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display', 'block');
                        $(".print-error-msg").css('display', 'none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-success-msg").css('display', 'none');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    });

    $(document).ready(function () {
        function postData(id, text, type, url) {
            let fd = new FormData();
            fd.set('text', text);
            fd.set('id', id);
            fd.set('type', type);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(baseUrl + url, {
                method: 'post',
                body: fd,
                mode: 'cors',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(r => r.text())
                .then(text => {
                    console.log('Do something with returned response: %s', text)
                })
        }

        $('.input-editable').each(function () {
            $(this).attr('contenteditable', 'true');
        });

        $('.input-editable').on('blur', function () {
            const newValue = $(this).text();

            postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
        });

        $('.input-editable').on('blur', function () {
            const newValue = $(this).text();

            postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
        });

        $('.select-editable').on('blur', function () {
            const newValue = $(this).val();

            postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
        });
    })

    $(document).ready(function() {
        $('#editable-date').on('click', function() {
            // Tampilkan datepicker
            $('#editable-date').datepicker({
                inline: true,
                format: 'yyyy-mm-dd', // Sesuaikan format tanggal yang Anda inginkan
                autoclose: true
            }).on('changeDate', function(e) {
                // Simpan nilai tanggal ke input hidden
                $('#date-input').val(e.format(0, 'yyyy-mm-dd'));

                // Kirim data ke API
                $.ajax({
                    url: baseUrl + 'api/leads/{!! $lead->id !!}/change', // Ganti dengan URL API Anda
                    method: 'POST',
                    data: {
                        id: '{!! $lead->id !!}',
                        type: 'closed_date',
                        text: $('#date-input').val(),
                    },
                    success: function(response) {
                        console.log('Data berhasil diupdate:', response);
                        $('#editable-date').html($('#date-input').val())
                    },
                    error: function(error) {
                        console.error('Terjadi kesalahan:', error);
                    }
                });

                // Sembunyikan datepicker setelah dipilih
                $(this).datepicker('hide');
            });
        });
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

[$stages, $alphabet, $quality, $status, $listChannels, $listTicketTypes, $listPrioritys, $listStatusProjects] =
Helper::getConstants();
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
                    <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-customer-info"
                        sidebarBodyClass="mt-2">
                        <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                                    <div class="flex-shrink-0 avatar">
                                        <span class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{
                                            Helper::getInitial($lead->client_name); }}</span>
                                    </div>
                                    <span class="text-dark fw-bold" style="font-size: 22px">{{
                                        $lead->client_name}}</span>
                                    <x-badge-stage type="Lead"></x-badge-stage>
                                </div>
                                <div class="d-flex justify-content-between align-items-center px-2">
                                    <div>
                                        <img src="{{ asset('assets/svg/icons/icon-calendar.svg') }}" alt="calendar"
                                            width="15">
                                        <span style="font-size: 12px">{{ date('M d, Y', strtotime($lead->created_at)) }}</span>
                                    </div>
                                    <div>Rp&nbsp;
                                        <span class="input-editable" data-id="{{ $lead->id }}" data-type="amount"
                                            data-url="api/leads/{{ $lead->id }}/change">{{ $lead->amount ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Status</h6>
                                <select id="status" data-id="{{ $lead->id }}" data-type="status"
                                    data-url="api/leads/{{ $lead->id }}/change"
                                    class="form-select select-editable custom-select" data-allow-clear="true">
                                    <option value="new" {{ strtolower($lead->status) == "new" ? 'selected' : ''
                                        }}>New</option>
                                    <option value="active" {{ strtolower($lead->status) == "active" ? 'selected'
                                        : '' }}>Active</option>
                                    <option value="closed" {{ strtolower($lead->status) == "closed" ? 'selected'
                                        : '' }}>Closed</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Quality</h6>
                                <select id="quality" data-id="{{ $lead->id }}" data-type="quality"
                                    data-url="api/leads/{{ $lead->id }}/change"
                                    class="form-select select-editable custom-select" data-allow-clear="true">
                                    <option value="cold" {{ strtolower($lead->quality) == "cold" ? 'selected' :
                                        '' }}>Cold</option>
                                    <option value="warm" {{ strtolower($lead->quality) == "warm" ? 'selected' :
                                        '' }}>Warm</option>
                                    <option value="hot" {{ strtolower($lead->quality) == "hot" ? 'selected' : ''
                                        }}>Hot</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Stage</h6>
                                <select id="stage" data-id="{{ $lead->id }}" data-type="stage"
                                    data-url="api/leads/{{ $lead->id }}/change"
                                    class="form-select select-editable custom-select" data-allow-clear="true">
                                    <option value="Lead" {{ $lead->stage == 'Lead' ? 'selected' : ''
                                        }}>Lead</option>
                                    <option value="Proposal" {{ $lead->stage == 'Proposal' ? 'selected' : ''
                                        }}>Proposal</option>
                                    <option value="Test Drive" {{ $lead->stage == 'Test Drive' ? 'selected' : ''
                                        }}>Test Drive</option>
                                    <option value="SPK" {{ $lead->stage == 'SPK' ? 'selected' : ''
                                        }}>SPK</option>
                                    <option value="Deal" {{ $lead->stage == 'Deal' ? 'selected' : ''
                                        }}>Deal</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Customer Type</h6>
                                <select id="customer_type" data-id="{{ $lead->id }}" data-type="customer_type"
                                    data-url="api/leads/{{ $lead->id }}/change"
                                    class="form-select select-editable custom-select" data-allow-clear="true">
                                    <option value="B2B" {{ strtoupper($lead->customer_type) == 'b2b' ? 'selected'
                                        : '' }}>B2B</option>
                                    <option value="B2C" {{ strtoupper($lead->customer_type) == 'b2c' ? 'selected'
                                        : '' }}>B2C</option>
                                    <option value="C2B" {{ strtoupper($lead->customer_type) == 'c2b' ? 'selected'
                                        : '' }}>C2B</option>
                                    <option value="C2C" {{ strtoupper($lead->customer_type) == 'c2c' ? 'selected'
                                        : '' }}>C2C</option>
                                </select>
                            </div>
                        </div>

                        <div class="sidebar-card d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark fw-bold" style="font-size: 18px">Contact Information</span>
                                <i class="ti ti-chevron-down text-dark"></i>
                            </div>
                            @foreach($lead->contacts as $contact)
                            <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3">
                                <div class="d-flex flex-column gap-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-dark fw-bold">{{ $contact->first_name ?? '' }} {{
                                            $contact->last_name ?? '' }}</span>
                                        <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit" width="15"
                                            data-bs-toggle="modal" data-bs-target="#add-edit-contact"
                                            class="cursor-pointer">
                                    </div>
                                    <span class="text-dark" style="font-size: 14px">{{ $contact->job_title ?? ''
                                        }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                                            width="15">
                                        <span style="font-size: 12px">{{ $contact->whatsapp ?? '' }}</span>
                                    </div>
                                    <div>
                                        <img src="{{ asset('assets/svg/icons/icon-circle-outline.svg') }}" alt="circle"
                                            width="15">
                                        <span style="font-size: 12px">WhatsApp</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                                            width="15">
                                        <span style="font-size: 12px">{{ $contact->email ?? '' }}</span>
                                    </div>
                                    <div>
                                        <img src="{{ asset('assets/svg/icons/icon-circle-outline.svg') }}" alt="circle"
                                            width="15">
                                        <span style="font-size: 12px">Email</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <button class="btn-link" data-bs-toggle="modal" data-bs-target="#add-contact">
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
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="company_name"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->company_name ?? ' - '
                                    }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark">Industry</span>
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="industry"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->industry ?? ' - ' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark">Location</span>
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="location"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->location ?? ' - ' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark">Website</span>
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="website"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->website ?? ' - ' }}</span>
                            </div>
                        </div>

                        <div class="sidebar-card d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit" width="15"
                                    data-bs-toggle="modal" data-bs-target="#add-deals-info" class="cursor-pointer">

                                <span class="text-dark fw-bold" style="font-size: 18px">Deals Information</span>
                                <i class="ti ti-chevron-down text-dark"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-dark" style="font-weight: 600;">Description</span>
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="description"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->description ?? ' - ' }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark" style="font-weight: 600;">Revenue</span>
                                Rp&nbsp;<span class="input-editable" data-id="{{ $lead->id }}" data-type="budget"
                                    data-url="api/leads/{{ $lead->id }}/change">{{ $lead->budget ?? 0 }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark" style="font-weight: 600;">Close Date</span>
                                <a href="javascript:;" id="editable-date" data-bs-toggle="datepicker">{{ date('Y-m-d', strtotime($lead->closed_date)) }}</a>
                                <input type="hidden" id="date-input" value="">

                                <!-- <span>{{ $lead->closed_date }}</span> -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-dark" style="font-weight: 600;">Source</span>
                                <select class="form-select select-editable custom-select" data-id="{{ $lead->id }}"
                                    data-type="source" data-url="api/leads/{{ $lead->id }}/change"
                                    data-allow-clear="true" style="border: none; padding-left: 0px; bottom: 0px;">
                                    <option value="Outboned" {{ $lead->source == 'Outboned' ? 'selected' : ''
                                        }}>Outboned</option>
                                    <option value="Other" {{ $lead->source == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                    <option value="Website" {{ $lead->source == 'Website' ? 'selected' : '' }}>Website
                                    </option>
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
                                <span class="input-editable" data-id="{{ $lead->id }}" data-type="next_step"
                                    data-url="api/leads/{{ $lead->id }}/change">{{
                                    $lead->next_step ?? ' - ' }}</span>
                            </div>
                        </div>

                    </x-sidebar-right-info-chat>
                    <!-- /Customer info -->

                    <div class="d-flex flex-column" style="width: 45%">
                        <ul class="nav nav-tabs nav-tabs-customer-detail" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link nav-item-customer-detail active" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#tab-ticket" aria-controls="tab-ticket"
                                    aria-selected="false">Tickets</button>
                            </li>
                        </ul>
                        <div class="tab-content-chat">
                             <section class="tab-ticket tab-pane fade active show" id="tab-ticket" role="tabpanel">
                                <div class=" d-flex flex-column gap-2">
                                    <div class="d-flex flex-wrap justify-content-between card-filter mt-3">
                                        <button class="btn btn-sm button-new" data-bs-toggle="modal" data-bs-target="#add-ticket">
                                            New
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="d-flex header-filter">
                                            <button class="active">Open</button>
                                            <button>In-Progress</button>
                                            <button>Pending</button>
                                            <button>Closed</button>
                                        </div>
                                        <button class="btn btn-sm button-filter">
                                            <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                                            Filters
                                        </button>
                                    </div>
                                    <div class="d-flex flex-column gap-3 wrapper-content-ticket" id="customer-detail-content-email">
                                        @foreach($tickets as $ticket)
                                        <div class="card-ticket d-flex flex-column gap-3 pb-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-dark fw-bold">{{ $ticket->title }}</span>
                                                <span style="font-size: 12px;">{{ date('M d, Y', strtotime($ticket->deadline)) }}</span>
                                            </div>
                                            <span class="text-dark">{{ $ticket->description }}</span>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                    <i class="ti ti-user user-icon text-dark"></i>
                                                    <small>{{ $ticket->type }}</small>
                                                </div>
                                                <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
                                                    {{ $ticket->priority }}
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Client info -->
                    <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-client-info"
                        sidebarBodyClass="mt-2">
                        <div class="sidebar-card d-flex flex-column">
                            <h4 class="text-dark fw-bold">Progress / stage</h3>
                            <div class="d-flex align-items-center gap-1">
                                @if($lead->stage == 'Lead')
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                @elseif($lead->stage == 'Proposal')
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                @elseif($lead->stage == 'Test Drive')
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                @elseif($lead->stage == 'SPK')
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                @elseif($lead->stage == 'Deal')
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                                @endif
                                <!-- <div style="background: #667085; width: 20%; height: 8px;"></div>
                                <div style="background: #667085; width: 20%; height: 8px;"></div>
                                <div style="background: #667085; width: 20%; height: 8px;"></div>
                                <div style="background: #667085; width: 20%; height: 8px;"></div> -->
                            </div>
                            <span class="mt-3 text-dark fw-bold" style="font-size: 12px;"></span>
                        </div>
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
                        <!-- <div class="sidebar-card d-flex flex-column">
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
                        </div> -->
                    </x-sidebar-right-info-chat>
                    <!-- Client info -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal activities --}}
@include('content/customer/components/customer-modal-activities')

<x-modal title="Add Contact" modalClass="modal-md" url="{{ route('leads.add-contact') }}" isPost="true"
    submitText="Save" name="add-contact">
    <div class="d-flex flex-column gap-3">
        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
        <div class="d-flex flex-row mb-3 gap-4">
            <div class="mb-3">
                <label class="form-label" for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control"
                    placeholder="Enter First Name" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" />
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="job_title">Job Title</label>
            <select name="job_title" id="job_title" class="form-select form-control">
                <option value="Sales Executive">Sales Executive</option>
                <option value="Sales Representative">Sales Representative</option>
                <option value="Senior Sales">Senior Sales</option>
                <option value="Branch Manager">Branch Manager</option>
            </select>
        </div>
        <div id="more-contact">
            <div class="d-flex flex-row mb-3 gap-4">
                <div class="mb-3">
                    <label class="form-label" for="whatsapp">Whatsapp</label>
                    <select name="whatsapp" id="whatsapp" class="form-select form-control">
                        <option value="whatsapp" selected>Whatsapp</option>
                        <!-- <option value="email">Email</option> -->
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="whatsapp_contact">Contact</label>
                    <input type="text" name="whatsapp_contact" id="whatsapp_contact" class="form-control"
                        placeholder="Enter Phone Number" />
                </div>
            </div>
            <div class="d-flex flex-row mb-3 gap-4">
                <div class="mb-3">
                    <label class="form-label" for="email">email</label>
                    <select name="email" id="email" class="form-select form-control">
                        <option value="email" selected>Email</option>
                        <!-- <option value="email">Email</option> -->
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email_contact">Contact</label>
                    <input type="text" name="email_contact" id="email_contact" class="form-control"
                        placeholder="Enter Email" />
                </div>
            </div>
        </div>
        <!-- <div class="mb-3">
                <a href="javascript:;" class="btn-link" id="#add-channel">
                    + Add more channels
                </a>
            </div> -->
    </div>
</x-modal>

{{-- modal add/edit contact --}}
<x-modal title="Add Contact" name="add-edit-contact" submitText="Save contact" buttonSubmitClass=""
    buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100">
    <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3 align-items-start">
        <div class="d-flex flex-column gap-3">
            <div class="d-flex justify-content-between gap-5 w-100">
                <x-input-floating label="First Name" id="first name" name="first name"></x-input-floating>
                <x-input-floating label="Last Name" id="last name" name="last name"></x-input-floating>
            </div>
            <div class="d-flex justify-content-between gap-5 w-100">
                <x-input-floating label="Channel" placeholder="Please select channel" id="channel" name="channel"
                    type="select" :options="$listChannels"></x-input-floating>
                <x-input-floating label="Contact" id="contact" name="contact"></x-input-floating>
            </div>

            {{-- !! Dont remove this tag --}}
            <div class="hidden" id="wrapper-channel"></div>
            {{-- !! Dont remove this tag --}}

            <x-input-floating label="Job Title" id="job title" name="job title"></x-input-floating>
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
<x-modal title="New Message" name="communication-email" submitText="Send" buttonSubmitClass=""
    buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100">
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Reply to" id="reply_to" name="reply_to"></x-input-floating>
        <x-input-floating label="Subject" id="subject" name="subject"></x-input-floating>
        <div class="full-editor" id="full-editor"></div>
    </div>
</x-modal>

{{-- modal add ticket --}}
<x-modal title="Add Ticket" name="add-ticket" submitText="Submit" buttonSubmitClass=""
    buttonWrapperSubmitClass="d-flex justify-end w-100 justify-content-center" modalClass="">
    <div class="d-flex flex-column gap-4">
        <x-input-floating label="Ticket Name" id="ticket_name" name="ticket_name"></x-input-floating>
        <div class="d-flex justify-content-between gap-5 w-100">
            <x-input-floating label="Ticket ID" id="ticket_id" name="ticket_id"></x-input-floating>
            <x-input-floating label="Resolution Date" id="resolution-date" name="resolution-date"></x-input-floating>
        </div>
        <div class="d-flex align-items-center justify-content-between gap-3">
            <div class="d-flex flex-column">
                <span class="text-dark" style="font-size: 14px;">Ticket Type</span>
                <select id="status" class="form-select custom-select" data-allow-clear="true"
                    style="border: none; padding-left: 0px;">
                    @foreach ($listTicketTypes as $key => $value)
                    <option value="{{ $value->value }}">{{ $value->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-column">
                <span class="text-dark" style="font-size: 14px;">Priority</span>
                <select id="status" class="form-select custom-select" data-allow-clear="true"
                    style="border: none; padding-left: 0px;">
                    @foreach ($listPrioritys as $key => $value)
                    <option value="{{ $value->value }}">{{ $value->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-column">
                <span class="text-dark" style="font-size: 14px;">Status</span>
                <select id="status" class="form-select custom-select" data-allow-clear="true"
                    style="border: none; padding-left: 0px;">
                    @foreach ($listStatusProjects as $key => $value)
                    <option value="{{ $value->value }}">{{ $value->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-between gap-5 w-100">
            <x-input-floating label="Team" placeholder="Please select team" id="team" name="team" type="select"
                :options="$listTeams">
            </x-input-floating>
            <x-input-floating label="Member" placeholder="Please select member" id="member" name="member" type="select"
                :options="$listMembers">
            </x-input-floating>
        </div>
        <x-input-floating id="ticket_note" name="ticket_note" label="Ticket Notes" placeholder="Write a note"
            type="textarea" cols="33" rows="5"></x-input-floating>
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
                    <div class="col-xl-8"
                        style="padding: 16px; border-radius: 12px; border: 1px solid #DDE0E4; background: #FFF;">
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
                                                <input type="text" name="revenue" placeholder=""
                                                    value="{{ $lead->budget }}" class="form-control name_list" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Close Date
                                            </td>
                                            <td>
                                                <input type="text" name="close-date" placeholder=""
                                                    value="{{ $lead->closed_date }}" class="form-control name_list" />
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
                                                    <input type="text" name="label[]" placeholder="" id="label{{ $i }}"
                                                        class="form-control label_list" value="{{ $label }}" />
                                            </td>
                                            <td>
                                                <input type="text" name="name[]" placeholder="" id="name{{ $i }}"
                                                    class="form-control name_list" value="{{ $name }}" />
                                            </td>
                                            <td width="5%"><button type="button" name="remove" id="{{ $i }}"
                                                    class="btn btn-danger btn-sm btn_remove">X</button></td>
                                        </tr>
                                        @endforeach
                                        <input type="hidden" name="totalData" id="totalData" class="form-control"
                                            value="{{ $i }}" />

                                    </table>
                                </div>

                                <div class="modal-footer d-flex justify-content-center align-items-center w-100 p-4">
                                    <button type="button" data-bs-dismiss="modal" id="add-submit"
                                        class="btn btn-primary">Save Info</button>
                                    <button type="button" data-bs-dismiss="modal" class="btn"
                                        style="background: #667085; color: #FFF;">Close</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="bg-lighter rounded col-xl-4"
                        style="padding: 16px;border-radius: 12px;border: 1px solid #DDE0E4;background: #FFF;">
                        <div class="row py-8">

                            <ul id="frmb-control-box" class="frmb-control">
                                <li class="input-control" data-type="checkbox-group">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio1">
                                        <input name="optRadio" class="form-check-input" type="radio" value="1"
                                            id="customOptRadio1">
                                        <span>Checkbox Group</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="radio-group">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio2">
                                        <input name="optRadio" class="form-check-input" type="radio" value="2"
                                            id="customOptRadio2">
                                        <span>Radio Group</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="select">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio3">
                                        <input name="optRadio" class="form-check-input" type="radio" value="3"
                                            id="customOptRadio3">
                                        <span>Select</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="textarea">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio4">
                                        <input name="optRadio" class="form-check-input" type="radio" value="4"
                                            id="customOptRadio4">
                                        <span>Text Area</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="date">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio5">
                                        <input name="optRadio" class="form-check-input" type="radio" value="5"
                                            id="customOptRadio5">
                                        <span>Date Field</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="number">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio6">
                                        <input name="optRadio" class="form-check-input" type="radio" value="6"
                                            id="customOptRadio6">
                                        <span>Number</span>
                                    </label>
                                </li>
                                <li class="input-control" data-type="text">
                                    <label class="form-check-label custom-option-content form-check-input-payment"
                                        for="customOptRadio7">
                                        <input name="optRadio" class="form-check-input" type="radio" value="7"
                                            id="customOptRadio7">
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
                            <button type="button" class="btn btn-primary btn-sm mx-auto mt-2" id="add-more">
                                + Add more fields
                            </button>
                        </div>
                    </div>
                </div>
                @endsection