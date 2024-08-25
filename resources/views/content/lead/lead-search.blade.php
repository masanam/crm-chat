@extends('layouts/layoutMaster')

@section('title', 'Lead Generation')


@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/lead-generation.css') }}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/lead-search.js') }}"></script>
@endsection

@php
$headerItem = (object) [
  'name' => 'Leads Information',
  'width' => '300px',
  'is_sorting' => false
];
$headerItem2 = (object) [
  'name' => 'WhatsApp Number',
  'width' => '350px',
  'is_sorting' => false
];
$headerItem3 = (object) [
  'name' => 'Location',
  'width' => '100px',
  'is_sorting' => false
];
$headerItem4 = (object) [
  'name' => 'Actions',
  'width' => '150px',
  'is_sorting' => false
];
$headers = [$headerItem, $headerItem2, $headerItem3, $headerItem4];

$team1 = (object) [
  'lead_info' => 'Olive Rhye',
  'position' => 'CEO',
  'wa_number' => '+62 xxx-xxx-xxx',
  'location' => 'Jakarta, ID'
];
$team2 = (object) [
  'lead_info' => 'Olive Rhye',
  'position' => 'CEO',
  'wa_number' => '+62 xxx-xxx-xxx',
  'location' => 'Jakarta, ID'
];
$team3 = (object) [
  'lead_info' => 'Olive Rhye',
  'position' => 'CEO',
  'wa_number' => '+62 xxx-xxx-xxx',
  'location' => 'Jakarta, ID'
];
$team4 = (object) [
  'lead_info' => 'Olive Rhye',
  'position' => 'CEO',
  'wa_number' => '+62 xxx-xxx-xxx',
  'location' => 'Jakarta, ID'
];
$team5 = (object) [
  'lead_info' => 'Olive Rhye',
  'position' => 'CEO',
  'wa_number' => '+62 xxx-xxx-xxx',
  'location' => 'Jakarta, ID'
];
$teams = [$team1, $team2, $team3, $team4, $team5];

$default = (object) [
  'label' => '- Select -',
  'value' => '',
];
$gender = (object) [
  'label' => 'Male',
  'value' => 'Male',
];
$gender2 = (object) [
  'label' => 'Female',
  'value' => 'Female',
];
$gender3 = (object) [
  'label' => 'All',
  'value' => 'All',
];
$genders = [$default, $gender, $gender2, $gender3];

@endphp

@section('content')
<section class="container-lead-search">
  <form id="form-search">
  <div class="container-filter">
    <div class="card card-search">
        <span style="font-weight: 600; font-size: 20px; color: #1F2124;">What are you looking for?</span>
        <x-input-floating
          label="Search people"
          id="customer_name"
          name="customer_name"
          placeholder=""
        >
        </x-input-floating>
        <button class="btn-search">
          <i class="ti ti-search"></i>
        </button>
    </div>
    <div class="card card-filters">
        <div class="d-flex flex-row justify-content-between divide-b wrapper-filter">
            <span style="font-weight: 600; font-size: 20px; color: #1F2124;">Filters</span>
            <button type="reset" style="outline: none; border: none; background: transparent;">
                <span style="border-bottom: 1px solid #33B6B9; color: #33B6B9;">clear all</span>
            </button>
        </div>
        <div class="d-flex flex-column divide-b wrapper-filter">
            <div id="filter-age" class="d-flex flex-row justify-content-between align-items-center cursor-pointer">
                <div class="d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-age.svg') }}" alt="age">
                    <span style="color: #1F2124; font-weight: 600;">Age</span>
                </div>
                <i class="ti ti-chevron-right"></i>
            </div>
            <div id="content-filter-age" class="hide">
                <div class="mt-4">
                    <input type="checkbox" id="age1" name="age1" value="1-21">
                    <label for="age1" style="margin-left: 12px;"> Above - 21 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age2" name="age2" value="21-29">
                    <label for="age2" style="margin-left: 12px;"> 21 - 29 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age3" name="age3" value="30-39">
                    <label for="age3" style="margin-left: 12px;"> 30 - 39 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age4" name="age4" value="40-49">
                    <label for="age4" style="margin-left: 12px;"> 40 - 49 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age5" name="age5" value="50">
                    <label for="age5" style="margin-left: 12px;"> 50 years old - over</label><br>
                </div>
            </div>
        </div>
        <div id="filter-gender" class="d-flex flex-column divide-b wrapper-filter">
            <div class="d-flex flex-row justify-content-between align-items-center cursor-pointer">
                <div class="d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-gender.svg') }}" alt="gender">
                    <span style="color: #1F2124; font-weight: 600;">Gender</span>
                </div>
                <i class="ti ti-chevron-right"></i>
            </div>
            <div id="content-filter-gender" class="hide mt-3">
                <x-input-floating
                    label=""
                    placeholder="Please select gender"
                    id="gender"
                    name="gender"
                    type="select"
                    :options="$genders"
                >
                </x-input-floating>
            </div>
        </div>
        <div class="d-flex flex-column divide-b wrapper-filter">
            <div id="filter-location" class="d-flex flex-row justify-content-between align-items-center cursor-pointer">
                <div class="d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-corporate.svg') }}" alt="company">
                    <span style="color: #1F2124; font-weight: 600;">Location</span>
                </div>
                <i class="ti ti-chevron-right"></i>
            </div>
            <div id="content-filter-location" class="hide mt-3">
                <x-input-floating
                    label="Location"
                    id="location"
                    name="location"
                    placeholder="Search for a city , state, or country"
                >
                </x-input-floating>
            </div>
        </div>
        <div class="d-flex flex-column divide-b wrapper-filter">
            <div id="filter-income" class="d-flex flex-row justify-content-between align-items-center cursor-pointer">
                <div class="d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-dolar-outline.svg') }}" alt="dolar">
                    <span style="color: #1F2124; font-weight: 600;">Income level</span>
                </div>
                <i class="ti ti-chevron-right"></i>
            </div>
            <div id="content-filter-income" class="hide">
                <div class="mt-4">
                    <input type="checkbox" id="income_level1" name="income_level1" value="A">
                    <label for="income_level1" style="margin-left: 12px;"> Type A *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level2" name="income_level2" value="B">
                    <label for="income_level2" style="margin-left: 12px;"> Type B *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level3" name="income_level3" value="C">
                    <label for="income_level3" style="margin-left: 12px;"> Type C *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level4" name="income_level4" value="Uncategorized">
                    <label for="income_level4" style="margin-left: 12px;"> Uncategorized *</label><br>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column wrapper-filter">
            <div id="filter-job" class="d-flex flex-row justify-content-between align-items-center cursor-pointer">
                <div class="d-flex flex-row align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-job.svg') }}" alt="job">
                    <span style="color: #1F2124; font-weight: 600;">Job title</span>
                </div>
                <i class="ti ti-chevron-right"></i>
            </div>
            <div id="content-filter-job" class="hide mt-3">
                <x-input-floating
                    label=""
                    placeholder="Search for job"
                    id="job_title"
                    name="job_title"
                    type="select"
                    :options="$list_job"
                >
                </x-input-floating>
            </div>
        </div>
    </div>
    <button id="btn-filter-save" class="btn btn-primary" type="submit">Save</button>
  </div>
  </form>
  <div id="card-empty-search" class="card container-table-search align-items-center justify-content-center">
    <img src="{{ asset('assets/svg/icons/icon-lead-search.svg') }}" alt="lead-search" width="150">
    <div class="d-flex flex-column align-items-center gap-1" style="text-align: center; margin-top: 4rem;">
        <h4 style="font-size: 18px; font-weight: 700; color: #1F2124;">Find an account you looking for</h4>
        <h5 style="font-size: 16px; color: #1F2124;">Pasima lets you identify leads aligned with your ideal customer profile. Add filters to quickly surface qualified leads and proceed to find their contact information.</h5>
    </div>
  </div>
  
  <div id="table-lead-search" style="display: none; grid-column: span 2 / span 2;">
    <x-table
    title=""
    buttonHeaderName="Save bulk contact"
    buttonHeaderTarget="list"
    :headers="$headers"
    isSelectedTable="{{ true }}"
    isUsingTableResponsive="{{ true }}"
    isDisableButtonHeader="{{ true }}"
    isUsingHeaderAction="{{ false }}"
  >
  </x-table>
  </div>
</section>

{{-- modal add/select list --}}
<x-modal title="Add to list" name="list" isUsingBtnFooter="{{ false }}">
  <div class="d-flex flex-column gap-3 modal-add-contact">
      <div class="d-flex flex-column gap-2 border-bottom">
          <div class="">
              <span style="position: absolute; margin-top: 8px; margin-left: 12px;" id="basic-addon-search31"><i class="ti ti-search"></i></span>
              <input id="search-list-name" style="padding: 0.422rem 2.2rem; border-radius: 20px;" type="text" class="form-control" placeholder="Search team members" aria-label="Search team members" aria-describedby="basic-addon-search31" />
            </div>
          <div class="d-flex gap-2 align-items-center">
              <x-button-add-contact
                target="#add-list"
                name="Create New List"
                icon="assets/svg/icons/icon-add-circle-outline.svg"
              ></x-button-add-contact>
          </div>
      </div>
      <div id="lead-list-wrapper" class="d-flex flex-column gap-1">
      </div>
  </div>
</x-modal>

<x-modal
  title="Create new list"
  name="add-list"
  isUsingBtnFooter="{{ false }}"
  buttonSubmitClass=""
  modalClass=""
  isModalStack="{{ true }}"
  targetNameModalStack="list"
  buttonWrapperSubmitClass="d-flex justify-content-end align-items-center w-100"
>
<form id="form-create-list" class="d-flex flex-column gap-3">
  <div class="d-flex flex-column gap-4 w-100">
      <x-input-floating
        label="List Name"
        id="name"
        name="name"
        placeholder="Create list name"
      >
      </x-input-floating>
  </div>
  <div class="d-flex justify-content-end w-100 mt-2">
      <button id="btn-create-list" type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
</x-modal>

<x-modal title="Customers" name="detail-customer" wrapperModalClass="modal-right" modalClass="modal-lg" isUsingBtnFooter="{{ false }}" isUsingHeaderTitle="{{ false }}">
  <div class="gap-3 container-lead-search-detail">
      <div class="d-flex flex-column gap-3">
          <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center gap-3">
              <div class="flex-shrink-0 avatar" style="width: 110px; height: 110px;">
                <span class="avatar-initial rounded-circle text-dark fw-bolder fs-1">{{ Helper::getInitial('Olivia Ryhe') }}</span>
              </div>
              <div class="d-flex flex-column justify-content-between gap-3">
                <div class="d-flex flex-column">
                  <div class="d-flex align-items-center gap-2">
                    <span style="font-size: 24px;" class="text-dark fw-bold">Olivia Ryhe</span>
                    <img src="{{ asset('assets/svg/icons/icon-verify.svg') }}" alt="verify account">
                  </div>
                  <span class="text-dark fw-bold">Chief Executive Officer at Beauty</span>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="d-flex align-items-center gap-1">
                    <i class="ti ti-user"></i>
                    <span>Female,</span>
                  </div>
                  <div class="d-flex align-items-center gap-1">
                    <span>30 - 39 age group,</span>
                  </div>
                  <div class="d-flex align-items-center gap-1">
                    <img src="{{ asset('assets/svg/icons/icon-dolar-outline.svg') }}" alt="dolar">
                    <span>Type A</span>
                  </div>
                  <span>&#128900;</span>
                  <div class="d-flex align-items-center gap-1">
                    <span>Jakarta, ID</span>
                  </div>
                </div>
              </div>
            </div>
            <i class="ti ti-x" data-bs-dismiss="modal" data-bs-target="#detail-customer" style="cursor: pointer;"></i>
          </div>
          <div class="card-contact-info d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
              <span class="text-dark fw-bolder" style="font-size: 18px;">Contact Information</span>
              <button
                class="btn-add-list"
                data-bs-toggle="modal"
                data-bs-target="#list"
              >
                <i class="ti ti-plus"></i>
                Add to list
              </button>
            </div>
            <div class="contact-info-content">
              <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('assets/svg/icons/icon-whatsapp.svg') }}" alt="wa">
                <span class="text-dark">+62 xxx-xxx-xxx</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <i class="ti ti-world"></i>
                <span class="text-dark">www.company.co</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <i class="ti ti-mail"></i>
                <span class="text-dark">olivia@email.com</span>
              </div>
              <div class="d-flex align-items-center gap-2">
                <span>Social: </span>
                <img src="{{ asset('assets/svg/icons/icon-linkedin.svg') }}" alt="linkedin">
              </div>
            </div>
          </div>
      </div>
      <div class="">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#experience">Experience</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#signals">Signals</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active gap-3" id="experience" style="background: transparent;">
            <div class="d-flex gap-3 align-items-start">
              <div class="flex-shrink-0 avatar avatar-md">
                <span class="avatar-initial text-dark fw-bolder" style="border-radius: 12px; font-size: 14px;">{{ Helper::getInitial('Beauty') }}</span>
              </div>
              <div class="d-flex flex-column gap-1">
                <span class="text-dark fw-bold">Beauty</span>
                <span class="text-dark">Chief Executive Officer</span>
                <span>Current</span>
              </div>
            </div>
            <div class="d-flex gap-3 align-items-start">
              <div class="flex-shrink-0 avatar avatar-md">
                <span class="avatar-initial text-dark fw-bolder" style="border-radius: 12px; font-size: 14px;">{{ Helper::getInitial('Digi Asia') }}</span>
              </div>
              <div class="d-flex flex-column gap-1">
                <span class="text-dark fw-bold">Digi Asia</span>
                <span class="text-dark">Founder</span>
                <span>May 2020 - Aug 2024  | 4 years</span>
              </div>
            </div>
            <div class="d-flex gap-3 align-items-start">
              <div class="flex-shrink-0 avatar avatar-md">
                <span class="avatar-initial text-dark fw-bolder" style="border-radius: 12px; font-size: 14px;">{{ Helper::getInitial('Shopee') }}</span>
              </div>
              <div class="d-flex flex-column gap-1">
                <span class="text-dark fw-bold">Shopee</span>
                <span class="text-dark">VP of Sales</span>
                <span>Jun 2017 - May 2020  | 4 years</span>
              </div>
            </div>
          </div>
          <div class="tab-pane fade gap-3" id="signals"  style="background: transparent;">
            <div class="d-flex gap-4 align-items-center">
              <img src="{{ asset('assets/svg/icons/icon-notifications-outline-blue.svg') }}" alt="notif">
              <span>Olivia Rhye just got promoted to Chief Executive Officer</span>
            </div>
            <div class="d-flex gap-4 align-items-center">
              <img src="{{ asset('assets/svg/icons/icon-notifications-outline-blue.svg') }}" alt="notif">
              <span>Beauty received $1,000 in funding from investor XXX.</span>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-modal>

@endsection