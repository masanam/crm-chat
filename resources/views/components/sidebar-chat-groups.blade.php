<div class="app-chat-contacts app-sidebar overflow-hidden" id="app-chat-contacts">
    <div class="sidebar-body">
        <!-- Nav tabs -->
        <div class="container pt-2 pb-2 justify-content-end">
            @if ($title)
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="pt-3 fw-bolder text-dark">
                    <img src="{{asset('assets/svg/icons/corporate_fare.svg')}}" />
                    {{ $title }}
                </h4>
                @if($targetOpenModal)
                <button class="button-none" data-bs-toggle="modal" data-bs-target="{{ $targetOpenModal }}">
                    <i class="ti ti-plus"></i>
                </button>
                @endif
            </div>
            @endif

            @if($customHeader)
            {{ $customHeader }}
            @else
            <ul class="nav nav-tabs" id="chats-tabs" role="tablist">
                @foreach($tabs as $key => $value)
                <li class="nav-item" role="presentation" style="width: 113px;">
                    <button class="nav-link nav-item-custom {{ $key === 0 ? 'active' : '' }}" id="{{ strtolower($value->name) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ strtolower($value->name) }}" type="button" role="tab" aria-controls="{{ strtolower($value->name) }}" aria-selected="true">{{ $value->name }}</button>
                </li>
                @endforeach
            </ul>
            @endif

            <div class="d-flex align-items-center flex-row sidebar-header mt-3">
                <div class="d-flex align-items-center flex-grow-1 me-3 me-lg-0">

                    <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                        <span class="input-group-text form-search-custom" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control chat-search-input form-search-custom" placeholder="{{ $placeholderSearchText }}" aria-label="{{ $placeholderSearchText }}" aria-describedby="basic-addon-search31">
                    </div>
                </div>
                @if($isUsingFilterChat)
                <button class="button-none" data-bs-toggle="modal" data-bs-target="{{ $targetOpenModalFilter }}">
                    <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                </button>
                @endif
            </div>
        </div>

        <div class="container pt-2 d-flex justify-content-center">
            <ul class="nav nav-tabs" id="chats-tabs" role="tablist">
                <li class="nav-item" role="presentation" style="width: 113px;">
                    <button class="nav-link nav-item-custom active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation" style="width: 113px;">
                    <button class="nav-link nav-item-custom " id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="false" tabindex="-1">Unread</button>
                </li>
            </ul>
        </div>

        <!-- body -->
        {{ $body }}
    </div>
</div>