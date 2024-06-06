@switch(strtolower($type))
 @case('low priority')
 @case('cold')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
       {{ $type }}
    </span>
    @break
  @case('medium priority')
  @case('warm')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #F8D990;">
        {{ $type }}
    </span>
    @break
  @case('high priority')
  @case('hot')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #FBC5BC;">
        {{ $type }}
    </span>
    @break
  @default
    <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
        {{ $type ?? '-' }}
    </span>
@endswitch
