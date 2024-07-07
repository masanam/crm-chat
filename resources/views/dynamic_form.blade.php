@extends('layouts/layoutMaster')

@section('title', 'Kanban - Apps')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/jkanban/jkanban.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('css/components/ticket-kanban.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor//libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor//libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor//libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor//libs/jkanban/jkanban.js')}}"></script>
<script src="{{asset('assets/vendor//libs/quill/katex.js')}}"></script>
<script src="{{asset('assets/vendor//libs/quill/quill.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/form-builder.min.js') }}"></script>
<script src="{{ asset('assets/js/form-render.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const fbTemplate = document.getElementById('build-wrap');
        $(fbTemplate).formBuilder();
    });
</script>

@endsection

@section('content')

<div class="row">
    <div class="">
        <div class="card overflow-hidden">
            <div class="card-body">

                <div class="row g-0">
                    <label for="name">Form Name</label>
                    <input type="text" id="name" name="name" class="form-control">

                    <div id="build-wrap"></div>

                </div>
            </div>
        </div>

    </div>
</div>


@endsection