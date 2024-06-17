<section class="tab-email d-flex flex-column gap-2">
    <div class="d-flex justify-content-between card-filter">
        <div class="d-flex header-filter">
            <button class="active">Open</button>
            <button>Archived</button>
            <button>Snoozed</button>
            <button>Trash</button>
        </div>
        <button class="btn btn-sm button-filter">
            <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
            Filters
        </button>
    </div>
    <div class="d-flex flex-column" id="customer-detail-content-email">
        <div class="card-email">
            <div class="card-email-body d-flex flex-column gap-2">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-dark fw-bold">Jonny Ki</span>
                    <span>3 h</span>
                </div>
                <span class="text-dark fw-bold">Important Update</span>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Hi, Randy. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                    <img src="{{asset('assets/svg/icons/info.svg')}}" alt="info" width="20">
                </div>
            </div>
        </div>
        <button class="button-float" data-bs-toggle="modal" data-bs-target="#communication-email">
            <img src="{{asset('assets/svg/icons/icon-send-email.svg')}}" alt="icon-send-email" width="55">
        </button>
    </div>
</section>