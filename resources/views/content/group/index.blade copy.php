@extends('layouts/layoutMaster')

@section('title', 'Group Management')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/plyr/plyr.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/group.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-academy-details.css')}}" />

@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{asset('assets/vendor/libs/plyr/plyr.js')}}"></script>

@endsection

@section('page-script')
<script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="{{ asset('assets/js/group.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="">
        <div class="app-chat group-chat card overflow-hidden">
            <div class="row g-0" id="content-group-chat">

                <x-sidebar-chat-contacts title="Internal" :tabs="['New', 'Active', 'Success', 'Failed']" isUsingFilterChat="{{ false }}" placeholderSearchText="Search groups/conversations" targetOpenModal="#new-chat">
                    <x-slot name="customHeader">

                    </x-slot>

                    <x-slot name="body" class="sidebar-body">
                        <div class="d-flex flex-column gap-3 chat-wrapper">
                            <div class="d-flex flex-column gap-2 mb-4">

                                <div class="accordion accordion-bordered" id="courseContent">
                                    <div class="accordion-item mb-0">
                                        <div class="accordion-header" id="headingOne">
                                            <button type="button" class="accordion-button bg-lighter rounded-0 collapsed" data-bs-toggle="collapse" data-bs-target="#chapterOne" aria-expanded="false" aria-controls="chapterOne">
                                                <span class="d-flex flex-column">
                                                    <span class="h5 mb-1">Groups</span>
                                                </span>
                                            </button>
                                        </div>
                                        <div id="chapterOne" class="accordion-collapse collapse" data-bs-parent="#courseContent" style="">
                                            <div class="accordion-body py-3 border-top">
                                                <div class="form-check d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="">
                                                    <label for="defaultCheck1" class="form-check-label ms-3">
                                                        <span class="mb-0 h6">1. Welcome to this course</span>
                                                        <span class="text-muted d-block">2.4 min</span>
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" checked="">
                                                    <label for="defaultCheck2" class="form-check-label ms-3">
                                                        <span class="mb-0 h6">2. Watch before you start</span>
                                                        <span class="text-muted d-block">4.8 min</span>
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck3">
                                                    <label for="defaultCheck3" class="form-check-label ms-3">
                                                        <span class="mb-0 h6">3. Basic design theory</span>
                                                        <span class="text-muted d-block">5.9 min</span>
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center mb-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck4">
                                                    <label for="defaultCheck4" class="form-check-label ms-3">
                                                        <span class="mb-0 h6">4. Basic fundamentals</span>
                                                        <span class="text-muted d-block">3.6 min</span>
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck5">
                                                    <label for="defaultCheck5" class="form-check-label ms-3">
                                                        <span class="mb-0 h6">5. What is ui/ux</span>
                                                        <span class="text-muted d-block">10.6 min</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-dark fw-600">Groups</small>
                                    <button class="button-none" data-bs-toggle="modal">
                                        <i class="ti ti-plus"></i>
                                    </button>
                                </div>


                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex flex-column gap-4" id="chat-contact-group">
                                        @foreach($groupList as $key => $value)

                                        <div class="d-flex flex-column card-group gap-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-dark fw-bold" id="chat-group-title">{{ $value->name }}</span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-dark">{{ $value->message }}</span>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="badge badge-sm badge-group rounded-pill" id="chat-group-member">{{ $value->total }} Members</span>
                                                <small class="time">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <small class="text-dark fw-600">1 one 1</small>
                                <div class="d-flex flex-column gap-4" id="chat-contact-one">
                                    @foreach($chatList as $key => $value)
                                    <x-card-chat title="{{ $value->client_name }}" subtitle="{{ $value->message }}" countUnread="{{ $value->total_count }}" time="{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}">
                                    </x-card-chat>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-sidebar-chat-contacts>
                <!-- /Chat contacts -->

                <!-- Chat History Group -->
                <div class="col app-chat-history bg-body">

                </div>
                <!-- /Chat History Group -->

                <!-- Sidebar Right Group -->
                <x-sidebar-right-info-chat title="About Group" name="Toyota Woodlands" subtitle="Awesome team of Toyota Woodlands" isUsingBtnHeader="{{ false }}" isUsingBtnEdit="{{ false }}">
                    <div class="sidebar-card d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <h6 class="text-dark fw-bold">Group introduction</h6>
                            <i class="ti ti-arrow-right text-dark"></i>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
                    </div>
                    <div class="d-flex flex-column gap-2 mt-3">
                        <h6 class="text-dark fw-bold">Members</h6>
                        <div class="d-flex flex-column gap-4">
                            @foreach($groupMember as $key => $value)
                            <x-card-chat title="{{ $value->name }}" subtitle="{{ $value->position }}">
                                <x-slot name="rightBody">
                                    <small class="text-xs">{{ $value->role }}</small>
                                </x-slot>
                            </x-card-chat>
                            @endforeach
                        </div>
                    </div>
                </x-sidebar-right-info-chat>
                <!-- /Sidebar Right Group -->

                <!-- Sidebar Right One on One -->
                <x-sidebar-right-info-chat title="Profile" name="Ricky Jonathan" subtitle="Head of Sales" isUsingBtnHeader="{{ false }}" isUsingBtnEdit="{{ false }}" customAvatarClass="custom-avatar" customSubtitleClass="custom-subtitle" sidebarClass="sidebar-one-on-one">
                    <div class="d-flex flex-column mt-3">
                        <h6 class="text-dark fw-bold">Group in common</h6>
                        <div class="d-flex flex-column gap-4">
                            @foreach($groupChat as $key => $value)
                            <x-card-chat title="{{ $value->groupName }}" subtitle="{{ $value->countMembers }} Members">
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
            @foreach($groupMember as $key => $value)
            <x-card-chat title="{{ $value->name }}" subtitle="{{ $value->position }}">
            </x-card-chat>
            @endforeach
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
        <div class="d-flex flex-column">
            <h6 class="text-dark">Members</h6>
            <div class="d-flex px-3 flex-column gap-4">
                @foreach($groupMember as $key => $value)
                <div class="d-flex justify-content-between align-items-center">
                    <label class="form-check-label" for="{{ $value->name }}">
                        <x-card-chat title="{{ $value->name }}" subtitle="{{ $value->position }}">
                        </x-card-chat>
                    </label>
                    <input class="form-check-input" type="checkbox" id="{{ $value->name }}" value="{{ $value->name }}" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-modal>
@endsection