<div class="sidebar-card d-flex flex-column">
    <h4 class="text-dark fw-bold">Progress / stage</h3>
    <div class="d-flex align-items-center gap-1">
        @for($i = 1; $i <= 5; $i++)
            @if($i <= $statusId)
            <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
            @endif
        @endfor
        <!-- <div style="background: #667085; width: 20%; height: 8px;"></div>
        <div style="background: #667085; width: 20%; height: 8px;"></div>
        <div style="background: #667085; width: 20%; height: 8px;"></div>
        <div style="background: #667085; width: 20%; height: 8px;"></div> -->
    </div>
    <span class="mt-3 text-dark fw-bold" style="font-size: 12px;">{{ $statusName }}</span>
</div>