<ul class="menu-sub">
  @if (isset($menu))
  @foreach ($menu as $submenu)

  {{-- active menu method --}}
  @php
  $activeClass = null;
  $active = $configData["layout"] === 'vertical' ? 'active open':'active';
  $currentRouteName = Route::currentRouteName();

  if ($currentRouteName === $submenu->slug) {
  $activeClass = 'active';
  }
  elseif (isset($submenu->submenu)) {
  if (gettype($submenu->slug) === 'array') {
  foreach($submenu->slug as $slug){
  if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
  $activeClass = $active;
  }
  }
  }
  else{
  if (str_contains($currentRouteName,$submenu->slug) and strpos($currentRouteName,$submenu->slug) === 0) {
  $activeClass = $active;
  }
  }
  }
  @endphp

  <li class="menu-item {{$activeClass}}" style="padding: 8px 3.5rem;">
    <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
      <span style="color: {{ isset($activeClass) ? '#33B6B9' : '#6f6b7d' }}; border-bottom: {{ isset($activeClass) ? '1px solid #33B6B9' : '' }};">{{ isset($submenu->name) ? __($submenu->name) : '' }}</span>
    </a>

    {{-- submenu --}}
    @if (isset($submenu->submenu))
    @include('layouts.sections.menu.submenu',['menu' => $submenu->submenu])
    @endif
  </li>
  @endforeach
  @endif
</ul>