@php
$getInitial = Helper::getInitial($title);
$bglabel = ($totalMember > 1) ? 'bg-label-warning':'bg-label-success';
$avatarOnline = ($totalMember > 1) ? 'avatar avatar-online':'avatar avatar-offline';

@endphp

<div class="d-flex align-items-center gap-2 w-100">
    <div class="flex-shrink-0 avatar">
        <span class="avatar-initial {{$avatarOnline}} rounded-8 {{$bglabel}} text-dark fw-bolder">{{ $getInitial }}</span>
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
    <div class="d-flex flex-column w-100 list-group-item">
        <a href="#">
            <div class="d-flex align-items-center justify-content-between">
                @if($customTitle)
                {{ $customTitle }}
                @else
                <div class="text-start text-dark fw-bold" id="chat-title">{{ $title }}</div>
                @endif
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span class="text-muted" style="width: 145px;">{{ $subtitle }}</span>
                <span class="time">{{ $time }}</span>
            </div>
            <div class="d-flex justify-content-between gap-2">
                <div class="d-flex gap-0">
                    @if($totalMember)
                    <span class="badge bg-primary rounded-pill ms-auto">{{ $totalMember }} Member</span>
                    @endif
                </div>
            </div>

            @if($countUnread)
            <div class="badge bg-danger rounded-pill ms-auto">{{ $countUnread }}</div>
            @endif
        </a>
    </div>
    @endif
</div>