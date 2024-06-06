<section class="w-100 dashboard-user">
    <h4 class="fw-bold text-dark">Dashboard</h5>
    <div class="d-flex flex-column gap-5">
        <div class="card card-dashboard">
            <h6 class="text-dark">Pipeline</h6>
            <div class="d-flex flex-column justify-content-between gap-3">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn btn-leads">
                            Leads In
                        </button>
                        <span>$ 400,00 | 2 Deals</span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <div style="background: #33B6B9; width: 20%; height: 8px;"></div>
                        <div style="background: #FF3916; width: 20%; height: 8px;"></div>
                        <div style="background: #2AD68C; width: 20%; height: 8px;"></div>
                        <div style="background: #6931E9; width: 20%; height: 8px;"></div>
                        <div style="background: #667085; width: 20%; height: 8px;"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-1 pipeline-detail-chart">
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column">
                            <span class="title title-total-deals">Total Deals</span>
                            <span class="subtitle subtitle-total-deals">+USD 1000.00</span>
                        </div>
                        <span>10 Data Deals</span>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column">
                            <span class="title title-won-deals">Won Deals</span>
                            <span class="subtitle subtitle-won-deals">+USD 400.00</span>
                        </div>
                        <span>10 Data Deals</span>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column">
                            <span class="title title-lost-deals">Lost Deals</span>
                            <span class="subtitle subtitle-lost-deals">+USD 100.00</span>
                        </div>
                        <span>10 Data Deals</span>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex flex-column">
                            <span class="title title-win-ratio">Win Ratio</span>
                            <span class="subtitle subtitle-win-ratio">50%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gap-5 px-2">
            <div class="col-xl-6 col-12 card">
              <div class="card-header header-elements p-3 my-n1 justify-content-between">
                <h6 class="card-title mb-0 pl-0 pl-sm-2 p-2 text-dark">Activities</h6>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-icon btn-filter">
                    <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                    Filters
                  </button>
                  <button class="btn btn-sm btn-icon">
                    <i class="text-dark ti ti-dots-vertical"></i>
                  </button>
                </div>
              </div>
                <div class="card-body chart-container">
                  <canvas id="activitiesChart" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
            <div class="col-xl-6 col-12 card">
              <div class="card-header header-elements p-3 my-n1 justify-content-between">
                <h6 class="card-title mb-0 pl-0 pl-sm-2 p-2 text-dark">Activities</h6>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-icon btn-filter">
                    <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                    Filters
                  </button>
                  <button class="btn btn-sm btn-icon">
                    <i class="text-dark ti ti-dots-vertical"></i>
                  </button>
                </div>
              </div>
                <div class="card-body chart-container">
                    <canvas id="activitiesChart2" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
            <div class="col-xl-6 col-12 card">
                <div class="card-header header-elements p-3 my-n1 justify-content-between">
                    <h6 class="card-title mb-0 pl-0 pl-sm-2 p-2 text-dark">All Close by User</h6>
                    <div class="d-flex gap-2">
                      <button class="btn btn-sm btn-icon btn-filter">
                        <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                        Filters
                      </button>
                      <button class="btn btn-sm btn-icon">
                        <i class="text-dark ti ti-dots-vertical"></i>
                      </button>
                    </div>
                </div>
                <div class="card-body chart-container">
                    <canvas id="closeByUserChart" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
            <div class="col-xl-6 col-12 card">
              <div class="card-header header-elements p-3 my-n1 justify-content-between">
                <h6 class="card-title mb-0 pl-0 pl-sm-2 p-2 text-dark">All Won by User</h6>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-icon btn-filter">
                    <img src="{{asset('assets/svg/icons/filter_list.svg')}}" alt="info" width="20">
                    Filters
                  </button>
                  <button class="btn btn-sm btn-icon">
                    <i class="text-dark ti ti-dots-vertical"></i>
                  </button>
                </div>
              </div>
                <div class="card-body chart-container">
                    <canvas id="wonByUserChart" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>