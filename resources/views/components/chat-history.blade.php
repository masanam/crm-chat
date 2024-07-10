<div class="col app-chat-history bg-body" id="{{$chatHistoryId}}">
    <div class="chat-history-wrapper">
        @if($isUsingHeader)
        <header>
            <div class="chat-history-header border-bottom bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex overflow-hidden align-items-center">
                        <button class="btn d-flex gap-2 fw-bold text-dark" onclick="window.history.back()">
                            <i class="ti ti-arrow-left text-dark"></i>
                          </button>
                        <span class="m-0 text-dark fw-bold" style="font-size: 22px">{{ $title }}</span>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 py-1 chat-history-header-tag px-2 py-2">
                @if($customHeader)
                {{ $customHeader }}
                @else
                <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                    <i class="ti ti-user user-icon text-dark"></i>
                    <div class="d-flex align-items-center gap-1">
                        @foreach($people as $index => $value)
                        @if(count($people) > 1)
                        <small>{{ $value }}{{ count($people) - 1 === $index ? '' : ',' }}</small>
                        @else
                        <small>{{ $value }}</small>
                        @endif
                        @endforeach
                    </div>
                </div>
                <x-badge-priority type="{{ $priority }}"></x-badge-priority>
                <small>{{ $typeTask }}</small>
                @endif
            </div>
        </header>
        @endif

        <!--
        ketika buat ticket, sekaligus buat group, dan semua orang yang di group member itu yang bisa saling chat di chat-history
        tambahkan add member dengan modal
        -->
        <div class="chat-history-body bg-white ww">
            <ul class="list-unstyled chat-history">
                test
            </ul>
        </div>

        <!-- Chat message form -->
        <div class="chat-history-footer">
            <form class="form-send-message d-flex flex-column justify-content-between h-100" method="POST">
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