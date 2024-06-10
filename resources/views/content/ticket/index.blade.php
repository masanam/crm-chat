@extends('layouts/layoutMaster')

@section('title', 'Tickets - App')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
<link rel="stylesheet" href="{{ asset('css/kanban.css') }}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/group.css') }}" />
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" /> -->
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
{!! $kanban->scripts() !!}
@endsection

@section('page-script')
<!-- <script src="{{ asset('assets/js/components/chat-history.js') }}"></script> -->
<script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
<script src="{{ asset('assets/js/group.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="">
        <div class="overflow-hidden">
            <div class="row g-0" id="tickets">
                <div class="kanban-board"></div>
            </div>
        </div>
    </div>
</div>
@endsection