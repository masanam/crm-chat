<section class="d-flex flex-row justify-content-between align-items-center px-5 py-2 bg-white">
    <h4 class="fw-bolder text-dark mb-0">{{ $title }}</h4>
    <div class="d-flex flex-row gap-4 align-items-center">
        <div class="d-flex flex-row align-items-center gap-2">
            <button type="button" class="btn btn-icon me-2 btn-primary rounded-circle">
                <span class="ti ti-plus"></span>
            </button>
            @if ($isUsingMultipleView)
            <div class="d-flex flex-row align-items-center gap-1" style="margin-right: 8px;">
                <button class="btn btn-view">
                    <img src="{{asset('assets/svg/icons/icon-chat-view.svg')}}" alt="info" width="20" height="20">
                </button>
                <button class="btn btn-view">
                    <img src="{{asset('assets/svg/icons/icon-kanban-view.svg')}}" alt="info" width="20" height="20">
                </button>
                <button class="btn btn-view">
                    <img src="{{asset('assets/svg/icons/icon-list-view.svg')}}" alt="info" width="20" height="20">
                </button>
            </div>
            @endif
            <button type="button" class="btn btn-border">
                <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">Filters
            </button>
        </div>
        <div class="d-flex align-items-center flex-grow-1 me-3 me-lg-0">

            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                <span class="input-group-text form-search-custom" id="basic-addon-search31"><i
                        class="ti ti-search"></i></span>
                <input type="text" class="form-control chat-search-input form-search-custom" placeholder="{{ $placeholderSearchText }}"
                    aria-label="{{ $placeholderSearchText }}" aria-describedby="basic-addon-search31">
            </div>
        </div>
    </div>
</section>