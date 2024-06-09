@php
$getInitial = Helper::getInitial($name);
@endphp

<div class="col app-chat-sidebar-right app-sidebar {{$sidebarClass}}" id="app-chat-sidebar-right">
    {{-- <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="d-flex align-items-center gap-2">
            <i class="ti ti-x text-dark fw-bold close-sidebar" data-bs-toggle="sidebar"
            data-overlay data-target="#app-chat-sidebar-right"></i>
            <h4 class="text-sidebar-header fw-bold text-dark">{{ $title }}</h4>
        </div>
        @if($isUsingBtnEdit)
        <button class="btn" data-bs-toggle="modal" data-bs-target="#modal">
            <img src="{{asset('assets/svg/icons/edit.svg')}}" alt="info" width="20">
        </button>
        @endif
    </div>
    <div
        class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-4">
        <p class="timezone">{{ $time }}</p>
        <div class="flex-shrink-0 avatar {{ $customAvatarClass }}">
            <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">{{ $getInitial }}</span>
        </div>
        <h6 class="mt-2 mb-0 text-dark fw-bold">{{ $name }}</h6>
        @if($subtitle)
        <h6 class="mt-3 mb-0 {{ $customSubtitleClass }}">{{ $subtitle }}</h6>
        @endif
        <h6 class="mt-0 mb-0">{{ $email }}</h6>
        @if($isUsingBtnHeader)
        <button class="btn btn-create-task d-flex align-items-center justify-content-center w-100" data-bs-toggle="modal" data-bs-target="#create-task">{{ $btnHeaderName }}</button>
        @endif
    </div> --}}
    <div class="sidebar-body px-2 mt-4" style="padding-bottom: 4.5rem;">
       {{ $slot }}
    </div>
</div>