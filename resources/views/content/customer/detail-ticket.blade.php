@extends('layouts/layoutMaster')

@section('title', 'Customers - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <!-- <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-editable/bootstrap-editable.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('css/components/app-chat.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/customer.css') }}" />
    <style>
        .app-chat .app-chat-history .chat-history-header { padding-right: 0; padding-left: 0; }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/components/app-chat.js') }}"></script> -->
@endsection

@section('page-script')
    <!-- <script src="{{ asset('assets/libs/bootstrap-editable/bootstrap-editable.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/customer.js') }}"></script>
    <script src="{{ asset('assets/js/customer-detail-email.js') }}"></script>
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ticket-created').text(moment("{{ date('Y-m-d H:i:s', strtotime($model->created_at)) }}").fromNow())
            $('#ticket-deadline').text(moment("{{ date('Y-m-d H:i:s', strtotime($model->deadline)) }}").fromNow())

            function postData(id, text, type, url) {
                let fd = new FormData();
                    fd.set('text', text);
                    fd.set('id', id);
                    fd.set('type', type);

                fetch(baseUrl + url, { method: 'post', body: fd, mode: 'cors' })
                    .then(r => r.text())
                    .then(text => {
                        console.log('Do something with returned response: %s', text)
                    })
            }

            $('.company-editable').each(function() {
                $(this).attr('contenteditable', 'true');
            });

            $('.company-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.task-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.lead-editable').on('blur', function() {
                const newValue = $(this).text();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.select-lead-editable').on('change', function() {
                const newValue = $(this).val();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $('.select-task-editable').on('change', function() {
                const newValue = $(this).val();

                postData($(this).data('id'), newValue, $(this).data('type'), $(this).data('url'));
            });

            $(document).ready(function() {
                const modalButton = $('#add-contact #add-channel');

                modalButton.click(function() {
                    alert(1)
                });
            });
        });
    </script>
    <script>
        socket = io('https://pasma-websocket-q13qeu2vg-elviskudo1s-projects.vercel.app/', {
            auth: {
                token: "{{ env('WS_AUTH_TOKEN') }}"
            }
        });

        socket.on("connect", () => {
            console.log("connected");
        });

        socket.on("disconnect", () => {
            console.log("disconnected");
        });

        socket.on('chat message', (msg) => {
            addMessage(msg);
        });

        function sendMessage() {
            const messageInput = document.getElementById('message');
            const message = {
                user: user,
                message: messageInput.value
            };

            socket.emit('chat message', message);
            $.post('/messages', message);

            messageInput.value = '';
        }

        function addMessage(message) {
            const messages = document.getElementById('messages');
            const messageElement = document.createElement('li');
            messageElement.textContent = `${message.user}: ${message.message}`;
            messages.appendChild(messageElement);
        }

        document.getElementById('send').addEventListener('click', sendMessage);
        document.getElementById('message').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        user = 'User' + Math.floor((Math.random() * 100) + 1);

        $.get('/messages').then(response => {
            response.data.forEach(addMessage);
        });
    </script>
@endsection

@php
[$stages, $alphabet, $quality, $status, $listChannels, $listTicketTypes, $listPrioritys, $listStatusProjects] = Helper::getConstants();
@endphp

@section('content')
    <div class="row">
        <div class="">
            <div class="app-chat customer-detail-email overflow-hidden">
                <div class="row">
                    <div class="d-flex row justify-content-between">
                        <div class="col-3">
                            <!-- Customer info -->
                            <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-customer-info" sidebarBodyClass="mt-2">
                                <x-client-ticket :taskId="$model->id"></x-client-ticket>
                            </x-sidebar-right-info-chat>
                            <!-- /Customer info -->
                        </div>

                        <div class="col-6 p2" style="padding: 0px 0px 0px 80px;">
                            <div class="col app-chat-history bg-body" id="">
                                <div class="chat-history-wrapper">
                                    <header>
                                        <div class="chat-history-header border-bottom bg-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex overflow-hidden align-items-center">
                                                    <button class="btn d-flex gap-2 fw-bold text-dark" onclick="window.history.back()">
                                                        <i class="ti ti-arrow-left text-dark"></i>
                                                    </button>
                                                    <span class="m-0 text-dark fw-bold" style="font-size: 22px">{{ $model->title }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 py-1 chat-history-header-tag px-2 py-2">
                                            <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                <i class="ti ti-user user-icon text-dark"></i>
                                                <div class="d-flex align-items-center gap-1">
                                                    @foreach($model->team->members as $member)
                                                    <small>{{ $member->profile->first_name }} {{ $member->profile->last_name }},</small>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <x-badge-priority type="{{ $model->priority }}"></x-badge-priority>
                                            <small>{{ $model->code }}</small>
                                        </div>
                                    </header>

                                    <!--
                                    ketika buat ticket, sekaligus buat group, dan semua orang yang di group member itu yang bisa saling chat di chat-history
                                    tambahkan add member dengan modal
                                    -->
                                    <!-- <div class="chat-history-body bg-white" style="height: calc(100vh - 18.5rem);">
                                        <ul class="list-unstyled chat-history">
                                            No chats here
                                        </ul>
                                    </div> -->
                                            <!-- Chats -->
        <ul class="list-unstyled chat-contact-list" id="chat-list">
          <li class="chat-contact-list-item chat-list-item-0 d-none">
            <h6 class="text-muted mb-0">No Chats Found</h6>
          </li>
          <li class="chat-contact-list-item">
            <a class="d-flex align-items-center">
              <div class="flex-shrink-0 avatar avatar-online">
                <img src="{{asset('assets/img/avatars/13.png')}}" alt="Avatar" class="rounded-circle">
              </div>
              <div class="chat-contact-info flex-grow-1 ms-2">
                <h6 class="chat-contact-name text-truncate m-0">Waldemar Mannering</h6>
                <p class="chat-contact-status text-muted text-truncate mb-0">Refer friends. Get rewards.</p>
              </div>
              <small class="text-muted mb-auto">5 Minutes</small>
            </a>
          </li>
          <li class="chat-contact-list-item active">
            <a class="d-flex align-items-center">
              <div class="flex-shrink-0 avatar avatar-offline">
                <img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle">
              </div>
              <div class="chat-contact-info flex-grow-1 ms-2">
                <h6 class="chat-contact-name text-truncate m-0">Felecia Rower</h6>
                <p class="chat-contact-status text-muted text-truncate mb-0">I will purchase it for sure. 👍</p>
              </div>
              <small class="text-muted mb-auto">30 Minutes</small>
            </a>
          </li>
          <li class="chat-contact-list-item">
            <a class="d-flex align-items-center">
              <div class="flex-shrink-0 avatar avatar-busy">
                <span class="avatar-initial rounded-circle bg-label-success">CM</span>
              </div>
              <div class="chat-contact-info flex-grow-1 ms-2">
                <h6 class="chat-contact-name text-truncate m-0">Calvin Moore</h6>
                <p class="chat-contact-status text-muted text-truncate mb-0">If it takes long you can mail inbox user</p>
              </div>
              <small class="text-muted mb-auto">1 Day</small>
            </a>
          </li>
        </ul>
        <!-- Contacts -->

                                    {{-- <ul id="messages" class="mb-4"></ul>
                                    <div class="flex">
                                        <input type="text" id="message" class="border p-2 flex-grow" placeholder="Type your message">
                                        <button id="send" class="bg-blue-500 text-white p-2 ml-2">Send</button>
                                    </div> --}}

                                    <!-- Chat message form -->
                                    <div class="chat-history-footer">
                                        <form class="form-send-message d-flex flex-column justify-content-between h-100" action="" method="POST" enctype="multipart/form-data">
                                            <input class=" form-control message-input border-0 me-3 shadow-none bg-transparent" placeholder="Write message">
                                            <div class="message-actions d-flex align-items-center justify-content-between ps-2 pe-3">
                                                <div class="d-flex align-items-center">
                                                    <label for="attach-doc" class="form-label mb-0">
                                                        <img src="{{asset('assets/svg/icons/note_alt.svg')}}" alt="info" width="24">
                                                        <input type="file" id="attach-doc" hidden>
                                                    </label>
                                                </div>
                                                <button class="message-btn d-flex send-msg-btn rounded-circle" type="submit">
                                                    <img src="{{asset('assets/svg/icons/send.svg')}}" alt="info" width="24">
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <!-- Client info -->
                            <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show sidebar-client-info" sidebarBodyClass="mt-2">
                                <x-ticket-progress :taskId="$model->id"></x-ticket-progress>
                            </x-sidebar-right-info-chat>
                            <!-- Client info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-assignee" aria-hidden="true">
        <form method="post" action="{{ route('tickets.add-assignee') }}">
            @csrf
            <input type="hidden" name="client_id" value="{{ $model->client_id }}">
            <input type="hidden" name="task_id" value="{{ $model->id }}">
            <div class="modal-dialog model-md" role="document">
                <div class="modal-content">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center py-3 px-4">
                            <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel2">Add Assignee</h5>
                        </div>
                    </div>

                    <div class="modal-body px-4 py-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="mb-3 gap-4">
                                <label class="form-label" for="created_by">First Name</label>
                                <select type="text" name="created_by" id="created_by" class="select2 form-select form-control">
                                    @foreach($profiles as $profile)
                                    <option value="{{ $profile->id }}">{{ $profile->first_name }} {{ $profile->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                        <button type="button" data-bs-dismiss="modal" class="btn" style="background: #667085; color: #FFF;">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <x-modal title="Add Contact" modalClass="modal-md" url="{{ route('customers.add-contact') }}" isPost="true" submitText="Save" name="add-contact">
        <div class="d-flex flex-column gap-3">
            <input type="hidden" name="client_id" value="{{ $model->client_id }}">
            <input type="hidden" name="task_id" value="{{ $model->id }}">
            <div class="d-flex flex-row mb-3 gap-4">
                <div class="mb-3">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="job_title">Job Title</label>
                <select name="job_title" id="job_title" class="form-select form-control">
                    <option value="Sales Executive">Sales Executive</option>
                    <option value="Sales Representative">Sales Representative</option>
                    <option value="Senior Sales">Senior Sales</option>
                    <option value="Branch Manager">Branch Manager</option>
                </select>
            </div>
            <div id="more-contact">
                <div class="d-flex flex-row mb-3 gap-4">
                    <div class="mb-3">
                        <label class="form-label" for="whatsapp">Whatsapp</label>
                        <select name="whatsapp" id="whatsapp" class="form-select form-control">
                            <option value="whatsapp" selected>Whatsapp</option>
                            <!-- <option value="email">Email</option> -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="whatsapp_contact">Contact</label>
                        <input type="text" name="whatsapp_contact" id="whatsapp_contact" class="form-control" placeholder="Enter Phone Number" />
                    </div>
                </div>
                <div class="d-flex flex-row mb-3 gap-4">
                    <div class="mb-3">
                        <label class="form-label" for="email">email</label>
                        <select name="email" id="email" class="form-select form-control">
                            <option value="email" selected>Email</option>
                            <!-- <option value="email">Email</option> -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email_contact">Contact</label>
                        <input type="text" name="email_contact" id="email_contact" class="form-control" placeholder="Enter Email" />
                    </div>
                </div>
            </div>
            <!-- <div class="mb-3">
                <a href="javascript:;" class="btn-link" id="#add-channel">
                    + Add more channels
                </a>
            </div> -->
        </div>
    </x-modal>
@endsection