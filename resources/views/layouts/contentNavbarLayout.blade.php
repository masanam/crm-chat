@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/commonMaster' )

@php
/* Display elements */
$contentNavbar = ($contentNavbar ?? true);
$containerNav = ($containerNav ?? 'container-xxl');
$isNavbar = ($isNavbar ?? true);
$isMenu = ($isMenu ?? true);
$isFlex = ($isFlex ?? false);
$isFooter = ($isFooter ?? true);
$customizerHidden = ($customizerHidden ?? '');

/* HTML Classes */
$navbarDetached = 'navbar-detached';
$menuFixed = (isset($configData['menuFixed']) ? $configData['menuFixed'] : '');
if(isset($navbarType)) {
$configData['navbarType'] = $navbarType;
}
$navbarType = (isset($configData['navbarType']) ? $configData['navbarType'] : '');
$footerFixed = (isset($configData['footerFixed']) ? $configData['footerFixed'] : '');
$menuCollapsed = (isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '');

/* Content classes */
$container = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';

$tabs = [];
$tabItems = ['Profile', 'Team', 'Members', 'Billing', 'Purchase', 'Channels'];

foreach ($tabItems as $item) {
$tabs[] = (object) [
'title' => $item,
'key' => strtolower($item)
];
}

$currentRouteName = Route::currentRouteName();

$user = Auth()->user();
$profile = \App\Models\Profile::with('dealer')->where('id', $user->profile_id)->first();
@endphp

@section('layoutContent')
<div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
  <div class="layout-container">

    @if ($isMenu)
    @include('layouts/sections/menu/verticalMenu')
    @endif


    <!-- Layout page -->
    <div class="layout-page">
      <header
        @class([
          'd-flex gap-5 align-items-center',
          'justify-content-end' => Route::currentRouteName() != 'customers.show',
          'justify-content-between' => Route::currentRouteName() == 'customers.show',
          'justify-content-between'=> $currentRouteName == 'settings'
        ])
        style="background: #EEF8F9; padding: 1rem 2.5rem;"
      >
        @if (Route::currentRouteName() == 'customers.show')
          <button class="btn d-flex gap-2 fw-bold text-dark" onclick="window.history.back()">
            <i class="ti ti-arrow-left text-dark"></i>
            Back
          </button>
        @endif
        @if ($currentRouteName == 'settings')
        <nav class="nav-parent">
          <ul class="nav nav-tabs tabs-crm" id="chats-tabs" role="tablist" style="background: transparent">
            @foreach($tabs as $key => $value)
                <li class="nav-item" role="presentation" style="background-color: transparent">
                    <button
                      class="nav-link {{ $key === 0 ? 'active' : '' }}"
                      style="background: transparent"
                      role="tab"
                      data-bs-toggle="tab"
                      data-bs-target="#{{ $value->key }}"
                      aria-controls="{{ $value->key }}"
                      aria-selected="true"
                    >
                      {{ $value->title }}
                    </button>
                </li>
            @endforeach
          </ul>
        @endif
        </nav>

        {{-- <img class="text-dark" src="{{asset('assets/svg/icons/info-dark.svg')}}" alt="info">
        <span class="text-dark" style="font-size: 16px; font-weight: 700;">Get started now! <a href="#" style="color: #4480FF; text-decoration-line: underline;">Contact support</a></span> --}}
        <div class="d-flex gap-3 align-items-center">
          <div class="d-flex flex-row gap-3">
            <a class="btn" style="padding: 0.5rem 0.5rem;" href="{{ url('settings') }}">
              <img src="{{asset('assets/svg/icons/icon-setting.svg')}}" alt="icon setting">
            </a>
          </div>
          <button class="btn d-flex flex-row dropdown-account dropbtn" aria-haspopup="true" aria-expanded="false" role="button">
            <div class="avatar avatar-online me-2">
              <img alt="Avatar" class="rounded-circle shadow" src="{{ asset('assets/img/avatars/7.png') }}">
            </div>
            <div class="d-flex flex-column align-items-start gap-1" style="width: 80%;">
              <span class="fw-bold text-dark" style="font-size: 14px">{{ $profile->first_name }} {{ $profile->last_name }}</span>
              <span style="font-size: 14px; color: #475467;">{{ $profile->dealer->name }}</span>
            </div>
            <div class="dropdown-account-content" role="menu">
              <div class="d-flex gap-2 align-items-center" style="padding: 14px 18px;">
                <div class="avatar avatar-online">
                  <img alt="Avatar" class="rounded-circle shadow" src="{{ asset('assets/img/avatars/7.png') }}">
                </div>
                <div class="d-flex flex-column align-items-start gap-1">
                  <span class="fw-bold text-dark" style="font-size: 14px">{{ $profile->first_name }} {{ $profile->last_name }}</span>
                  <span style="font-size: 14px; color: #616A75;">{{ $profile->dealer->name }}</span>
                </div>
              </div>
              <a href="#" role="menuitem" class="d-flex align-items-center menu-account" style="color: #616A75;">
                Account
              </a>
              <a href="{{ route('logout') }}" role="menuitem" class="d-flex align-items-center gap-2 w-full justify-content-between menu-logout" style="color: #616A75;">
                Logout
                <img alt="logout" src="{{ asset('assets/svg/icons/icon-logout.svg') }}">
              </a>
            </div>
          </button>
        </div>
      </header>

      {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}
      {{-- <x-banner /> --}}

      <!-- BEGIN: Navbar-->
      {{-- @if ($isNavbar)
      @include('layouts/sections/navbar/navbar')
      @endif --}}
      <!-- END: Navbar-->


      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
        @if ($isFlex)
        <div class="{{$container}} d-flex align-items-stretch flex-grow-1 p-0">
          @else
          <div class="overflow-x-hidden">
            @endif

            @yield('content')

          </div>
          <!-- / Content -->

          <!-- Footer -->
          @if ($isFooter)
          @include('layouts/sections/footer/footer')
          @endif
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    @if ($isMenu)
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
  @endsection