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

@section('content')
    <div class="card">
        <div class="card-body">
            <label for="name">{{__('Name')}}</label>
            <input type="text" id="name" name="name" class="form-control" />
            <div id="fb-editor"></div>
        </div>
    </div>
@endsection
@section('page-script')
<script src="{{ asset('assets/js/form-builder.min.js') }}"></script>
<script src="{{ asset('assets/js/form-render.min.js') }}"></script>
    <script>
        var fbEditor = document.getElementById('fb-editor');
        var formBuilder = $(fbEditor).formBuilder({
            onSave: function(evt, formData) {
                saveForm(formData);
            },
        });

        $(function() {
            $.ajax({
                type: 'get',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                url: '{{ URL('get-form-builder-edit') }}',
                data: {
                    'id': '{{ $id }}'
                },
                success: function(data) {
                    $("#name").val(data.name);
                    formBuilder.actions.setData(data.content);
                }
            });
        });

        function saveForm(form) {
            $.ajax({
                type: 'post',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                url: '{{ URL('update-form-builder') }}',
                data: {
                    'form': form,
                    'name': $("#name").val(),
                    'id': {{ $id }},
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = "/form-builder";
                }
            });
        }
    </script>
@endsection
