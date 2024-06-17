<section class="tab-communication tab-pane fade" id="tab-communication" role="tabpanel">
    <div class="d-flex flex-column chat-history-wrapper" style="width: 100%">
        <ul class="nav nav-tabs nav-tab-chat" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link sub-nav-communication active" role="tab" data-bs-toggle="tab" data-bs-target="#wa" aria-controls="wa" aria-selected="true">WhatsApp</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link sub-nav-communication" role="tab" data-bs-toggle="tab" data-bs-target="#email" aria-controls="email" aria-selected="false">Email</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link sub-nav-communication" role="tab" data-bs-toggle="tab" data-bs-target="#we-chat" aria-controls="we-chat" aria-selected="false">WeChat</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link sub-nav-communication" role="tab" data-bs-toggle="tab" data-bs-target="#instagram" aria-controls="instagram" aria-selected="false">Instagram</button>
            </li>
        </ul>
        <div class="tab-content-chat">
            <div class="tab-pane fade show active" id="wa" role="tabpanel">
                <x-chat-history></x-chat-history>
            </div>
            <div class="tab-pane fade" id="email" role="tabpanel">
                @include('content/customer/components/customer-detail-tab-email')
            </div>
            <div class="tab-pane fade" id="we-chat" role="tabpanel">
                <x-chat-history></x-chat-history>
            </div>
            <div class="tab-pane fade" id="instagram" role="tabpanel">
                <x-chat-history></x-chat-history>
            </div>
        </div>
    </div>
</section>