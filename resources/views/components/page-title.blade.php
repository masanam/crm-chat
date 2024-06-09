<section class="d-flex flex-row justify-content-between align-items-center px-5 py-2 bg-white">
    <h4 class="fw-bolder text-dark mb-0">{{ $title }}</h4>
    <div class="d-flex flex-row gap-4 align-items-center">
        <div class="d-flex flex-row align-items-center gap-2">
            <button type="button" class="btn btn-icon me-2 btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="{{ $targetOpenModal }}">
                <span class="ti ti-plus"></span>
            </button>
            @if ($isUsingMultipleView)
            <div class="d-flex flex-row align-items-center gap-1" role="tablist" style="margin-right: 8px;">
                <button class="btn btn-view nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#chat-view" aria-controls="chat-view" aria-selected="true">
                    <img src="{{asset('assets/svg/icons/icon-chat-view.svg')}}" alt="info" width="20" height="20">
                </button>
                <button class="btn btn-view nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#kanban-view" aria-controls="kanban-view" aria-selected="true">
                    <img src="{{asset('assets/svg/icons/icon-kanban-view.svg')}}" alt="info" width="20" height="20">
                </button>
                <button class="btn btn-view nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#list-view" aria-controls="list-view" aria-selected="true">
                    <img src="{{asset('assets/svg/icons/icon-list-view.svg')}}" alt="info" width="20" height="20">
                </button>
            </div>
            @endif
            <button type="button" class="btn btn-border" data-bs-toggle="modal" data-bs-target="#filter">
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