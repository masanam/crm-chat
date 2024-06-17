<section class="tab-ticket tab-pane fade d-flex flex-column gap-2" id="tab-ticket" role="tabpanel">
    <div class="d-flex flex-wrap justify-content-between card-filter mt-3">
        <button class="btn btn-sm button-new" data-bs-toggle="modal" data-bs-target="#add-ticket">
            New
            <i class="ti ti-dots-vertical"></i>
        </button>
        <div class="d-flex header-filter">
            <button class="active">Open</button>
            <button>In-Progress</button>
            <button>Pending</button>
            <button>Closed</button>
        </div>
        <button class="btn btn-sm button-filter">
            <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
            Filters
        </button>
    </div>
    <div class="d-flex flex-column gap-3 wrapper-content-ticket" id="customer-detail-content-email">
        <div class="card-ticket d-flex flex-column gap-3 pb-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold">Cek stock</span>
                <span style="font-size: 12px;">Today, 3 Jun 2024 15.53</span>
            </div>
            <span class="text-dark">Help to follow up</span>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                    <i class="ti ti-user user-icon text-dark"></i>
                    <small>Operations Team</small>
                </div>
                <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
                    Cold
                </span>
            </div>
        </div>
        <div class="card-ticket d-flex flex-column gap-3 pb-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold">Cek stock</span>
                <span style="font-size: 12px;">Today, 3 Jun 2024 15.53</span>
            </div>
            <span class="text-dark">Help to follow up</span>
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                    <i class="ti ti-user user-icon text-dark"></i>
                    <small>Operations Team</small>
                </div>
                <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
                    Cold
                </span>
            </div>
        </div>
    </div>
</section>