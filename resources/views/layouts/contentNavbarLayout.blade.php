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
@endphp

@section('layoutContent')
<div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
  <div class="layout-container">

    @if ($isMenu)
    @include('layouts/sections/menu/verticalMenu')
    @endif


    <!-- Layout page -->
    <div class="layout-page">
      <header @class(['d-flex gap-5 flex-row-reverse align-items-center', 'justify-content-end'=> $currentRouteName == 'dashboard-crm']) style="background: #EEF8F9; padding: 1rem 2.5rem;">
        {{-- <img class="text-dark" src="{{asset('assets/svg/icons/info-dark.svg')}}" alt="info">
        <span class="text-dark" style="font-size: 16px; font-weight: 700;">Get started now! <a href="#" style="color: #4480FF; text-decoration-line: underline;">Contact support</a></span> --}}
        {{-- @if ($currentRouteName == 'dashboard-crm')
        <nav class="nav-parent">
          <ul class="nav nav-tabs tabs-crm" id="chats-tabs" role="tablist">
            @foreach($tabs as $key => $value)
                <li class="nav-item" role="presentation" style="background-color: #F4FBFA">
                    <button
                      class="nav-link {{ $key === 0 ? 'active' : '' }}"
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
        @endif --}}
        </nav>
        <div class="d-flex gap-3 align-items-center">
          <div class="d-flex flex-row gap-3">
            <button class="btn" style="padding: 0.5rem 0.5rem;">
              <img src="{{asset('assets/svg/icons/icon-notification.svg')}}" alt="icon notification">
            </button>
            <button class="btn" style="padding: 0.5rem 0.5rem;">
              <img src="{{asset('assets/svg/icons/icon-setting.svg')}}" alt="icon setting">
            </button>
          </div>
          <div class="d-flex flex-row">
            <div class="avatar avatar-online me-2">
              <img alt="Avatar" class="rounded-circle shadow" src="{{ asset('assets/img/avatars/7.png') }}">
            </div>
            <div class="d-flex flex-column" style="width: 80%;">
              <span class="fw-bold text-dark" style="font-size: 14px">Randy Haris</span>
              <span style="font-size: 14px; color: #475467;">PT Jaya Makmur</span>
            </div>
          </div>
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