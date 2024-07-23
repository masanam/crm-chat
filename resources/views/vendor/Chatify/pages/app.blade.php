@include('Chatify::layouts.headLinks')
@php
$groupList = App\Models\ChChannel::get();
@endphp
<div class="messenger app-chat">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header" style="background: #F7FAFA;">
            <nav style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; column-gap: 10px;">
                    <img src="{{asset('assets/svg/icons/corporate_fare.svg')}}" />
                    Internal
                </div>
                {{-- header buttons --}}
                <div class="m-header-right">
                    <button class="button-none group-btn" style="background: transparent;border: none;padding: 0px;">
                        <i class="fas fa-plus" style="color: #000"></i>
                    </button>
                </div>
            </nav>
            {{-- Search input --}}
            <input type="text" class="messenger-search" placeholder="Search groups/conversations" style="background: #EFF1F8;" />
            {{-- Tabs --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}}
        </div>
        {{-- tabs and lists --}}
        <div class="m-body contacts-container" style="background: #F7FAFA;">
           {{-- Lists [Users/Group] --}}
           {{-- ---------------- [ User Tab ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section" style="display: none;">
                <p class="messenger-title"><span>Favorites</span></p>
                <div class="messenger-favorites app-scroll-hidden" style="display: none;"></div>
               </div>
               {{-- Saved Messages --}}
               
               {{-- Contact --}}
               <div class="messenger-title border-top">
                <span style="background: transparent;">Groups</span>
                <button class="dropdown-toggle-group" style="border: none; background: none; cursor: pointer;">
                    <div style="display: flex; align-items: center; column-gap: 10px;">
                        <p class="badge">10</p>
                        <i class="fas fa-chevron-down" style="color: #000"></i>
                    </div>
                </button>
               </div>
               <div class="listOfgroups">
                @foreach ($groupList as $group)
                <table class="group-list-item" data-contact="{{ $group->id }}">
                <tr data-action="0">
                        {{-- Avatar side --}}
                        <td>
                            <div class="avatar-initial">
                                <span style="color: #000; font-weight: 600;">{{ Helper::getInitial($group->name); }}</span>
                            </div>
                        </td>
                        {{-- center side --}}
                        <td>
                        <p data-id="{{ $group->id }}" data-type="group">
                        {{ $group->name }}
                            </p>
                        </td>
                    </tr>
                </table>
                @endforeach


               </div>

               <div class="messenger-title">
                <span style="background: transparent;">1 on 1</span>
                <button class="dropdown-toggle-one" style="border: none; background: none; cursor: pointer;">
                    <div style="display: flex; align-items: center; column-gap: 10px;">
                        <p class="badge">10</p>
                        <i class="fas fa-chevron-down" style="color: #000"></i>
                    </div>
                </button>
               </div>
               <div class="listOfContacts"></div>
           </div>
             {{-- ---------------- [ Search Tab ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- items --}}
                <p class="messenger-title"><span style="background: transparent;">Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
             </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        {{-- header title [conversation name] amd buttons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- header back button, avatar and user name --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
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
        @include('Chatify::layouts.sendForm')
    </div>
    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll" style="background: #F7FAFA;">
        {{-- nav actions --}}
        {!! view('Chatify::layouts.info-group')->render() !!}
    </div>

</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
