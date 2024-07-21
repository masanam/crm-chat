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
                <input type="hidden" name="channelId" id="channelId" class="channelId" value="">
                <img src="{{ asset('assets/svg/icons/icon-bolt.svg') }}" alt="template" width="24" style="cursor: pointer;">
                <img src="{{ asset('assets/svg/icons/icon-note-alt.svg') }}" alt="internal-note" width="24" style="cursor: pointer;">
            </div>
            <button disabled='disabled' class="send-button">
                <img src="{{ asset('assets/svg/icons/send.svg') }}" alt="send" width="24">
            </button>
        </div>
    </form>
</div>
