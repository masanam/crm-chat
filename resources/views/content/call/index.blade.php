@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/call.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@php
    $obj1 = (object) [
        'name' => '+62 811-811-256',
        'time' => '12:48 PM',
        'status' => 'Missed',
    ];

    $myArray = [$obj1];

    $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    $tab = (object) [
        'name' => 'All',
        'lengthData' => 5
    ];
    $tab2 = (object) [
        'name' => 'Missed',
        'lengthData' => 5
    ];
    $listTabs = [$tab, $tab2];
@endphp

@section('content')
    <section class="row">
        <div class="app-chat call-content card overflow-hidden">
            <div class="row g-0">
                <!-- Chat & Contacts -->
                <x-sidebar-chat-contacts
                    :tabs="$listTabs"
                    targetOpenModal="#contacts"
                    title="Calls"
                    isUsingSearch="{{ false }}"
                    wrapperClassname='col'
                >
                    <x-slot name="body">
                        <div class="tab-content p-0">
                            <div class="tab-pane active" id="open" role="tabpanel" aria-labelledby="open-tab">
                                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                    @foreach ($myArray as $key => $value)
                                        <li class="chat-contact-list-item">
                                            <a class="d-flex align-items-center gap-3">
                                                <div class="flex-shrink-0 avatar">
                                                    <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">
                                                        -
                                                    </span>
                                                </div>

                                                <div class="d-flex justify-content-between w-100">
                                                    <div class="d-flex flex-column justify-content-between gap-2">
                                                        <h6 class="chat-contact-name text-truncate m-0 text-dark fw-bolder">
                                                            {{ $value->name }}
                                                        </h6>
                                                        <x-badge-status-call status="{{ $value->status }}">
                                                            {{ $value->status }}
                                                        </x-badge-status-call>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-between align-items-end">
                                                        <small>{{ $value->time }}</small>
                                                        <img
                                                            src="{{ asset('assets/svg/icons/info.svg') }}"
                                                            alt="info"
                                                            width="20"
                                                        >
                                                    </div>
                                                </div>

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                    <li class="chat-contact-list-item chat-list-item-0">
                                        <h6 class="text-muted mb-0">No Chats Found</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </x-slot>
                </x-sidebar-chat-contacts>
            </div>
        </div>
    </section>

    {{-- modal add/select contact --}}
    <x-modal title="Call" name="contacts" isUsingBtnFooter="{{ false }}">
        <div class="d-flex flex-column gap-3 modal-add-contact">
            <div class="d-flex flex-column gap-2">
                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                    <span class="input-group-text form-search-custom" id="basic-addon-search31"><i
                            class="ti ti-search"></i></span>
                    <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search contacts"
                            aria-label="Search contacts" aria-describedby="basic-addon-search31">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column modal-contact">
                    <a target="#" class="d-flex flex-column" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#call">
                        <h6 class="text-dark fw-bold">R</h6>
                        <div class="d-flex align-items-center gap-2 modal-contact-body">
                            <div class="flex-shrink-0 avatar">
                                <span class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Jonathan') }}</span>
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
                    </a>
                </div>
                <div class="alphabet">
                    @foreach($alphabet as $alpha)
                    <small class="text-dark">{{ $alpha }}</small>
                    @endforeach
                </div>   
            </div>
        </div>
    </x-modal>

    <x-modal
        title=""
        name="call"
        isUsingBtnFooter="{{ false }}"
        isModalStack="{{ true }}"
        targetNameModalStack="contacts"
        isUsingButtonClose="{{ true }}"
    >
        <div class="d-flex flex-column align-items-center gap-5 modal-call mb-5">
            <div class="d-flex flex-column align-items-center">
                <span class="badge-call text-dark">{{ Helper::getInitial('Ricky Jonathan') }}</span>
                <div class="d-flex flex-column align-items-center gap-2 mt-4 info-call">
                    <h4 class="text-dark fw-bold">Ricky Jonathan</h4>
                    <h6>+62 811-818-256</h6>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3 wrapper-button-call">
                <button class="btn-additional grey">
                    <img src="{{asset('assets/svg/icons/volume-up.svg')}}" alt="speaker">
                </button>
                <button class="btn-additional grey">
                    <img src="{{asset('assets/svg/icons/mic-off.svg')}}" alt="speaker">
                </button>
                <button class="btn-additional red">
                    <img src="{{asset('assets/svg/icons/call-end.svg')}}" alt="speaker">
                </button>
            </div>
        </div>
    </x-modal>
@endsection
