@php
$getInitial = Helper::getInitial($title);
@endphp

<div class="d-flex align-items-center gap-2 w-100">
    <div class="flex-shrink-0 avatar">
        <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">{{ $getInitial }}</span>
    </div>
    @if($rightBody)
    <div class="d-flex justify-content-between w-100 align-items-center">
        <div class="d-flex flex-column">
            <span class="text-dark fw-bold" id="chat-title">{{ $title }}</span>
            <small class="text-muted">{{ $subtitle }}</small>
        </div>
        <div class="d-flex flex-column align-items-center gap-2">
            {{ $rightBody }}
        </div>
    </div>
    @else
    <div class="d-flex flex-column w-100">
        <div class="d-flex align-items-center justify-content-between">
            @if($customTitle)
            {{ $customTitle }}
            @else
            <span class="text-dark fw-bold" id="chat-title">{{ $title }}</span>
            @endif
            
            @if($countUnread)
            <div class="unread-chat text-center">{{ $countUnread }}</div>
            @endif
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <small class="text-muted">{{ $subtitle }}</small>
            <small class="time">{{ $time }}</small>
        </div>
    </div>
    @endif
</div>