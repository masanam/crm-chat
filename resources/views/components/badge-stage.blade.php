@switch(strtolower($type))
 @case('new')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #CCE8E8;">
       {{ $type }}
    </span>
    @break
  @case('high priority')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #F5C1B9;">
        {{ $type }}
    </span>
    @break
  @case('contracted')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #E6F8EF;">
        {{ $type }}
    </span>
    @break
  @case('in negotiation')
    <span class="badge badge-sm rounded-pill text-dark" style="background: #DBD2F7;">
        {{ $type }}
    </span>
    @break
  @default
    <span class="badge badge-sm rounded-pill text-dark" style="background: #DBD2F7;">
        {{ $type ?? '-' }}
    </span>
@endswitch
