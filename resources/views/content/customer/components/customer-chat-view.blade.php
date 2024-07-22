@php
    $obj1 = (object) [
        'name' => 'Aditya Rahardi',
        'cars' => 'Toyota Avanza',
        'time' => '12:48 PM',
        'chat' => 'I will purchase it for sure. 👍',
        'tag' => 'cold',
    ];

    $myArray = [$obj1];

    $tab = (object) [
        'name' => 'New',
    ];
    $tab2 = (object) [
        'name' => 'Active',
    ];
    $tab3 = (object) [
        'name' => 'Closed',
    ];

    $listTabs = [$tab, $tab2, $tab3];
    //$customers = \App\Models\Chat::with('dealer')->distinct('from')->orderby('from')->get();

    $customers = \App\Models\Chat::with('lead')
      ->distinct('from')
      ->where('to', env('TWILIO_WHATSAPP_FROM'))
      ->orderBy('from', 'ASC')
      ->orderBy('created_at','DESC')
      ->get();

      //dd($customers);
    //$chatPhones = $chats->pluck('from')->toArray();

    //$leadNotChats = \App\Models\Lead::where('dealer_id', $user->dealer_id)
    //  ->whereNotIn('phone_number', $chatPhones)
    //  ->get();

@endphp

<section class="d-flex tab-pane fade active show" id="chat-view" role="tabpanel">
    <x-sidebar-chat-contacts :tabs="$listTabs" isUsingSearch="{{ false }}">
        <x-slot name="body">
            <div class="tab-content p-0">
                <div class="tab-pane active" id="open" role="tabpanel" aria-labelledby="open-tab">
                    @if (count($myArray) > 0)
                        <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                            @foreach ($customers as $key => $value)
                                <li class="chat-contact-list-item" data-contact="{{ $value->from }}">
                                    <a class="d-flex align-items-center">
                                        <div class="flex-shrink-0 avatar">
                                            <span
                                                class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">{{ Helper::getInitial($value->lead?->client_name); }}</span>
                                        </div>

                                        <div class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate m-0 text-dark fw-bolder" data-id="{{ $value->from }}" data-type="contact">
                                                {{ $value->from }}</h6>
                                                        <small>{{ $value->updated_at->diffForHumans() }}</small>
                                                        </div>
                                                <small>{{ $value->lead?->client_name }}</small>
                                            </div>
                                            <div>
                                                <p class="chat-contact-status text-chat text-truncate mb-0">
                                                    {{ $value->message }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                        <i class="ti ti-user user-icon text-dark"></i>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <small>Sally,</small>
                                                            <small>Princess,</small>
                                                            <small>+1</small>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-sm rounded-pill text-dark"
                                                        style="background: #B8E9EF;">
                                                        {{ $value->type }}
                                                    </span>
                                                </div>
                                                <button class="btn-route-customer" data-id="{{ $value->id }}">
                                                    <img src="{{ asset('assets/svg/icons/info.svg') }}" alt="info"
                                                    width="20">
                                                </button>
                                            </div>
                                        </div>

                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    @endif
                </div>
                <div class="tab-pane" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                    <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                        <li class="chat-contact-list-item chat-list-item-0">
                            <h6 class="text-muted mb-0">No Chats Found</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </x-slot>
    </x-sidebar-chat-contacts>

    <!-- Chat History -->
    <div class="d-flex flex-column" style="width: 50%">
    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <a href="#" class="user-name">{{ 'Chat Box' }}</a>
                    <div class="badge-status">
                        <div class="status-online"></div>
                        <span>Online</span>
                    </div>
                </div>
                {{-- header buttons --}}
                <nav class="m-header-right">
                    <a href="#" class="show-infoSide">
                        <img src="{{ asset('assets/svg/icons/info.svg') }}" alt="info" width="20">
                    </a>
                </nav>
            </nav>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll" style="background: #FFFFFF;">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
            {{-- Typing indicator --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        {{-- Send Message Form --}}
        <div class="messenger-sendCard" style="background: #F1F2F4;">
                <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                    @csrf

                    {{-- <button class="emoji-button"></span><span class="fas fa-smile"></button> --}}
                    <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Write message"></textarea>
                    <div class="wrapper-btn-action">
                        <div style="display: flex; align-items: center; column-gap: 12px; margin-left: 8px;">
                            <label>
                                <img src="{{ asset('assets/svg/icons/icon-upload.svg') }}" alt="upload" width="24" style="cursor: pointer;">
                                <input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" />
                            </label>
                            <input type="hidden" name="type" id="type" value="contactChat">
                            <img src="{{ asset('assets/svg/icons/icon-bolt.svg') }}" alt="template" width="24" style="cursor: pointer;">
                            <img src="{{ asset('assets/svg/icons/icon-note-alt.svg') }}" alt="internal-note" width="24" style="cursor: pointer;">
                        </div>
                        <button disabled='disabled' class="send-button">
                            <img src="{{ asset('assets/svg/icons/send.svg') }}" alt="send" width="24">
                        </button>
                    </div>
                </form>
        </div>
    </div>
        
    </div>
    <!-- /Chat History -->
    <!-- Sidebar Right -->
    <x-sidebar-right-info-chat isUsingHeader="{{ false }}" sidebarClass="show">
        <div class="sidebar-card d-flex flex-column">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                    <div class="flex-shrink-0 avatar">
                        <span class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial('Acme Inc') }}</span>
                    </div>
                    <span class="text-dark fw-bold" style="font-size: 22px">Acme Inc</span>
                    <x-badge-stage type="Lead"></x-badge-stage>
                </div>
                <div class="d-flex justify-content-between align-items-center px-2">
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-calendar.svg')}}" alt="calendar" width="15">
                        <span style="font-size: 12px">April 22, 2024</span>
                    </div>
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-dolar.svg')}}" alt="dolar" width="15">
                        <span style="font-size: 12px">Rp. 2,000,000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-card d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Status</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    <option value="active">Active</option>
                    <option value="offline">Offline</option>
                    <option value="away">Away</option>
                    <option value="busy">Busy</option>
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Quality</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    <option value="warm">Warm</option>
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Stage</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    <option value="test-drive">Test drive</option>
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Customer Type</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    <option value="test-drive">B2B</option>
                    <option value="test-drive">B2C</option>
                </select>
            </div>
        </div>

        <div class="sidebar-card d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold" style="font-size: 18px">Contact Information</span>
                <i class="ti ti-chevron-down text-dark"></i>
            </div>
            <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3">
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-dark fw-bold">Rihanza Fadlitya</span>
                        <img
                            src="{{asset('assets/svg/icons/edit.svg')}}"
                            alt="edit"
                            width="15"
                            data-bs-toggle="modal"
                            data-bs-target="#add-edit-contact"
                            class="cursor-pointer"
                        >
                    </div>
                    <span class="text-dark" style="font-size: 14px">Head of Sales</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-contact-mail.svg')}}" alt="contact" width="15">
                        <span style="font-size: 12px">+82 821 4567 1234</span>
                    </div>
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-circle-outline.svg')}}" alt="circle" width="15">
                        <span style="font-size: 12px">WhatsApp</span>
                    </div>
                </div>
            </div>
            <button class="btn-link" data-bs-toggle="modal" data-bs-target="#add-edit-contact">
                + Add more contacts
            </button>
        </div>

        <div class="sidebar-card d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold" style="font-size: 18px">Company Information</span>
                <i class="ti ti-chevron-down text-dark"></i>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Company Name</span>
                <span>Acme Inc</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Industry</span>
                <span>Entertainment</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Location</span>
                <span>Indonesia</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark">Website</span>
                <span>http://www.acme.com</span>
            </div>
        </div>

        <div class="sidebar-card d-flex flex-column gap-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold" style="font-size: 18px">Deals Information</span>
                <i class="ti ti-chevron-down text-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <span class="text-dark" style="font-weight: 600;">Description</span>
                <span style="font-size: 13px; color: #616A75;">An entertainment company needing a CRM software for their creative teams</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark" style="font-weight: 600;">Revenue</span>
                <span>Rp 2,000,000</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark" style="font-weight: 600;">Close Date</span>
                <span>13 April 2024</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark" style="font-weight: 600;">Source</span>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    <option value="test-drive">Outboned</option>
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark" style="font-weight: 600;">Field</span>
                <span>Options</span>
            </div>
            <div class="d-flex flex-column">
                <span class="text-dark" style="font-weight: 600;">Next Step</span>
                <span style="font-size: 13px; color: #616A75;">Follow up after 2 days by sending proposal</span>
            </div>
        </div>

    </x-sidebar-right-info-chat>
    <!-- /Sidebar Right -->
</section>