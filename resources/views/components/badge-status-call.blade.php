<div class="rounded-pill badge-status-call d-flex align-items-center gap-1 {{ strtolower($status) === 'missed' ? 'missed-call' : '' }}">
    @switch(strtolower($status))
    @case('incoming')
        <i class="ti ti-arrow-down-left"></i>
        @break
    @case('outgoing')
        <i class="ti ti-arrow-up-right"></i>
        @break
    @case('missed')
        <i class="ti ti-arrow-elbow-left"></i>
        @break
    @default
        <i class="ti ti-arrow-down-left"></i>
    @endswitch
    <small class="text-dark">{{ $slot }}</small>
</div>