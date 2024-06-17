<div class="d-flex flex-column gap-3" style="background: #FFFFFF; border-radius: 20px; padding: 16px 24px;">
    <div class="d-flex align-items-center justify-content-between pb-3" style="border-bottom: 1px solid #98A2B3;">
        <div class="d-flex align-items-center gap-2">
            <div class="flex-shrink-0 avatar avatar-sm">
                <span class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Ricky Jonathan') }}</span>
            </div>
            <div class="d-flex align-items-center gap-1">
                <span class="text-dark fw-bold">{{ $title }}</span>
                <span class="text-dark">-</span>
                <span class="text-dark">{{ $subtitle }}</span>
            </div>
        </div>
        <span style="font-size: 12px;">{{ $createdAt }}</span>
    </div>
    {{ $slot }}
</div>