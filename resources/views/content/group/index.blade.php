@extends('layouts/layoutMaster')

@section('title', 'Group Management')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/group.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="{{ asset('assets/js/group.js') }}"></script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
@endsection

@section('content')
<div class="row">
    <div class="">
        <div class="app-chat group-chat card overflow-hidden">
            <div class="row g-0" id="content-group-chat">

                <x-sidebar-chat-groups title="Internal" :tabs="['New', 'Active', 'Success', 'Failed']" isUsingFilterChat="{{ false }}" placeholderSearchText="Search groups/conversations" targetOpenModal="#new-chat">
                    <x-slot name="customHeader">

                        <!-- @foreach($internalChat as $key => $value)
                        <x-card-chat title="{{ $value->first_name }}  {{ $value->last_name }}">
                            <x-slot name="customTitle">
                                <h4 class="title-card text-dark fw-bold">{{ $value->first_name }} {{ $value->last_name }}</h3>
                            </x-slot>
                        </x-card-chat>
                        @endforeach -->
                    </x-slot>

                    <x-slot name="body" class="sidebar-body">

                        <button class="accordion accordion-button bg-lighter rounded-0 collapsed" style="padding:15px;border-bottom:1px solid #dbdade;">
                            <span class="d-flex flex-column w-100">
                                <span class=" h5 mb-1">Groups</span>
                            </span>
                            <span class="badge bg-light rounded-pill ms-auto text-dark float-right">10</span>
                        </button>
                        <div class="panel" id="chat-contact-one" style="display: block;">
                            @foreach($groupList as $key => $value)
                            @php
                            $getInitial = Helper::getInitial($value->name);
                            $bglabel = ($value->total > 1) ? 'bg-label-warning':'bg-label-success';
                            @endphp

                            <div class="d-flex align-items-center justify-content-between pb-4 list-group-item-action" style="padding:10px;border-bottom:1px solid #dbdade">
                                <div class="d-flex align-items-center gap-2 w-100">
                                    <div class="flex-shrink-0 avatar">
                                        <span class="avatar-initial rounded-8 {{$bglabel}} text-dark fw-bolder">{{ $getInitial }}</span>
                                    </div>
                                    <div class="d-flex flex-column w-100 list-group-item">
                                        <a href="#">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="text-start text-dark fw-bold" id="chat-title">{{ $value->name }}</div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-muted">{{ $value->message }}</span>
                                                <span class="time">{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex gap-0">
                                                    <span class="badge bg-primary rounded-pill ms-auto">{{ $value->total }} Member</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div class="d-flex flex-column gap-3 chat-wrapper">

                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="h5 mb-1">1 on 1</span>
                                    <span class="badge bg-light rounded-pill ms-auto text-dark">10</span>
                                </div>

                                <div class="d-flex flex-column gap-4" id="chat-contact-one">
                                    @foreach($chatList as $key => $value)
                                    <x-card-chat title="{{ $value->client_name }}" subtitle="{{ $value->message }}" time="{{ \Carbon\Carbon::parse($value->created_at)->format('d-m-Y') }}">
                                    </x-card-chat>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-sidebar-chat-groups>
                <!-- /Chat contacts -->

                <!-- Chat History Group -->
                <div class="col app-chat-history bg-body">

                </div>
                <!-- /Chat History Group -->

                <!-- Sidebar Right Group -->
                <x-sidebar-right-info-chat title="About Group" name="Toyota Woodlands" subtitle="Awesome team of Toyota Woodlands" isUsingBtnHeader="{{ false }}" isUsingBtnEdit="{{ false }}" sidebarClass="sidebar-one-on-one">
                    <div class="sidebar-card d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-dark fw-bold">Group introduction</h6>
                            <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit" width="15" data-bs-toggle="modal" data-bs-target="#add-edit-contact" class="cursor-pointer">
                        </div>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
                    </div>
                    <div class="sidebar-card d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-dark fw-bold">Members</h6>
                            <img src="{{ asset('assets/svg/icons/person_add.svg') }}" alt="edit" width="15" data-bs-toggle="modal" data-bs-target="#new-member" class="cursor-pointer">
                        </div>

                        <div class="d-flex px-3 flex-column gap-4">
                            @foreach($chatList as $key => $value)
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-check-label" for="{{ $value->client_name }}">
                                    <x-card-chat title="{{ $value->client_name }}" subtitle="">
                                    </x-card-chat>
                                </label>
                                <i class="ti ti-dots-vertical" id="add-dropdown"></i>
                                <div class="modal-dropdown-member hidden">
                                    <div class="d-flex flex-column gap-1 align-items-end">
                                        <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#log-call">
                                            Make Admin
                                            <img src="{{asset('assets/svg/icons/person_add.svg')}}" alt="call" width="15">
                                        </button>
                                        <button class="btn d-flex gap-2" style="font-size: 12px" data-bs-toggle="modal" data-bs-target="#log-meeting">
                                            Delete
                                            <img src="{{asset('assets/svg/icons/delete-member.svg')}}" alt="log-meeting" width="15">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </x-sidebar-right-info-chat>
                <!-- /Sidebar Right Group -->

                <!-- Sidebar Right One on One -->
                <x-sidebar-right-info-chat title="Profile" name="Ricky Jonathan" subtitle="Head of Sales" isUsingBtnHeader="{{ false }}" isUsingBtnEdit="{{ false }}" customAvatarClass="custom-avatar" customSubtitleClass="custom-subtitle">
                    <div class="sidebar-card d-flex flex-column mt-3">
                        <h6 class="text-dark fw-bold">Group in common</h6>
                        <div class="d-flex flex-column gap-4">
                            @foreach($groupList as $key => $value)
                            <x-card-chat title="{{ $value->name }}" subtitle="{{ $value->total }} Members">
                            </x-card-chat>
                            @endforeach
                        </div>
                    </div>
                </x-sidebar-right-info-chat>
                <!-- /Sidebar Right One on One -->

                <div class="app-overlay"></div>
            </div>
        </div>
    </div>
</div>

{{-- modal new chat --}}
<x-modal title="New Chat" name="new-chat" isUsingBtnFooter="{{ false }}">
    <div class="d-flex flex-column gap-3 modal-add-contact">
        <div class="d-flex flex-column gap-2 border-bottom">
            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                <span class="input-group-text form-search-custom" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search team members" aria-label="Search team members" aria-describedby="basic-addon-search31">
            </div>
            <div class="d-flex gap-2 align-items-center">
                <x-button-add-contact target="#add-group" name="Create New Group"></x-button-add-contact>
            </div>
        </div>
        <div class="d-flex flex-column gap-3">
            @foreach($chatList as $key => $value)
            <x-card-chat title="{{ $value->client_name }}" subtitle="">
            </x-card-chat>
            @endforeach
        </div>
    </div>
</x-modal>

{{-- modal new chat --}}
<x-modal title="New Member" name="new-member" isUsingBtnFooter="{{ false }}">
    <div class="d-flex flex-column gap-3 modal-add-contact">
        <div class="d-flex flex-column gap-3">
            @foreach($chatList as $key => $value)
            <div class="d-flex justify-content-between align-items-center">
                <x-card-chat title="{{ $value->client_name }}" subtitle="">
                </x-card-chat>
                <input class="form-check-input" type="checkbox" id="{{ $value->client_name }}" value="{{ $value->client_name }}" />
            </div>

            @endforeach
        </div>
        <div class="modal-footer d-flex justify-content-center align-items-center w-100">
            <button type="button" data-bs-dismiss="modal" class="btn btn-primary ">Add Member</button>
        </div>
    </div>
</x-modal>


{{-- modal create new group --}}
<x-modal title="Create New Group" name="add-group" submitText="Create Group" isModalStack="{{ true }}" targetNameModalStack="new-chat">
    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column">
            <h6 class="text-dark">Group Details</h6>
            <div class="d-flex flex-column gap-3">
                <x-input-floating label="Group Name" placeholder="Please input group name" id="group name" name="group name"></x-input-floating>
                <x-input-floating id="group description" name="group description" label="Group Description" placeholder="Please input group description" type="textarea" cols="33" rows="5"></x-input-floating>
            </div>
        </div>
        <div class="sidebar-card d-flex flex-column">
            <h6 class="text-dark">Members</h6>
            <div class="d-flex px-3 flex-column gap-4">
                @foreach($chatList as $key => $value)
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-check-label" for="{{ $value->client_name }}">
                        <x-card-chat title="{{ $value->client_name }}" subtitle="">
                        </x-card-chat>
                    </label>
                    <input class="form-check-input" type="checkbox" id="{{ $value->client_name }}" value="{{ $value->client_name }}" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-modal>
@endsection