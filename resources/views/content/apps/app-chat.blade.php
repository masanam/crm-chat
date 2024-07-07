@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
@endsection

@section('content')
    <input type="hidden" id="USERID" value="{{$userId}}">
    <div class="row">
        <div class="col-md-8">
            <div class="app-chat card overflow-hidden">
                <div class="row g-0">

                    <!-- Chat & Contacts -->
                    <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                        id="app-chat-contacts">
                        <div class="sidebar-header">
                            <div class="d-flex align-items-center me-3 me-lg-0">

                                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                                    <span class="input-group-text" id="basic-addon-search31"><i
                                            class="ti ti-search"></i></span>
                                    <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                        aria-label="Search..." aria-describedby="basic-addon-search31">
                                </div>
                            </div>
                            <i class="ti ti-x cursor-pointer d-lg-none d-block position-absolute mt-2 me-1 top-0 end-0"
                                data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                        </div>
                        <hr class="container-m-nx m-0">
                        <div class="sidebar-body">

                            {{-- <div class="chat-contact-list-item-title">
                                <h5 class="text-primary mb-0 px-4 pt-3 pb-2">Chats</h5>
                            </div> --}}
                            <!-- Nav tabs -->
                            <div class="container">
                                <ul class="nav nav-tabs" id="chats-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="open-tab" data-bs-toggle="tab"
                                            data-bs-target="#open" type="button" role="tab" aria-controls="open"
                                            aria-selected="true">Open</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="closed-tab" data-bs-toggle="tab"
                                            data-bs-target="#closed" type="button" role="tab" aria-controls="closed"
                                            aria-selected="false">Closed</button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content p-0">
                                <div class="tab-pane active" id="open" role="tabpanel" aria-labelledby="open-tab">
                                    <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                        <li class="chat-contact-list-item chat-list-item-0 d-none ">
                                            <h6 class="text-muted mb-0">No Chats Found</h6>
                                        </li>
                                        @foreach($chats as $item)
                                        @php
                                        $initials = '';
                                        $phoneNumber = $item->from;
                                        $clientName = $item->from;
                                        if($item->lead) {
                                          $initials = implode('', array_map(function($n) {
                                              return $n[0];
                                          }, explode(' ', $item->lead->client_name)));
                                          $phoneNumber = $item->lead->phone_number;
                                          $clientName = $item->lead->client_name;
                                        }
                                        @endphp
                                        <li class="chat-contact-list-item" data-wa="{{$phoneNumber}}" data-name="{{$clientName}}">
                                            <a class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar avatar-offline">
                                                  @if($initials)
                                                    <span class="avatar-initial rounded-circle bg-label-success">{{$initials}}</span>
                                                  @else
                                                    <span onclick="redirectTo('{{url('/')}}/lead/create?phone={{$phoneNumber}}')" class="avatar-initial rounded-circle bg-label-success">{{$initials}}</span>
                                                  @endif
                                                </div>
                                                <div class="chat-contact-info flex-grow-1 ms-2">
                                                    <h6 class="chat-contact-name text-truncate m-0">{{$clientName}}</h6>
                                                    {{-- <p class="chat-contact-status text-muted text-truncate mb-0">I will
                                                        purchase it
                                                        for sure. 👍</p> --}}
                                                </div>
                                                {{-- <small class="text-muted mb-auto">30 Minutes</small> --}}
                                            </a>
                                            @if(!$initials)
                                            <div class="dropdown d-flex align-self-center">
                                                <button class="btn p-0" type="button" id="chat-header-actions"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="chat-header-actions">
                                                    <a class="dropdown-item" href="{{url('/')}}/lead/create?phone={{$phoneNumber}}">Add to Lead</a>
                                                    <!-- <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a> -->
                                                </div>
                                            </div>
                                            @endif
                                        </li>
                                        @endforeach
                                        @foreach($leadNotChats as $item)
                                        @php
                                        $initials = implode('', array_map(function($n) {
                                            return $n[0];
                                        }, explode(' ', $item->client_name)));
                                        @endphp
                                        <li class="chat-contact-list-item" data-wa="{{$item->phone_number}}" data-name="{{$item->client_name}}">
                                            <a class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar avatar-offline">
                                                    <span class="avatar-initial rounded-circle bg-label-success">{{$initials}}</span>
                                                </div>
                                                <div class="chat-contact-info flex-grow-1 ms-2">
                                                    <h6 class="chat-contact-name text-truncate m-0">{{$item->client_name}}</h6>
                                                    {{-- <p class="chat-contact-status text-muted text-truncate mb-0">I will
                                                        purchase it
                                                        for sure. 👍</p> --}}
                                                </div>
                                                {{-- <small class="text-muted mb-auto">30 Minutes</small> --}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                    <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                        <li class="chat-contact-list-item chat-list-item-0">
                                            <h6 class="text-muted mb-0">No Chats Found</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Contacts -->
                        </div>
                    </div>
                    <!-- /Chat contacts -->

                    <!-- Chat History -->
                    <div class="col app-chat-history bg-body">
                        <div class="chat-history-wrapper">
                            <div class="chat-history-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex overflow-hidden align-items-center">
                                        <i class="ti ti-menu-2 ti-sm cursor-pointer d-lg-none d-block me-2"
                                            data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                        <div class="flex-shrink-0 avatar">
                                            <span class="avatar-initial rounded-circle bg-label-success"
                                                data-bs-toggle="sidebar" data-overlay
                                                data-target="#app-chat-sidebar-right">AR</span>
                                        </div>
                                        <div class="chat-contact-info flex-grow-1 ms-2">
                                            <h6 class="m-0"></h6>
                                            <span class="badge badge-sm bg-success mt-1">Lead</span>
                                            {{-- <small class="user-status text-muted">NextJS developer</small> --}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="d-flex align-items-center">
                                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Admin"
                                                    class="avatar avatar-sm pull-up">
                                                    {{-- <img class="rounded-circle"
                                                        src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"> --}}
                                                        <div class="avatar"><span class="avatar-initial rounded-circle bg-label-primary">A</span></div>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Dandi"
                                                    class="avatar avatar-sm pull-up">
                                                    <div class="avatar"><span class="avatar-initial rounded-circle bg-label-primary">D</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="dropdown d-flex align-self-center">
                                            <button class="btn p-0" type="button" id="chat-header-actions"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="chat-header-actions">
                                                <a class="dropdown-item" href="javascript:void(0);">Add Participant</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-history-body bg-body">
                                <ul class="list-unstyled chat-history">
                                </ul>
                            </div>
                            <!-- Chat message form -->
                            <div class="chat-history-footer">
                                <form class="form-send-message d-flex justify-content-between align-items-center" style="padding: 8px; background: #fff; margin-top: 12px; border-radius: 8px;" method="POST" ">
                                    <input class="form-control message-input border-0 me-3 shadow-none"
                                        placeholder="Type your message here">
                                    <div class="message-actions d-flex align-items-center">
                                        <label for="attach-doc" class="form-label mb-0">
                                            <i class="ti ti-photo ti-sm cursor-pointer mx-3"></i>
                                            <input type="file" id="attach-doc" hidden>
                                        </label>
                                        <button class="btn btn-primary d-flex send-msg-btn" type="submit">
                                            <i class="ti ti-send me-md-1 me-0"></i>
                                            <span class="align-middle d-md-inline-block d-none">Send</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Chat History -->

                    <!-- Sidebar Right -->
                    <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                        <div
                            class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-4 pt-5">
                            <div class="avatar avatar-xl ">
                                <span class="avatar-initial rounded-circle bg-label-success">AR</span>
                            </div>
                            <h6 class="mt-2 mb-0">Aditya Rahardi</h6>
                            {{-- <span>NextJS Developer</span> --}}
                            <i class="ti ti-x ti-sm cursor-pointer close-sidebar d-block" data-bs-toggle="sidebar"
                                data-overlay data-target="#app-chat-sidebar-right"></i>
                        </div>
                        <div class="sidebar-body px-4 pb-4">
                            <div class="my-4">
                                <small class="text-muted text-uppercase">About</small>
                                <p class="mb-0 mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In
                                    consectetur explicabo sed, voluptatem consequatur perspiciatis dolor ratione quisquam
                                    aperiam cupiditate velit quo hic consequuntur beatae aliquid minus quam fugit
                                    aspernatur?</p>
                            </div>
                            <div class="my-4">
                                <small class="text-muted text-uppercase">Mobil</small>
                                <p class="mb-0 mt-3">BMW</p>
                            </div>
                            <div class="my-4">
                                <small class="text-muted text-uppercase">Budget</small>
                                <p class="mb-0 mt-3">~150 Juta</p>
                            </div>
                            <div class="my-4">
                                <small class="text-muted text-uppercase">Handover Notes</small>
                                <p class="mb-0 mt-3">-</p>
                            </div>

                            <div class="my-4">
                                <small class="text-muted text-uppercase">Label</small>
                                <br>

                                <span class="badge bg-primary mt-3 mb-0">On Prgress</span>
                            </div>
                            <div class="my-4">
                                <small class="text-muted text-uppercase">Personal Information</small>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li class="d-flex align-items-center">
                                        <i class='ti ti-mail ti-sm'></i>
                                        <span class="align-middle ms-2">josephGreen@email.com</span>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class='ti ti-phone-call ti-sm'></i>
                                        <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="mt-4">
                                <small class="text-muted text-uppercase">Options</small>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class='ti ti-badge ti-sm'></i>
                                        <span class="align-middle ms-2">Add Tag</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class='ti ti-star ti-sm'></i>
                                        <span class="align-middle ms-2">Important Contact</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class='ti ti-photo ti-sm'></i>
                                        <span class="align-middle ms-2">Shared Media</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class='ti ti-trash ti-sm'></i>
                                        <span class="align-middle ms-2">Delete Contact</span>
                                    </li>
                                    <li class="cursor-pointer d-flex align-items-center">
                                        <i class='ti ti-ban ti-sm'></i>
                                        <span class="align-middle ms-2">Block Contact</span>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /Sidebar Right -->

                    <div class="app-overlay"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Internal Notes</h5>
                    <ul class="timeline mt-5 internal-notes-history">
                    </ul>
                    <form class="form-send-internal-message d-flex justify-content-between align-items-center" type="submit">
                        <input class="form-control internal-message-input border-0 me-3 shadow-none"
                            placeholder="Type your internal notes here">
                        <div class="message-actions d-flex align-items-center">
                            <button class="btn btn-primary d-flex send-msg-btn">
                                <i class="ti ti-send me-md-1 me-0"></i>
                                <span class="align-middle d-md-inline-block d-none">Send</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
