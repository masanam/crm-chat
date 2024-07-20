<?php
    $isGroup = isset($channel->owner_id);
    // $channel_id = request()->route('id');
    // $channel = App\Models\ChChannel::find($channel_id);
    // $channel_users = $channel->users()->get();
?>
<nav>
    <a href="#"><i class="fas fa-times" style="color: #000;"></i></a>
    <p class="header-name">{{isset($channel->owner_id) ? 'Abount Group' : 'Profile'}}</p>
</nav>

<div class="avatar-initial" style="padding: 6px;">
    <p class="initial">{{ Helper::getInitial(config('chatify.name')) }}</p>
</div>
<p class="info-name">{{ config('chatify.name') }}</p>
@if($isGroup)
    <div style="padding: 12px 14px;">
        <div style="
            border-radius: 12px;
            border: 1px solid #DDE0E4;
            background: #FFF; display: flex; flex-direction: column; padding: 12px 10px; row-gap: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 16px; font-weight: 600;">Group introduction</span>
                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit" width="18" data-bs-toggle="modal" data-bs-target="#add-edit-contact" class="cursor-pointer">
            </div>

            <span style="font-size: 14px; text-align: left; color: #616A75;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</span>
        </div>
        <div style="margin-top: 18px; padding: 12px 10px;" class="userlist">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 16px; font-weight: 600;">Members</span>
                <img src="{{ asset('assets/svg/icons/person_add.svg') }}" alt="edit" width="18" data-bs-toggle="modal" data-bs-target="#new-member" class="cursor-pointer">
            </div>
            <div class="app-scroll users-list">
                @foreach($channel->users as $user)
                    {!! view('Chatify::layouts.listItem', ['get' => 'user_search_item', 'user' => Chatify::getUserWithAvatar($user)])->render() !!}
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="messenger-infoView-btns">
    @if($isGroup && $channel && $channel->owner_id === Auth::user()->id)
        <a href="#" class="danger delete-group">Delete Group</a>
    @elseif($isGroup)
        <a href="#" class="danger leave-group">Leave Group</a>
    @else
        <a href="#" class="danger delete-conversation">Delete Conversation</a>
    @endif
</div>

{{-- shared photos --}}
{{-- <div class="messenger-infoView-shared">
    <p class="messenger-title"><span>Shared Photos</span></p>
    <div class="shared-photos-list"></div>
</div> --}}
