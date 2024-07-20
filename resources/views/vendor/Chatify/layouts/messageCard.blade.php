<?php
$seenIcon = (!!$seen ? 'check-double' : 'check');
$timeAndSeen = "<span data-time='$created_at' class='message-time'>
     <span class='time'>$timeAgo</span> ".($isSender ? "<span class='fas fa-$seenIcon' seen'></span>" : '' )."
    </span>";
?>

<div class="message-card @if($isSender) mc-sender @endif" data-id="{{ $id }}">
    {{-- Delete Message Button --}}
    @if ($isSender)
        <div class="actions">
            <i class="fas fa-trash delete-btn" data-id="{{ $id }}"></i>
        </div>
    @endif
    {{-- Card --}}
    <div class="message-card-content">
        @if (!$isSender)
        <div class="avatar-initial" style="width: 24px; height: 24px; font-size: 10px; padding: 4px;">
            <span style="color: #000; font-weight: 600;">{{ Helper::getInitial('R'); }}</span>
        </div>
        @endif
        @if (@$attachment->type != 'image' || $message)
            <div class="message" style="display: flex; flex-direction: column; border-radius: 12px;">
                {!! ($message == null && $attachment != null && @$attachment->type != 'file') ? $attachment->title : nl2br($message) !!}
                {!! $timeAndSeen !!}
                {{-- If attachment is a file --}}
                @if(@$attachment->type == 'file')
                <a href="{{ route(config('chatify.attachments.download_route_name'), ['fileName'=>$attachment->file]) }}" class="file-download">
                    <span class="fas fa-file"></span> {{$attachment->title}}</a>
                @endif
            </div>
        @endif
        @if(@$attachment->type == 'image')
        <div class="image-wrapper" style="text-align: {{$isSender ? 'end' : 'start'}}">
            <div class="image-file chat-image" style="background-image: url('{{ Chatify::getAttachmentUrl($attachment->file) }}')">
                <div>{{ $attachment->title }}</div>
            </div>
            <div style="margin-bottom:5px">
                {!! $timeAndSeen !!}
            </div>
        </div>
        @endif
        @if ($isSender)
        <div class="avatar-initial" style="width: 24px; height: 24px; font-size: 10px; padding: 4px;">
            <span style="color: #000; font-weight: 600;">{{ Helper::getInitial('D'); }}</span>
        </div>
        @endif
    </div>
</div>
