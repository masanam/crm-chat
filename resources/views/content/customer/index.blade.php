@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
    <script src="{{ asset('assets/js/customer.js') }}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer overflow-hidden">
                <x-page-title title="Customers" placeholderSearchText="Search leads"></x-page-title>
                <div class="row g-0">
                    @include('content/customer/components/customer-chat-view')
                    {{-- @include('content/customer/components/customer-kanban-view') --}}
                    {{-- @include('content/customer/components/customer-list-view') --}}
                </div>
            </div>
        </div>
    </div>
@endsection
