@extends('layouts/layoutMaster')

@section('title', 'Lead Management')


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
  'value' => 'select',
];
$gender = (object) [
  'label' => 'Male',
  'value' => 'male',
];
$gender2 = (object) [
  'label' => 'Female',
  'value' => 'female',
];
$gender3 = (object) [
  'label' => 'All',
  'value' => 'all',
];
$genders = [$default, $gender, $gender2, $gender3];

$default2 = (object) [
  'label' => 'Search for job',
  'value' => '',
];
$jobs = [$default2]
@endphp

@section('content')
<section class="container-lead-search">
  <div class="container-filter">
    <div class="card card-search">
        <span style="font-weight: 600; font-size: 20px; color: #1F2124;">What are you looking for?</span>
        <x-input-floating
          label="Search people"
          id="search_people"
          name="search_people"
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
            <button style="outline: none; border: none; background: transparent;">
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
                    <input type="checkbox" id="age" name="age" value="age1">
                    <label for="age" style="margin-left: 12px;"> Above - 21 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age" name="age" value="age2">
                    <label for="age" style="margin-left: 12px;"> 21 - 29 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age" name="age" value="age3">
                    <label for="age" style="margin-left: 12px;"> 30 - 39 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age" name="age" value="age4">
                    <label for="age" style="margin-left: 12px;"> 40 - 49 years old</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="age" name="age" value="age5">
                    <label for="age" style="margin-left: 12px;"> 50 years old - over</label><br>
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
                    <input type="checkbox" id="income_level" name="income_level" value="type_a">
                    <label for="income_level" style="margin-left: 12px;"> Type A *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level" name="income_level" value="type_b">
                    <label for="income_level" style="margin-left: 12px;"> Type B *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level" name="income_level" value="type_c">
                    <label for="income_level" style="margin-left: 12px;"> Type C *</label><br>
                </div>
                <div class="mt-2">
                    <input type="checkbox" id="income_level" name="income_level" value="uncategorized">
                    <label for="income_level" style="margin-left: 12px;"> Uncategorized *</label><br>
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
                    id="gender"
                    name="gender"
                    type="select"
                    :options="$jobs"
                >
                </x-input-floating>
            </div>
        </div>
    </div>
    <button id="btn-filter-save" class="btn btn-primary">Save</button>
  </div>
  <div id="card-empty-search" class="card container-table-search align-items-center justify-content-center">
    <img src="{{ asset('assets/svg/icons/icon-lead-search.svg') }}" alt="lead-search" width="150">
    <div class="d-flex flex-column align-items-center gap-1" style="text-align: center; margin-top: 4rem;">
        <h4 style="font-size: 18px; font-weight: 700; color: #1F2124;">Find an account you looking for</h4>
        <h5 style="font-size: 16px; color: #1F2124;">Pasima lets you identify leads aligned with your ideal customer profile. Add filters to quickly surface qualified leads and proceed to find their contact information.</h5>
    </div>
  </div>
  
  <div id="table-lead-search" style="display: none; grid-column: span 2 / span 2;">
    <x-table
    title="5 match your filters"
    buttonHeaderName="Save bulk contact"
    buttonHeaderTarget="list"
    :headers="$headers"
    isSelectedTable="{{ true }}"
    isUsingTableResponsive="{{ true }}"
    isDisableButtonHeader="{{ true }}"
    isUsingHeaderAction="{{ false }}"
  >
    @foreach($teams as $key => $value)
    <tr class="{{ $key % 2 === 0 ? 'odd' : 'even' }}">
      <td class="control" style="display: none;" tabindex="0"></td>
      <td class="dt-checkboxes-cell"><input type="checkbox" class="dt-checkboxes form-check-input"></td>
      <td>
        <div class="d-flex justify-content-start align-items-center user-name">
          <div class="avatar-wrapper">
            <div class="avatar me-2"><span class="avatar-initial rounded-circle bg-label-info">{{ Helper::getInitial($value->lead_info) }}</span></div>
          </div>
          <div class="d-flex flex-column">
            <span class="emp_name text-truncate" style="color: #101828;">{{ $value->lead_info }}</span>
            <span class="emp_name text-truncate">{{ $value->position }}</span>
          </div>
        </div>
      </td>
      <td>{{ $value->wa_number }}</td>
      <td>{{ $value->location }}</td>
      <td>
        <button
          class="btn-add-list"
          data-bs-toggle="modal"
          data-bs-target="#list"
        >
          <i class="ti ti-plus"></i>
          Add to list
        </button>
      </td>
    </tr>
    @endforeach
  </x-table>
  </div>
</section>

{{-- modal add/select list --}}
<x-modal title="Add to list" name="list" isUsingBtnFooter="{{ false }}">
  <div class="d-flex flex-column gap-3 modal-add-contact">
      <div class="d-flex flex-column gap-2 border-bottom">
          <div class="">
              <span style="position: absolute; margin-top: 8px; margin-left: 12px;" id="basic-addon-search31"><i class="ti ti-search"></i></span>
              <input style="padding: 0.422rem 2.2rem; border-radius: 20px;" type="text" class="form-control" placeholder="Search team members" aria-label="Search team members" aria-describedby="basic-addon-search31" />
            </div>
          <div class="d-flex gap-2 align-items-center">
              <x-button-add-contact
                target="#add-list"
                name="Create New List"
                icon="assets/svg/icons/icon-add-circle-outline.svg"
              ></x-button-add-contact>
          </div>
      </div>
      <div class="d-flex flex-column gap-1">
        <h6 style="color: #1F2124;">Name of list 1</h6>
        <h6 style="color: #1F2124;">Name of list 2</h6>
        <h6 style="color: #1F2124;">Name of list 3</h6>
      </div>
  </div>
</x-modal>

<x-modal
  title="Create new list"
  name="add-list"
  isUsingBtnFooter="{{ false }}"
  buttonSubmitClass=""
  modalClass=""
  buttonWrapperSubmitClass="d-flex justify-content-end align-items-center w-100"
>
<div class="d-flex flex-column gap-3">
  <div class="d-flex flex-column gap-4 w-100">
      <x-input-floating
          label="List Name"
          id="list_name"
          name="list_name"
          placeholder="Create list name"
      >
      </x-input-floating>
  </div>
  <div class="d-flex justify-content-end w-100 mt-2">
      <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
  </div>
</div>
</x-modal>

@endsection