@extends('layouts/layoutMaster')

@section('title', 'Lead Management')

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/dashboard-crm.css') }}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/app-logistics-dashboard.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>

@endsection

@section('page-script')
<script src="{{ asset('assets/js/dashboard-crm.js') }}"></script>
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="{{ asset('assets/js/components/card-plan.js') }}"></script>
<script src="{{ asset('assets/js/app-logistics-dashboard.js')}}"></script>
@endsection

@php
$headerItem = (object) [
'name' => 'Name',
'width' => '200px'
];

$headerItem2 = (object) [
'name' => 'Members',
'width' => '100px'
];

$headerItem3 = (object) [
'name' => 'Function',
'width' => '100px'
];

$headers = [$headerItem, $headerItem2, $headerItem3];

$dummy = (object) [
'name' => 'Ronica Hasted',
'members' => '30 Members',
'function' => 'Sales'
];

$dummy1 = (object) [
'name' => 'Edwina Ebsworth',
'members' => '30 Members',
'function' => 'Operations'
];

$dummyData = [$dummy, $dummy1];

$headerMemberItem = (object) [
'name' => 'Name',
'width' => '200px'
];

$headerMemberItem2 = (object) [
'name' => 'Status',
'width' => '100px'
];

$headerMemberItem3 = (object) [
'name' => 'Role',
'width' => '100px'
];

$headerMemberItem4 = (object) [
'name' => 'Email',
'width' => '100px'
];

$headerMemberItem5 = (object) [
'name' => 'Teams',
'width' => '100px'
];

$headersMember = [$headerMemberItem, $headerMemberItem2, $headerMemberItem3, $headerMemberItem4, $headerMemberItem5];

$dummyMember = (object) [
'name' => 'Ronica Hasted',
'status' => true,
'role' => 'Sales Excutive',
'email' => 'ron@gmail.com',
'team' => 'Sales'
];

$dummyMember1 = (object) [
'name' => 'Ron Hasted',
'status' => false,
'role' => 'Sales Excutive',
'email' => 'ron2@gmail.com',
'team' => 'Sales'
];

$dummyDataMembers = [$dummyMember, $dummyMember1];

$emailDummy = (object) [
'label' => 'ron@gmail.com',
'value' => 'ron@gmail.com',
];

$emailDummy2 = (object) [
'label' => 'ciku@gmail.com',
'value' => 'ciku@gmail.com',
];

$emailsAddress = [$emailDummy, $emailDummy2];

$teamDummy = (object) [
'label' => 'Toyota Woodlands Alpha Team',
'value' => 'Toyota Woodlands Alpha Team',
];

$teamDummy2 = (object) [
'label' => 'BMW Team',
'value' => 'BMW Team',
];

$teams = [$teamDummy, $teamDummy2];

$statusDummy = (object) [
'label' => 'Active',
'value' => 'Active',
];

$statusDummy2 = (object) [
'label' => 'Inactive',
'value' => 'Inactive',
];

$listStatus = [$statusDummy, $statusDummy2];

$roleDummy = (object) [
'label' => 'Sales',
'value' => 'Sales',
];

$roleDummy2 = (object) [
'label' => 'Operation',
'value' => 'Operation',
];

$listRole = [$roleDummy, $roleDummy2];

$headerBillingItem = (object) [
'name' => 'Payment Methods',
'width' => '570px'
];

$headersBilling = [$headerBillingItem];

$dummyDataBilling = (object) [
'title' => 'Visa ending in 1234',
'subtitle' => 'Expiry 06/2024',
'img' => asset('assets/svg/icons/visa.svg')
];

$dummyDataBilling2 = (object) [
'title' => 'Mastercard ending in 4321',
'subtitle' => 'Expiry 06/2024',
'img' => asset('assets/svg/icons/master-card.svg')
];

$listDataBilling = [$dummyDataBilling, $dummyDataBilling2];

$dummyDataState = (object) [
'label' => 'Alaska',
'value' => 'Alaska',
];

$dummyDataState2 = (object) [
'label' => 'Hawaii',
'value' => 'Hawaii',
];

$listDataState = [$dummyDataState, $dummyDataState2];

$tabsChannels = [];
$tabItemsChannels = ['Account', 'QR Code', 'Template manager'];

foreach ($tabItemsChannels as $item) {
$tabsChannels[] = (object) [
'title' => $item,
'key' => str_replace(' ', '-', strtolower($item))
];
};

$codeSettings = [
'Quickly generate QR codes',
'Manage new conversation workflows with intelligent routing rules',
'Automate and customize reply messages',
'Maintain brand consistency and manage remote teams seamlessly'
];

$tabsBilling = [];
$tabItemsBilling = ['Payment Method', 'Usage'];

foreach ($tabItemsBilling as $item) {
$tabsBilling[] = (object) [
'title' => $item,
'key' => str_replace(' ', '-', strtolower($item))
];
};
@endphp

@section('content')
<section class="row dashboard-crm-content">
  <section id="tab-content-wrapper" class="tab-content d-flex">
    {{-- @include('content/dashboard/components/dashboard-tab-profile')
    @include('content/dashboard/components/dashboard-tab-team')
    @include('content/dashboard/components/dashboard-tab-members')
    @include('content/dashboard/components/dashboard-tab-billing')
    @include('content/dashboard/components/dashboard-tab-purchase')
    @include('content/dashboard/components/dashboard-tab-channel') --}}
    @include('content/dashboard/components/dashboard-user')
  </section>
</section>

{{-- modal create/edit new team --}}
@include('content/dashboard/components/dashboard-modal-create-edit-new-team')
{{-- modal create team members --}}
@include('content/dashboard/components/dashboard-modal-create-team-member')
{{-- modal edit team members --}}
@include('content/dashboard/components/dashboard-modal-edit-team-member')
{{-- modal add payment billing --}}
@include('content/dashboard/components/dashboard-modal-payment-billing')
{{-- modal checkout --}}
@include('content/dashboard/components/dashboard-modal-checkout')

@endsection