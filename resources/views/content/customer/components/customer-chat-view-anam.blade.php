@php
    $obj1 = (object) [
        'name' => 'Aditya Rahardi',
        'cars' => 'Toyota Avanza',
        'time' => '12:48 PM',
        'chat' => 'I will purchase it for sure. 👍',
        'tag' => 'cold',
    ];

    $myArray = [$obj1];

    $tab2 = (object) [
        'name' => 'Active',
    ];
    $tab3 = (object) [
        'name' => 'Closed',
    ];

    $listTabs = [$tab2, $tab3];
    
    $sortedActive = \App\Models\Chat::with('lead')
    ->whereRelation('lead', 'status','Active')
    ->orderBy('id','DESC')
    ->get()
    ->unique('from');
    
   //foreach($customerActive as $item){
   //     echo $item->id.' - '.$item->created_at.' - '. $item->lead->status.'</br/>';
   //   }

    $sortedClosed = \App\Models\Chat::with('lead')
    ->whereRelation('lead', 'status','!=' ,'Active')
    ->orderBy('id','DESC')
    ->get()
    ->unique('from');

@endphp

<section class="d-flex tab-pane fade active show" id="chat-view" role="tabpanel">
    <x-sidebar-chat-contacts :tabs="$listTabs" isUsingSearch="{{ false }}">
        <x-slot name="body">
            <div class="tab-content p-0">
            <div class="tab-pane active" id="active" role="tabpanel" aria-labelledby="open-tab">
                    @if (count($sortedActive) > 0)
                        <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                            @foreach ($sortedActive as $key => $value)
                                <li class="chat-contact-list-item" data-contact="{{ $value->from }}">
                                    <a class="d-flex align-items-center">
                                        <div class="avatar-initial" style="padding: 12px;">
                                            <span class="text-dark fw-bolder">{{ Helper::getInitial($value->lead?->client_name); }}</span>
                                        </div>

                                        <div class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate m-0 text-dark fw-bolder" 
                                                data-id="{{ $value->from }}" 
                                                data-counter="{{ $value->created_at }}" 
                                                data-contact="{{ $value->lead?->client_name }}" 
                                                data-type="contact" 
                                                data-job="{{ $value->lead?->title }}" 
                                                data-company="{{ $value->lead?->company_name }}"
                                                data-closed="{{ $value->lead?->closed_date }}" 
                                                data-budget="{{ $value->lead?->budget }}"
                                                >
                                                {{ isset($value->lead->client_name) ? $value->lead->client_name : $value->from }}</h6>
                                                @if ($value->created_at->isToday())
                                                <small>{{ $value->created_at->format('H:i'); }}</small>
                                                @else
                                                <small>{{ $value->created_at->diffForHumans() }}</small>
                                                @endif
                                                </div>
                                                <small>{{ $value->from }}</small>
                                            </div>

                                            <div>
                                                <p class="chat-contact-status text-chat text-truncate mb-0">
                                                    <input type="hidden" id="id" value="{{ $value->id }}"/>
                                                    <span class="badge badge-sm rounded-pill text-dark"
                                                        style="background: #B8E9EF;">
                                                        {{ $value->lead?->status }}
                                                    </span>
                                                    <span class="badge badge-sm rounded-pill text-dark"
                                                        style="background: #B8E9EF;">
                                                        {{ $value->lead?->quality }}
                                                    </span>
                                                    <span class="badge badge-sm rounded-pill text-dark"
                                                        style="background: #B8E9EF;">
                                                        {{ $value->lead?->stage }}
                                                    </span>

                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                        <i class="ti ti-user user-icon text-dark"></i>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <small>A,</small>
                                                            <small>b,</small>
                                                            <small>+1</small>
                                                        </div>
                                                    </div>


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
                            @foreach ($sortedClosed as $key => $value)
                                <li class="chat-contact-list-item" data-contact="{{ $value->from }}">
                                    <a class="d-flex align-items-center">
                                        <div class="avatar-initial" style="padding: 12px;">
                                            <span class="text-dark fw-bolder">{{ Helper::getInitial($value->lead?->client_name); }}</span>
                                        </div>

                                        <div class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="chat-contact-name text-truncate m-0 text-dark fw-bolder" data-id="{{ $value->from }}" data-contact="{{ $value->lead?->client_name }}" data-type="contact" data-job="{{ $value->lead?->title }}" data-company="{{ $value->lead?->company_name }}">
                                                {{ isset($value->lead->client_name) ? $value->lead->client_name : $value->from }}</h6>
                                                <small>{{ $value->created_at->diffForHumans() }}</small>
                                                </div>
                                                <small>{{ $value->from }}</small>
                                            </div>
                                            <div>
                                                <p class="chat-contact-status text-chat text-truncate mb-0">
                                                    <!-- {{ $value->message }} -->
                                                </p>
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
                                                        {{ $value->lead?->status }}
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
                     </div>
            </div>
        </x-slot>
    </x-sidebar-chat-contacts>

    <!-- Chat History -->
    <div class="d-flex flex-column" style="width: 50%; height: 584px;">
    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging" style="padding: 8px 14px;">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <span class="client-name">Whatsapp</span>
                <input type="hidden" id="counter-date" value=""/>

            </nav>
            
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">Connected</span>
                <span class="ic-connecting">Connecting...</span>
                <span class="ic-noInternet">No internet access</span>
            </div>
        </div>
        <span
            id="countdown-session"
            class="w-100"
            style="display:none; font-size: 14px; background: #616A75; padding: 2px 0px; color: #fff; text-align: center;"
        >
        </span>

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

        {{-- Confirmation internal chat --}}
        <button
            id="confirmation-internal-chat"
            class="w-100"
            style="font-size: 14px; background: #616A75; padding: 2px 0px; color: #fff; display: none;"
        >
            You are chatting internally. Click to close
        </button>

        {{-- Send Message Form --}}
        <div class="messenger-sendCard" style="background: #F1F2F4;">
                <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                    @csrf

                    {{-- <button class="emoji-button"></span><span class="fas fa-smile"></button> --}}
                    <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Write message"></textarea>
                    <div id="confirmation-session-expired" style="font-size: 14px; display: none;">
                        <span style="color: #000; font-weight: 600;">Can’t send message</span>
                        <span style="font-style: italic; color: #616A75;">This session time for this chat has ended. The chat can be reconvened only if the user  sends template.</span>
                    </div>
                    <div class="wrapper-btn-action">
                        <div style="display: flex; align-items: center; column-gap: 12px; margin-left: 8px;">
                            <label>
                                <img id="btn-upload" src="{{ asset('assets/svg/icons/icon-upload.svg') }}" alt="upload" width="24" style="cursor: pointer;">
                                <input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" />
                            </label>
                            <input type="hidden" name="type" id="type" value="contactChat">
                            <button id="btn-template" data-bs-toggle="modal" data-bs-target="#template-chat">
                                <img id="icon-bolt" src="{{ asset('assets/svg/icons/icon-bolt.svg') }}" alt="template" width="24" style="cursor: pointer;">
                                <img id="icon-bolt-active" style="display: none;" src="{{ asset('assets/svg/icons/icon-bolt-color.svg') }}" alt="template" width="32" style="cursor: pointer;">
                            </button>
                            <button id="btn-internal-chat">
                                <img src="{{ asset('assets/svg/icons/icon-note-alt.svg') }}" alt="internal-note" width="24">
                            </button>
                        </div>
                        <button disabled='disabled' class="send-button" style="background: #EBECEF; padding: 8px 10px; border-radius: 50%;">
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
                    <div class="avatar-initial" style="padding: 12px;">
                        <span class="text-dark fw-bolder client-initial">{{ Helper::getInitial('Acme Inc'); }}</span>
                    </div>
                    <span class="text-dark fw-bold client-name" style="font-size: 22px">Acme Inc</span>
                    <span class="badge badge-sm rounded-pill text-dark client-job" style="background: #CCE8E8;">

                </div>
                <div class="d-flex justify-content-between align-items-center px-2">
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-calendar.svg')}}" alt="calendar" width="15">
                        <span style="font-size: 12px" class="client-closed">April 22, 2024</span>
                    </div>
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-dolar.svg')}}" alt="dolar" width="15">
                        <span style="font-size: 12px" class="client-budget"client-job>Rp. 2,000,000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-card d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center">
                                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                                                width="15" data-bs-toggle="modal" data-bs-target="#update-status"
                                                class="cursor-pointer">

                                    <span class="text-dark fw-bold" style="font-size: 18px">Status</span>
                                </div>

            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Status</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                    @foreach ($stat as $itemStatus)
                    <option value="{{ $itemStatus }}">{{ $itemStatus }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Quality</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($qty as $itemQty)
                    <option value="{{ $itemQty }}">{{ $itemQty }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Stage</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($stg as $itemStage)
                    <option value="{{ $itemStage }}">{{ $itemStage }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-dark">Customer Type</h6>
                <select id="status" class="form-select custom-select" data-allow-clear="true">
                @foreach ($type as $itemType)
                    <option value="{{ $itemType }}">{{ $itemType }}</option>
                    @endforeach
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
                        <span class="text-dark fw-bold client-name">Rihanza Fadlitya</span>
                        <img
                            src="{{asset('assets/svg/icons/edit.svg')}}"
                            alt="edit"
                            width="15"
                            data-bs-toggle="modal"
                            data-bs-target="#add-edit-contact"
                            class="cursor-pointer"
                        >
                    </div>
                    <span class="text-dark client-job" style="font-size: 14px">Head of Sales</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{asset('assets/svg/icons/icon-contact-mail.svg')}}" alt="contact" width="15">
                        <span class="client-whatsapp" style="font-size: 12px">+82 821 4567 1234</span>
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
                <span class="client-company">Acme Inc</span>
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