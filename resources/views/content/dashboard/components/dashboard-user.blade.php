@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard
</h4>
<div class="row">
  <!-- Vehicles overview -->
  <div class="col-xxl-12 mb-4 order-5 order-xxl-0">
    <div class="sidebar-card">
      <div class="card-header">
        <div class="card-title mb-0">
          <h5 class="m-0">Pipeline</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="d-none d-lg-flex vehicles-progress-labels mb-4">
          <div class="vehicles-progress-label on-the-way-text" style="width: 39.7%;">Preparing</div>
          <div class="vehicles-progress-label unloading-text" style="width: 28.3%;">Proposed</div>
          <div class="vehicles-progress-label loading-text" style="width: 17.4%;">Waiting</div>
          <div class="vehicles-progress-label waiting-text text-nowrap" style="width: 14.6%;">Done</div>
        </div>
        <div class="vehicles-overview-progress progress rounded-2 my-4" style="height: 46px;">
          <div class="progress-bar fw-medium text-start bg-primary text-dark px-3 rounded-0" role="progressbar" style="width: 39.7%" aria-valuenow="39.7" aria-valuemin="0" aria-valuemax="100">39.7%</div>
          <div class="progress-bar fw-medium text-start bg-danger px-3" role="progressbar" style="width: 28.3%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%</div>
          <div class="progress-bar fw-medium text-start text-bg-info px-3" role="progressbar" style="width: 17.4%" aria-valuenow="17.4" aria-valuemin="0" aria-valuemax="100">17.4%</div>
          <div class="progress-bar fw-medium text-start bg-success px-2 rounded-0 px-lg-2 px-xxl-3" role="progressbar" style="width: 14.6%" aria-valuenow="14.6" aria-valuemin="0" aria-valuemax="100">14.6%</div>
        </div>
        <!-- Card Border Shadow -->
        <div class="row">
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-md"></i></span>
              </div>
              <h4 class="ms-1 mb-0">42</h4>
            </div>
            <p class="mb-1">Total Deals</p>
            <p class="mb-0">
              <span class="fw-medium me-1">+18.2%</span>
              <small class="text-muted">than last week</small>
            </p>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-warning"><i class='ti ti-alert-triangle ti-md'></i></span>
              </div>
              <h4 class="ms-1 mb-0">8</h4>
            </div>
            <p class="mb-1">Won Deals</p>
            <p class="mb-0">
              <span class="fw-medium me-1">-8.7%</span>
              <small class="text-muted">than last week</small>
            </p>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-danger"><i class='ti ti-git-fork ti-md'></i></span>
              </div>
              <h4 class="ms-1 mb-0">27</h4>
            </div>
            <p class="mb-1">Lost Deals</p>
            <p class="mb-0">
              <span class="fw-medium me-1">+4.3%</span>
              <small class="text-muted">than last week</small>
            </p>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="d-flex align-items-center mb-2 pb-1">
              <div class="avatar me-2">
                <span class="avatar-initial rounded bg-label-info"><i class='ti ti-clock ti-md'></i></span>
              </div>
              <h4 class="ms-1 mb-0">13</h4>
            </div>
            <p class="mb-1">Win Ratio</p>
            <p class="mb-0">
              <span class="fw-medium me-1">-2.5%</span>
              <small class="text-muted">than last week</small>
            </p>
          </div>
        </div>
        <!--/ Card Border Shadow -->

      </div>
    </div>
  </div>
</div>
<!--/ Vehicles overview -->
<div class="row">
  <!-- Delivery Performance -->
  <div class="col-lg-6 col-xxl-4 mb-4 order-2 order-xxl-2">
    <div class="sidebar-card h-100">
      <div class="card-header d-flex align-items-center justify-content-between mb-2">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Activities</h5>
          <small class="text-muted">12% leads in this month</small>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="deliveryPerformance" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-dots-vertical"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryPerformance">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-package"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Proposal in transit</h6>
                <small class="text-success fw-normal d-block">
                  <i class="ti ti-chevron-up mb-1"></i>
                  25.8%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">10k</h6>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class="ti ti-truck"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Proposal out for delivery</h6>
                <small class="text-success fw-normal d-block">
                  <i class="ti ti-chevron-up mb-1"></i>
                  4.3%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">5k</h6>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class="ti ti-circle-check"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Proposal delivered</h6>
                <small class="text-danger fw-normal d-block">
                  <i class="ti ti-chevron-down mb-1"></i>
                  12.5%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">15k</h6>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-percentage"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Success rate</h6>
                <small class="text-success fw-normal d-block">
                  <i class="ti ti-chevron-up mb-1"></i>
                  35.6%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">95%</h6>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-secondary"><i class="ti ti-clock"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Average time</h6>
                <small class="text-danger fw-normal d-block">
                  <i class="ti ti-chevron-down mb-1"></i>
                  2.15%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">2.5 Days</h6>
              </div>
            </div>
          </li>
          <li class="d-flex">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-users"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0 fw-normal">Customer satisfaction</h6>
                <small class="text-success fw-normal d-block">
                  <i class="ti ti-chevron-up mb-1"></i>
                  5.7%
                </small>
              </div>
              <div class="user-progress">
                <h6 class="mb-0">4.5/5</h6>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!--/ Delivery Performance -->
  <!-- Reasons for delivery exceptions -->
  <div class="col-md-6 col-xxl-4 mb-4 order-1 order-xxl-3">
    <div class="sidebar-card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Reasons exceptions</h5>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="deliveryExceptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-dots-vertical"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">
            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="deliveryExceptionsChart" class="pt-md-4" style="min-height: 391.467px;">
          <div id="apexchartsn3u8vrqkg" class="apexcharts-canvas apexchartsn3u8vrqkg apexcharts-theme-light" style="width: 397px; height: 391.467px;"><svg id="SvgjsSvg1403" width="397" height="391.46666793823243" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
              <foreignObject x="0" y="0" width="397" height="391.46666793823243">
                <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="inset: auto 0px -5px; position: absolute; max-height: 210px;">
                  <div class="apexcharts-legend-series" rel="1" seriesname="Incorrectxaddress" data:collapsed="false" style="margin: 5px 15px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(40, 199, 111) !important; color: rgb(40, 199, 111); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Incorrect%20address" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 13px; font-weight: 400; font-family:  Public Sans ;">Incorrect address</span></div>
                  <div class="apexcharts-legend-series" rel="2" seriesname="Weatherxconditions" data:collapsed="false" style="margin: 5px 15px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgba(40, 199, 111, 0.7) !important; color: rgba(40, 199, 111, 0.7); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Weather%20conditions" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 13px; font-weight: 400; font-family:  Public Sans ;">Weather conditions</span></div>
                  <div class="apexcharts-legend-series" rel="3" seriesname="FederalxHolidays" data:collapsed="false" style="margin: 5px 15px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgba(40, 199, 111, 0.5) !important; color: rgba(40, 199, 111, 0.5); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Federal%20Holidays" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 13px; font-weight: 400; font-family:  Public Sans ;">Federal Holidays</span></div>
                  <div class="apexcharts-legend-series" rel="4" seriesname="Damagexduringxtransit" data:collapsed="false" style="margin: 5px 15px;"><span class="apexcharts-legend-marker" rel="4" data:collapsed="false" style="background: rgba(40, 199, 111, 0.16) !important; color: rgba(40, 199, 111, 0.16); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="4" i="3" data:default-text="Damage%20during%20transit" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 13px; font-weight: 400; font-family:  Public Sans ;">Damage during transit</span></div>
                </div>
                <style type="text/css">
                  .apexcharts-legend {
                    display: flex;
                    overflow: auto;
                    padding: 0 10px;
                  }

                  .apexcharts-legend.apx-legend-position-bottom,
                  .apexcharts-legend.apx-legend-position-top {
                    flex-wrap: wrap
                  }

                  .apexcharts-legend.apx-legend-position-right,
                  .apexcharts-legend.apx-legend-position-left {
                    flex-direction: column;
                    bottom: 0;
                  }

                  .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                  .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                  .apexcharts-legend.apx-legend-position-right,
                  .apexcharts-legend.apx-legend-position-left {
                    justify-content: flex-start;
                  }

                  .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                  .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                    justify-content: center;
                  }

                  .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                  .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                    justify-content: flex-end;
                  }

                  .apexcharts-legend-series {
                    cursor: pointer;
                    line-height: normal;
                  }

                  .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                  .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                    display: flex;
                    align-items: center;
                  }

                  .apexcharts-legend-text {
                    position: relative;
                    font-size: 14px;
                  }

                  .apexcharts-legend-text *,
                  .apexcharts-legend-marker * {
                    pointer-events: none;
                  }

                  .apexcharts-legend-marker {
                    position: relative;
                    display: inline-block;
                    cursor: pointer;
                    margin-right: 3px;
                    border-style: solid;
                  }

                  .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                  .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                    display: inline-block;
                  }

                  .apexcharts-legend-series.apexcharts-no-click {
                    cursor: auto;
                  }

                  .apexcharts-legend .apexcharts-hidden-zero-series,
                  .apexcharts-legend .apexcharts-hidden-null-series {
                    display: none !important;
                  }

                  .apexcharts-inactive-legend {
                    opacity: 0.45;
                  }
                </style>
              </foreignObject>
              <g id="SvgjsG1405" class="apexcharts-inner apexcharts-graphical" transform="translate(12, 15)">
                <defs id="SvgjsDefs1404">
                  <clipPath id="gridRectMaskn3u8vrqkg">
                    <rect id="SvgjsRect1407" width="379" height="309" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                  </clipPath>
                  <clipPath id="forecastMaskn3u8vrqkg"></clipPath>
                  <clipPath id="nonForecastMaskn3u8vrqkg"></clipPath>
                  <clipPath id="gridRectMarkerMaskn3u8vrqkg">
                    <rect id="SvgjsRect1408" width="379" height="313" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                  </clipPath>
                </defs>
                <g id="SvgjsG1409" class="apexcharts-pie">
                  <g id="SvgjsG1410" transform="translate(0, 0) scale(1)">
                    <circle id="SvgjsCircle1411" r="112.98341463414636" cx="187.5" cy="154.5" fill="transparent"></circle>
                    <g id="SvgjsG1412" class="apexcharts-slices">
                      <g id="SvgjsG1413" class="apexcharts-series apexcharts-pie-series" seriesName="Incorrectxaddress" rel="1" data:realIndex="0">
                        <path id="SvgjsPath1414" d="M 187.5 7.768292682926813 A 146.7317073170732 146.7317073170732 0 0 1 294.4628112821271 54.05523440812216 L 269.8613646872379 77.15753049425406 A 112.98341463414636 112.98341463414636 0 0 0 187.5 41.51658536585364 L 187.5 7.768292682926813 z" fill="rgba(40,199,111,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="46.8" data:startAngle="0" data:strokeWidth="0" data:value="13" data:pathOrig="M 187.5 7.768292682926813 A 146.7317073170732 146.7317073170732 0 0 1 294.4628112821271 54.05523440812216 L 269.8613646872379 77.15753049425406 A 112.98341463414636 112.98341463414636 0 0 0 187.5 41.51658536585364 L 187.5 7.768292682926813 z"></path>
                      </g>
                      <g id="SvgjsG1415" class="apexcharts-series apexcharts-pie-series" seriesName="Weatherxconditions" rel="2" data:realIndex="1">
                        <path id="SvgjsPath1416" d="M 294.4628112821271 54.05523440812216 A 146.7317073170732 146.7317073170732 0 0 1 287.94476559187785 261.4628112821271 L 264.84246950574595 236.86136468723788 A 112.98341463414636 112.98341463414636 0 0 0 269.8613646872379 77.15753049425406 L 294.4628112821271 54.05523440812216 z" fill="#28c76fb3" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="90.00000000000001" data:startAngle="46.8" data:strokeWidth="0" data:value="25" data:pathOrig="M 294.4628112821271 54.05523440812216 A 146.7317073170732 146.7317073170732 0 0 1 287.94476559187785 261.4628112821271 L 264.84246950574595 236.86136468723788 A 112.98341463414636 112.98341463414636 0 0 0 269.8613646872379 77.15753049425406 L 294.4628112821271 54.05523440812216 z"></path>
                      </g>
                      <g id="SvgjsG1417" class="apexcharts-series apexcharts-pie-series" seriesName="FederalxHolidays" rel="3" data:realIndex="2">
                        <path id="SvgjsPath1418" d="M 287.94476559187785 261.4628112821271 A 146.7317073170732 146.7317073170732 0 0 1 101.25326639532882 273.208444833163 L 121.0900151244032 245.90550252153554 A 112.98341463414636 112.98341463414636 0 0 0 264.84246950574595 236.86136468723788 L 287.94476559187785 261.4628112821271 z" fill="#28c76f80" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="79.19999999999999" data:startAngle="136.8" data:strokeWidth="0" data:value="22" data:pathOrig="M 287.94476559187785 261.4628112821271 A 146.7317073170732 146.7317073170732 0 0 1 101.25326639532882 273.208444833163 L 121.0900151244032 245.90550252153554 A 112.98341463414636 112.98341463414636 0 0 0 264.84246950574595 236.86136468723788 L 287.94476559187785 261.4628112821271 z"></path>
                      </g>
                      <g id="SvgjsG1419" class="apexcharts-series apexcharts-pie-series" seriesName="Damagexduringxtransit" rel="4" data:realIndex="3">
                        <path id="SvgjsPath1420" d="M 101.25326639532882 273.208444833163 A 146.7317073170732 146.7317073170732 0 0 1 187.47439048603243 7.768294917778491 L 187.48028067424497 41.51658708668944 A 112.98341463414636 112.98341463414636 0 0 0 121.0900151244032 245.90550252153554 L 101.25326639532882 273.208444833163 z" fill="#28c76f29" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="144" data:startAngle="216" data:strokeWidth="0" data:value="40" data:pathOrig="M 101.25326639532882 273.208444833163 A 146.7317073170732 146.7317073170732 0 0 1 187.47439048603243 7.768294917778491 L 187.48028067424497 41.51658708668944 A 112.98341463414636 112.98341463414636 0 0 0 121.0900151244032 245.90550252153554 L 101.25326639532882 273.208444833163 z"></path>
                      </g>
                    </g>
                  </g>
                  <g id="SvgjsG1421" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"><text id="SvgjsText1422" font-family="Helvetica, Arial, sans-serif" x="187.5" y="174.5" text-anchor="middle" dominant-baseline="auto" font-size=".75rem" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;">AVG. Exceptions</text><text id="SvgjsText1423" font-family="Public Sans" x="187.5" y="140.5" text-anchor="middle" dominant-baseline="auto" font-size="26px" font-weight="500" fill="#5d596c" class="apexcharts-text apexcharts-datalabel-value" style="font-family:  Public Sans ;">30%</text></g>
                </g>
                <line id="SvgjsLine1424" x1="0" y1="0" x2="375" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                <line id="SvgjsLine1425" x1="0" y1="0" x2="375" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
              </g>
              <g id="SvgjsG1406" class="apexcharts-annotations"></g>
            </svg>
            <div class="apexcharts-tooltip apexcharts-theme-false">
              <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(40, 199, 111);"></span>
                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                  <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                  <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                  <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                </div>
              </div>
              <div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(40, 199, 111, 0.7);"></span>
                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                  <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                  <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                  <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                </div>
              </div>
              <div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(40, 199, 111, 0.5);"></span>
                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                  <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                  <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                  <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                </div>
              </div>
              <div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(40, 199, 111, 0.16);"></span>
                <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                  <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                  <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                  <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Reasons for delivery exceptions -->
  <!-- Orders by Countries -->
  <div class="col-md-6 col-xxl-4 mb-4 order-0 order-xxl-4">
    <div class="sidebar-card h-100">
      <div class="card-header d-flex justify-content-between pb-2">
        <div class="card-title mb-1">
          <h5 class="m-0 me-2">Leads Status</h5>
          <small class="text-muted">62 Leads in Progress</small>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
            <a class="dropdown-item" href="javascript:void(0);">Download</a>
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="nav-align-top">
          <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-new" aria-controls="navs-justified-new" aria-selected="true">New</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-preparing" aria-controls="navs-justified-link-preparing" aria-selected="false">Preparing</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-link-shipping" aria-controls="navs-justified-link-shipping" aria-selected="false">In Progress</button>
            </li>
          </ul>
          <div class="tab-content px-2 mx-1 pb-0">
            <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
              <ul class="timeline mb-0 pb-1">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Myrtle Ullrich</h6>
                    <p class="text-muted mb-0">101 Boulder, California(CA), 95959</p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Barry Schowalter</h6>
                    <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                  </div>
                </li>
              </ul>
              <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
              <ul class="timeline mb-0">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Veronica Herman</h6>
                    <p class="text-muted mb-0">162 Windsor, California(CA), 95492</p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Helen Jacobs</h6>
                    <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                  </div>
                </li>
              </ul>
            </div>

            <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
              <ul class="timeline mb-0 pb-1">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Barry Schowalter</h6>
                    <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Myrtle Ullrich</h6>
                    <p class="text-muted mb-0">101 Boulder, California(CA), 95959 </p>
                  </div>
                </li>
              </ul>
              <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
              <ul class="timeline mb-0">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Veronica Herman</h6>
                    <p class="text-muted mb-0">162 Windsor, California(CA), 95492</p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Helen Jacobs</h6>
                    <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
              <ul class="timeline mb-0 pb-1">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Veronica Herman</h6>
                    <p class="text-muted mb-0">101 Boulder, California(CA), 95959</p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Barry Schowalter</h6>
                    <p class="text-muted mb-0">939 Orange, California(CA), 92118</p>
                  </div>
                </li>
              </ul>
              <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
              <ul class="timeline mb-0">
                <li class="timeline-item ps-4 border-left-dashed pb-1">
                  <span class="timeline-indicator-advanced timeline-indicator-success">
                    <i class="ti ti-circle-check"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-success text-uppercase fw-medium">sender</small>
                    </div>
                    <h6 class="mb-1">Myrtle Ullrich</h6>
                    <p class="text-muted mb-0">162 Windsor, California(CA), 95492 </p>
                  </div>
                </li>
                <li class="timeline-item ps-4 border-transparent">
                  <span class="timeline-indicator-advanced timeline-indicator-primary">
                    <i class="ti ti-map-pin"></i>
                  </span>
                  <div class="timeline-event px-0 pb-0">
                    <div class="timeline-header">
                      <small class="text-primary text-uppercase fw-medium">Receiver</small>
                    </div>
                    <h6 class="mb-1">Helen Jacobs</h6>
                    <p class="text-muted mb-0">487 Sunset, California(CA), 94043</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Orders by Countries -->
</div>

<!-- Shipment statistics-->
<div class="col-lg-6 col-xxl-6 mb-4 order-3 order-xxl-1">
  <div class="sidebar-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="card-title mb-0">
        <h5 class="m-0 me-2">Statistics</h5>
        <small class="text-muted">Total number of leads 23.8k</small>
      </div>
      <div class="dropdown">
        <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">January</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="javascript:void(0);">January</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">February</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">March</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">April</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">May</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">June</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">July</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">August</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">September</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">October</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">November</a></li>
          <li><a class="dropdown-item" href="javascript:void(0);">December</a></li>
        </ul>
      </div>
    </div>
    <div class="card-body" style="position: relative;">
      <div id="shipmentStatisticsChart" style="min-height: 270px;">
        <div id="apexchartsfdw455g6" class="apexcharts-canvas apexchartsfdw455g6 apexcharts-theme-light" style="width: 631px; height: 270px;"><svg id="SvgjsSvg1286" width="631" height="270" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
            <foreignObject x="0" y="0" width="631" height="270">
              <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="height: 40px; inset: auto 0px -5px; position: absolute;">
                <div class="apexcharts-legend-series" rel="1" seriesname="Shipment" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(255, 159, 67) !important; color: rgb(255, 159, 67); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Shipment" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 15px; font-weight: 400; font-family:  Public Sans ;">Shipment</span></div>
                <div class="apexcharts-legend-series" rel="2" seriesname="Delivery" data:collapsed="false" style="margin: 0px 10px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(115, 103, 240) !important; color: rgb(115, 103, 240); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Delivery" data:collapsed="false" style="color: rgb(93, 89, 108); font-size: 15px; font-weight: 400; font-family:  Public Sans ;">Delivery</span></div>
              </div>
            </foreignObject>
            <g id="SvgjsG1288" class="apexcharts-inner apexcharts-graphical" transform="translate(76.16146316528321, 30)">
              <defs id="SvgjsDefs1287">
                <clipPath id="gridRectMaskfdw455g6">
                  <rect id="SvgjsRect1294" width="552.3907852172852" height="164.269332818985" x="-20.61979522705078" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                </clipPath>
                <clipPath id="forecastMaskfdw455g6"></clipPath>
                <clipPath id="nonForecastMaskfdw455g6"></clipPath>
                <clipPath id="gridRectMarkerMaskfdw455g6">
                  <rect id="SvgjsRect1295" width="531.1511947631836" height="181.269332818985" x="-10" y="-10" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                </clipPath>
              </defs>
              <line id="SvgjsLine1293" x1="-0.5" y1="0" x2="-0.5" y2="161.269332818985" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="-0.5" y="0" width="1" height="161.269332818985" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
              <g id="SvgjsG1344" class="apexcharts-xaxis" transform="translate(0, 0)">
                <g id="SvgjsG1345" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1347" font-family="Public Sans" x="0" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1348">1 Jan</tspan>
                    <title>1 Jan</title>
                  </text><text id="SvgjsText1350" font-family="Public Sans" x="56.794577195909284" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1351">2 Jan</tspan>
                    <title>2 Jan</title>
                  </text><text id="SvgjsText1353" font-family="Public Sans" x="113.58915439181855" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1354">3 Jan</tspan>
                    <title>3 Jan</title>
                  </text><text id="SvgjsText1356" font-family="Public Sans" x="170.38373158772782" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1357">4 Jan</tspan>
                    <title>4 Jan</title>
                  </text><text id="SvgjsText1359" font-family="Public Sans" x="227.17830878363714" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1360">5 Jan</tspan>
                    <title>5 Jan</title>
                  </text><text id="SvgjsText1362" font-family="Public Sans" x="283.97288597954645" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1363">6 Jan</tspan>
                    <title>6 Jan</title>
                  </text><text id="SvgjsText1365" font-family="Public Sans" x="340.7674631754557" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1366">7 Jan</tspan>
                    <title>7 Jan</title>
                  </text><text id="SvgjsText1368" font-family="Public Sans" x="397.56204037136496" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1369">8 Jan</tspan>
                    <title>8 Jan</title>
                  </text><text id="SvgjsText1371" font-family="Public Sans" x="454.3566175672742" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1372">9 Jan</tspan>
                    <title>9 Jan</title>
                  </text><text id="SvgjsText1374" font-family="Public Sans" x="511.15119476318347" y="190.269332818985" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-xaxis-label " style="font-family:  Public Sans ;">
                    <tspan id="SvgjsTspan1375">10 Jan</tspan>
                    <title>10 Jan</title>
                  </text></g>
              </g>
              <g id="SvgjsG1388" class="apexcharts-grid">
                <g id="SvgjsG1389" class="apexcharts-gridlines-horizontal">
                  <line id="SvgjsLine1391" x1="-17.11979522705078" y1="0" x2="528.2709899902344" y2="0" stroke="#e0e0e0" stroke-dasharray="8" stroke-linecap="butt" class="apexcharts-gridline"></line>
                  <line id="SvgjsLine1392" x1="-17.11979522705078" y1="40.31733320474625" x2="528.2709899902344" y2="40.31733320474625" stroke="#e0e0e0" stroke-dasharray="8" stroke-linecap="butt" class="apexcharts-gridline"></line>
                  <line id="SvgjsLine1393" x1="-17.11979522705078" y1="80.6346664094925" x2="528.2709899902344" y2="80.6346664094925" stroke="#e0e0e0" stroke-dasharray="8" stroke-linecap="butt" class="apexcharts-gridline"></line>
                  <line id="SvgjsLine1394" x1="-17.11979522705078" y1="120.95199961423874" x2="528.2709899902344" y2="120.95199961423874" stroke="#e0e0e0" stroke-dasharray="8" stroke-linecap="butt" class="apexcharts-gridline"></line>
                  <line id="SvgjsLine1395" x1="-17.11979522705078" y1="161.269332818985" x2="528.2709899902344" y2="161.269332818985" stroke="#e0e0e0" stroke-dasharray="8" stroke-linecap="butt" class="apexcharts-gridline"></line>
                </g>
                <g id="SvgjsG1390" class="apexcharts-gridlines-vertical"></g>
                <line id="SvgjsLine1397" x1="0" y1="161.269332818985" x2="511.1511947631836" y2="161.269332818985" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                <line id="SvgjsLine1396" x1="0" y1="1" x2="0" y2="161.269332818985" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
              </g>
              <g id="SvgjsG1296" class="apexcharts-bar-series apexcharts-plot-series">
                <g id="SvgjsG1297" class="apexcharts-series" rel="1" seriesName="Shipment" data:realIndex="0">
                  <path id="SvgjsPath1301" d="M -8.519186579386394 197.58666602373125L -8.519186579386394 52.38079984569552Q -8.519186579386394 48.38079984569552 -4.519186579386394 48.38079984569552L 4.519186579386394 48.38079984569552Q 8.519186579386394 48.38079984569552 8.519186579386394 52.38079984569552L 8.519186579386394 52.38079984569552L 8.519186579386394 197.58666602373125Q 8.519186579386394 201.58666602373125 4.519186579386394 201.58666602373125L -4.519186579386394 201.58666602373125Q -8.519186579386394 201.58666602373125 -8.519186579386394 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M -8.519186579386394 197.58666602373125L -8.519186579386394 52.38079984569552Q -8.519186579386394 48.38079984569552 -4.519186579386394 48.38079984569552L 4.519186579386394 48.38079984569552Q 8.519186579386394 48.38079984569552 8.519186579386394 52.38079984569552L 8.519186579386394 52.38079984569552L 8.519186579386394 197.58666602373125Q 8.519186579386394 201.58666602373125 4.519186579386394 201.58666602373125L -4.519186579386394 201.58666602373125Q -8.519186579386394 201.58666602373125 -8.519186579386394 197.58666602373125z" pathFrom="M -8.519186579386394 197.58666602373125L -8.519186579386394 197.58666602373125L 8.519186579386394 197.58666602373125L 8.519186579386394 197.58666602373125L 8.519186579386394 197.58666602373125L 8.519186579386394 197.58666602373125L 8.519186579386394 197.58666602373125L -8.519186579386394 197.58666602373125" cy="48.38079984569552" cx="8.519186579386394" j="0" val="38" barHeight="153.20586617803573" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1303" d="M 48.2753906165229 197.58666602373125L 48.2753906165229 24.15866660237313Q 48.2753906165229 20.15866660237313 52.2753906165229 20.15866660237313L 61.31376377529568 20.15866660237313Q 65.31376377529568 20.15866660237313 65.31376377529568 24.15866660237313L 65.31376377529568 24.15866660237313L 65.31376377529568 197.58666602373125Q 65.31376377529568 201.58666602373125 61.31376377529568 201.58666602373125L 52.2753906165229 201.58666602373125Q 48.2753906165229 201.58666602373125 48.2753906165229 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 48.2753906165229 197.58666602373125L 48.2753906165229 24.15866660237313Q 48.2753906165229 20.15866660237313 52.2753906165229 20.15866660237313L 61.31376377529568 20.15866660237313Q 65.31376377529568 20.15866660237313 65.31376377529568 24.15866660237313L 65.31376377529568 24.15866660237313L 65.31376377529568 197.58666602373125Q 65.31376377529568 201.58666602373125 61.31376377529568 201.58666602373125L 52.2753906165229 201.58666602373125Q 48.2753906165229 201.58666602373125 48.2753906165229 197.58666602373125z" pathFrom="M 48.2753906165229 197.58666602373125L 48.2753906165229 197.58666602373125L 65.31376377529568 197.58666602373125L 65.31376377529568 197.58666602373125L 65.31376377529568 197.58666602373125L 65.31376377529568 197.58666602373125L 65.31376377529568 197.58666602373125L 48.2753906165229 197.58666602373125" cy="20.15866660237313" cx="65.31376377529568" j="1" val="45" barHeight="181.42799942135812" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1305" d="M 105.06996781243218 197.58666602373125L 105.06996781243218 72.53946644806862Q 105.06996781243218 68.53946644806862 109.06996781243218 68.53946644806862L 118.10834097120497 68.53946644806862Q 122.10834097120497 68.53946644806862 122.10834097120497 72.53946644806862L 122.10834097120497 72.53946644806862L 122.10834097120497 197.58666602373125Q 122.10834097120497 201.58666602373125 118.10834097120497 201.58666602373125L 109.06996781243218 201.58666602373125Q 105.06996781243218 201.58666602373125 105.06996781243218 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 105.06996781243218 197.58666602373125L 105.06996781243218 72.53946644806862Q 105.06996781243218 68.53946644806862 109.06996781243218 68.53946644806862L 118.10834097120497 68.53946644806862Q 122.10834097120497 68.53946644806862 122.10834097120497 72.53946644806862L 122.10834097120497 72.53946644806862L 122.10834097120497 197.58666602373125Q 122.10834097120497 201.58666602373125 118.10834097120497 201.58666602373125L 109.06996781243218 201.58666602373125Q 105.06996781243218 201.58666602373125 105.06996781243218 197.58666602373125z" pathFrom="M 105.06996781243218 197.58666602373125L 105.06996781243218 197.58666602373125L 122.10834097120497 197.58666602373125L 122.10834097120497 197.58666602373125L 122.10834097120497 197.58666602373125L 122.10834097120497 197.58666602373125L 122.10834097120497 197.58666602373125L 105.06996781243218 197.58666602373125" cy="68.53946644806862" cx="122.10834097120497" j="2" val="33" barHeight="133.04719957566263" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1307" d="M 161.86454500834145 197.58666602373125L 161.86454500834145 52.38079984569552Q 161.86454500834145 48.38079984569552 165.86454500834145 48.38079984569552L 174.90291816711425 48.38079984569552Q 178.90291816711425 48.38079984569552 178.90291816711425 52.38079984569552L 178.90291816711425 52.38079984569552L 178.90291816711425 197.58666602373125Q 178.90291816711425 201.58666602373125 174.90291816711425 201.58666602373125L 165.86454500834145 201.58666602373125Q 161.86454500834145 201.58666602373125 161.86454500834145 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 161.86454500834145 197.58666602373125L 161.86454500834145 52.38079984569552Q 161.86454500834145 48.38079984569552 165.86454500834145 48.38079984569552L 174.90291816711425 48.38079984569552Q 178.90291816711425 48.38079984569552 178.90291816711425 52.38079984569552L 178.90291816711425 52.38079984569552L 178.90291816711425 197.58666602373125Q 178.90291816711425 201.58666602373125 174.90291816711425 201.58666602373125L 165.86454500834145 201.58666602373125Q 161.86454500834145 201.58666602373125 161.86454500834145 197.58666602373125z" pathFrom="M 161.86454500834145 197.58666602373125L 161.86454500834145 197.58666602373125L 178.90291816711425 197.58666602373125L 178.90291816711425 197.58666602373125L 178.90291816711425 197.58666602373125L 178.90291816711425 197.58666602373125L 178.90291816711425 197.58666602373125L 161.86454500834145 197.58666602373125" cy="48.38079984569552" cx="178.90291816711425" j="3" val="38" barHeight="153.20586617803573" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1309" d="M 218.65912220425076 197.58666602373125L 218.65912220425076 76.57119976854327Q 218.65912220425076 72.57119976854327 222.65912220425076 72.57119976854327L 231.69749536302356 72.57119976854327Q 235.69749536302356 72.57119976854327 235.69749536302356 76.57119976854327L 235.69749536302356 76.57119976854327L 235.69749536302356 197.58666602373125Q 235.69749536302356 201.58666602373125 231.69749536302356 201.58666602373125L 222.65912220425076 201.58666602373125Q 218.65912220425076 201.58666602373125 218.65912220425076 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 218.65912220425076 197.58666602373125L 218.65912220425076 76.57119976854327Q 218.65912220425076 72.57119976854327 222.65912220425076 72.57119976854327L 231.69749536302356 72.57119976854327Q 235.69749536302356 72.57119976854327 235.69749536302356 76.57119976854327L 235.69749536302356 76.57119976854327L 235.69749536302356 197.58666602373125Q 235.69749536302356 201.58666602373125 231.69749536302356 201.58666602373125L 222.65912220425076 201.58666602373125Q 218.65912220425076 201.58666602373125 218.65912220425076 197.58666602373125z" pathFrom="M 218.65912220425076 197.58666602373125L 218.65912220425076 197.58666602373125L 235.69749536302356 197.58666602373125L 235.69749536302356 197.58666602373125L 235.69749536302356 197.58666602373125L 235.69749536302356 197.58666602373125L 235.69749536302356 197.58666602373125L 218.65912220425076 197.58666602373125" cy="72.57119976854327" cx="235.69749536302356" j="4" val="32" barHeight="129.015466255188" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1311" d="M 275.4536994001601 197.58666602373125L 275.4536994001601 4Q 275.4536994001601 0 279.4536994001601 0L 288.4920725589329 0Q 292.4920725589329 0 292.4920725589329 4L 292.4920725589329 4L 292.4920725589329 197.58666602373125Q 292.4920725589329 201.58666602373125 288.4920725589329 201.58666602373125L 279.4536994001601 201.58666602373125Q 275.4536994001601 201.58666602373125 275.4536994001601 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 275.4536994001601 197.58666602373125L 275.4536994001601 4Q 275.4536994001601 0 279.4536994001601 0L 288.4920725589329 0Q 292.4920725589329 0 292.4920725589329 4L 292.4920725589329 4L 292.4920725589329 197.58666602373125Q 292.4920725589329 201.58666602373125 288.4920725589329 201.58666602373125L 279.4536994001601 201.58666602373125Q 275.4536994001601 201.58666602373125 275.4536994001601 197.58666602373125z" pathFrom="M 275.4536994001601 197.58666602373125L 275.4536994001601 197.58666602373125L 292.4920725589329 197.58666602373125L 292.4920725589329 197.58666602373125L 292.4920725589329 197.58666602373125L 292.4920725589329 197.58666602373125L 292.4920725589329 197.58666602373125L 275.4536994001601 197.58666602373125" cy="0" cx="292.4920725589329" j="5" val="50" barHeight="201.58666602373125" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1313" d="M 332.24827659606933 197.58666602373125L 332.24827659606933 12.063466640949258Q 332.24827659606933 8.063466640949258 336.24827659606933 8.063466640949258L 345.28664975484213 8.063466640949258Q 349.28664975484213 8.063466640949258 349.28664975484213 12.063466640949258L 349.28664975484213 12.063466640949258L 349.28664975484213 197.58666602373125Q 349.28664975484213 201.58666602373125 345.28664975484213 201.58666602373125L 336.24827659606933 201.58666602373125Q 332.24827659606933 201.58666602373125 332.24827659606933 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 332.24827659606933 197.58666602373125L 332.24827659606933 12.063466640949258Q 332.24827659606933 8.063466640949258 336.24827659606933 8.063466640949258L 345.28664975484213 8.063466640949258Q 349.28664975484213 8.063466640949258 349.28664975484213 12.063466640949258L 349.28664975484213 12.063466640949258L 349.28664975484213 197.58666602373125Q 349.28664975484213 201.58666602373125 345.28664975484213 201.58666602373125L 336.24827659606933 201.58666602373125Q 332.24827659606933 201.58666602373125 332.24827659606933 197.58666602373125z" pathFrom="M 332.24827659606933 197.58666602373125L 332.24827659606933 197.58666602373125L 349.28664975484213 197.58666602373125L 349.28664975484213 197.58666602373125L 349.28664975484213 197.58666602373125L 349.28664975484213 197.58666602373125L 349.28664975484213 197.58666602373125L 332.24827659606933 197.58666602373125" cy="8.063466640949258" cx="349.28664975484213" j="6" val="48" barHeight="193.523199382782" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1315" d="M 389.04285379197864 197.58666602373125L 389.04285379197864 44.31733320474626Q 389.04285379197864 40.31733320474626 393.04285379197864 40.31733320474626L 402.08122695075144 40.31733320474626Q 406.08122695075144 40.31733320474626 406.08122695075144 44.31733320474626L 406.08122695075144 44.31733320474626L 406.08122695075144 197.58666602373125Q 406.08122695075144 201.58666602373125 402.08122695075144 201.58666602373125L 393.04285379197864 201.58666602373125Q 389.04285379197864 201.58666602373125 389.04285379197864 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 389.04285379197864 197.58666602373125L 389.04285379197864 44.31733320474626Q 389.04285379197864 40.31733320474626 393.04285379197864 40.31733320474626L 402.08122695075144 40.31733320474626Q 406.08122695075144 40.31733320474626 406.08122695075144 44.31733320474626L 406.08122695075144 44.31733320474626L 406.08122695075144 197.58666602373125Q 406.08122695075144 201.58666602373125 402.08122695075144 201.58666602373125L 393.04285379197864 201.58666602373125Q 389.04285379197864 201.58666602373125 389.04285379197864 197.58666602373125z" pathFrom="M 389.04285379197864 197.58666602373125L 389.04285379197864 197.58666602373125L 406.08122695075144 197.58666602373125L 406.08122695075144 197.58666602373125L 406.08122695075144 197.58666602373125L 406.08122695075144 197.58666602373125L 406.08122695075144 197.58666602373125L 389.04285379197864 197.58666602373125" cy="40.31733320474626" cx="406.08122695075144" j="7" val="40" barHeight="161.269332818985" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1317" d="M 445.83743098788796 197.58666602373125L 445.83743098788796 36.253866563797004Q 445.83743098788796 32.253866563797004 449.83743098788796 32.253866563797004L 458.87580414666076 32.253866563797004Q 462.87580414666076 32.253866563797004 462.87580414666076 36.253866563797004L 462.87580414666076 36.253866563797004L 462.87580414666076 197.58666602373125Q 462.87580414666076 201.58666602373125 458.87580414666076 201.58666602373125L 449.83743098788796 201.58666602373125Q 445.83743098788796 201.58666602373125 445.83743098788796 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 445.83743098788796 197.58666602373125L 445.83743098788796 36.253866563797004Q 445.83743098788796 32.253866563797004 449.83743098788796 32.253866563797004L 458.87580414666076 32.253866563797004Q 462.87580414666076 32.253866563797004 462.87580414666076 36.253866563797004L 462.87580414666076 36.253866563797004L 462.87580414666076 197.58666602373125Q 462.87580414666076 201.58666602373125 458.87580414666076 201.58666602373125L 449.83743098788796 201.58666602373125Q 445.83743098788796 201.58666602373125 445.83743098788796 197.58666602373125z" pathFrom="M 445.83743098788796 197.58666602373125L 445.83743098788796 197.58666602373125L 462.87580414666076 197.58666602373125L 462.87580414666076 197.58666602373125L 462.87580414666076 197.58666602373125L 462.87580414666076 197.58666602373125L 462.87580414666076 197.58666602373125L 445.83743098788796 197.58666602373125" cy="32.253866563797004" cx="462.87580414666076" j="8" val="42" barHeight="169.33279945993425" barWidth="17.03837315877279"></path>
                  <path id="SvgjsPath1319" d="M 502.6320081837972 197.58666602373125L 502.6320081837972 56.412533166170135Q 502.6320081837972 52.412533166170135 506.6320081837972 52.412533166170135L 515.67038134257 52.412533166170135Q 519.67038134257 52.412533166170135 519.67038134257 56.412533166170135L 519.67038134257 56.412533166170135L 519.67038134257 197.58666602373125Q 519.67038134257 201.58666602373125 515.67038134257 201.58666602373125L 506.6320081837972 201.58666602373125Q 502.6320081837972 201.58666602373125 502.6320081837972 197.58666602373125z" fill="rgba(255,159,67,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 502.6320081837972 197.58666602373125L 502.6320081837972 56.412533166170135Q 502.6320081837972 52.412533166170135 506.6320081837972 52.412533166170135L 515.67038134257 52.412533166170135Q 519.67038134257 52.412533166170135 519.67038134257 56.412533166170135L 519.67038134257 56.412533166170135L 519.67038134257 197.58666602373125Q 519.67038134257 201.58666602373125 515.67038134257 201.58666602373125L 506.6320081837972 201.58666602373125Q 502.6320081837972 201.58666602373125 502.6320081837972 197.58666602373125z" pathFrom="M 502.6320081837972 197.58666602373125L 502.6320081837972 197.58666602373125L 519.67038134257 197.58666602373125L 519.67038134257 197.58666602373125L 519.67038134257 197.58666602373125L 519.67038134257 197.58666602373125L 519.67038134257 197.58666602373125L 502.6320081837972 197.58666602373125" cy="52.412533166170135" cx="519.67038134257" j="9" val="37" barHeight="149.17413285756112" barWidth="17.03837315877279"></path>
                  <g id="SvgjsG1299" class="apexcharts-bar-goals-markers" style="pointer-events: none">
                    <g id="SvgjsG1300" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1302" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1304" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1306" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1308" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1310" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1312" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1314" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1316" className="apexcharts-bar-goals-groups"></g>
                    <g id="SvgjsG1318" className="apexcharts-bar-goals-groups"></g>
                  </g>
                </g>
              </g>
              <g id="SvgjsG1320" class="apexcharts-line-series apexcharts-plot-series">
                <g id="SvgjsG1321" class="apexcharts-series" seriesName="Delivery" data:longestSeries="true" rel="1" data:realIndex="1">
                  <path id="SvgjsPath1343" d="M 0 108.85679965281489C 19.87810201856825 108.85679965281489 36.91647517734104 88.69813305044175 56.79457719590929 88.69813305044175C 76.67267921447754 88.69813305044175 93.71105237325034 108.85679965281489 113.58915439181858 108.85679965281489C 133.46725641038682 108.85679965281489 150.50562956915962 72.57119976854327 170.38373158772785 72.57119976854327C 190.2618336062961 72.57119976854327 207.3002067650689 88.69813305044175 227.17830878363716 88.69813305044175C 247.05641080220542 88.69813305044175 264.0947839609782 24.190399922847746 283.97288597954645 24.190399922847746C 303.8509879981147 24.190399922847746 320.88936115688745 72.57119976854327 340.7674631754557 72.57119976854327C 360.64556519402396 72.57119976854327 377.68393835279676 48.38079984569552 397.562040371365 48.38079984569552C 417.44014238993327 48.38079984569552 434.47851554870607 96.76159969139101 454.3566175672743 96.76159969139101C 474.2347195858426 96.76159969139101 491.2730927446153 64.50773312759401 511.1511947631836 64.50773312759401" fill="none" fill-opacity="1" stroke="rgba(115,103,240,1)" stroke-opacity="1" stroke-linecap="round" stroke-width="3" stroke-dasharray="0" class="apexcharts-line" index="1" clip-path="url(#gridRectMaskfdw455g6)" pathTo="M 0 108.85679965281489C 19.87810201856825 108.85679965281489 36.91647517734104 88.69813305044175 56.79457719590929 88.69813305044175C 76.67267921447754 88.69813305044175 93.71105237325034 108.85679965281489 113.58915439181858 108.85679965281489C 133.46725641038682 108.85679965281489 150.50562956915962 72.57119976854327 170.38373158772785 72.57119976854327C 190.2618336062961 72.57119976854327 207.3002067650689 88.69813305044175 227.17830878363716 88.69813305044175C 247.05641080220542 88.69813305044175 264.0947839609782 24.190399922847746 283.97288597954645 24.190399922847746C 303.8509879981147 24.190399922847746 320.88936115688745 72.57119976854327 340.7674631754557 72.57119976854327C 360.64556519402396 72.57119976854327 377.68393835279676 48.38079984569552 397.562040371365 48.38079984569552C 417.44014238993327 48.38079984569552 434.47851554870607 96.76159969139101 454.3566175672743 96.76159969139101C 474.2347195858426 96.76159969139101 491.2730927446153 64.50773312759401 511.1511947631836 64.50773312759401" pathFrom="M -1 201.58666602373125L -1 201.58666602373125L 56.79457719590929 201.58666602373125L 113.58915439181858 201.58666602373125L 170.38373158772785 201.58666602373125L 227.17830878363716 201.58666602373125L 283.97288597954645 201.58666602373125L 340.7674631754557 201.58666602373125L 397.562040371365 201.58666602373125L 454.3566175672743 201.58666602373125L 511.1511947631836 201.58666602373125"></path>
                  <g id="SvgjsG1322" class="apexcharts-series-markers-wrap" data:realIndex="1">
                    <g id="SvgjsG1324" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1325" r="4" cx="0" cy="108.85679965281489" class="apexcharts-marker wf9a4bhkl" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="0" j="0" index="1" default-marker-size="4"></circle>
                      <circle id="SvgjsCircle1326" r="4" cx="56.79457719590929" cy="88.69813305044175" class="apexcharts-marker w7g0dmnic" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="1" j="1" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1327" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1328" r="4" cx="113.58915439181858" cy="108.85679965281489" class="apexcharts-marker wdy5bl58j" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="2" j="2" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1329" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1330" r="4" cx="170.38373158772785" cy="72.57119976854327" class="apexcharts-marker wqd40uy1d" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="3" j="3" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1331" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1332" r="4" cx="227.17830878363716" cy="88.69813305044175" class="apexcharts-marker w9r2r2yo1" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="4" j="4" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1333" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1334" r="4" cx="283.97288597954645" cy="24.190399922847746" class="apexcharts-marker w3vd0gmbd" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="5" j="5" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1335" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1336" r="4" cx="340.7674631754557" cy="72.57119976854327" class="apexcharts-marker wwavtxv6e" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="6" j="6" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1337" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1338" r="4" cx="397.562040371365" cy="48.38079984569552" class="apexcharts-marker wsuhuck3v" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="7" j="7" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1339" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1340" r="4" cx="454.3566175672743" cy="96.76159969139101" class="apexcharts-marker wa9s5rxd9" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="8" j="8" index="1" default-marker-size="4"></circle>
                    </g>
                    <g id="SvgjsG1341" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskfdw455g6)">
                      <circle id="SvgjsCircle1342" r="4" cx="511.1511947631836" cy="64.50773312759401" class="apexcharts-marker wqoe6ly91j" stroke="#7367f0" fill="#ffffff" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="9" j="9" index="1" default-marker-size="4"></circle>
                    </g>
                  </g>
                </g>
                <g id="SvgjsG1298" class="apexcharts-datalabels" data:realIndex="0"></g>
                <g id="SvgjsG1323" class="apexcharts-datalabels" data:realIndex="1"></g>
              </g>
              <line id="SvgjsLine1398" x1="-17.11979522705078" y1="0" x2="528.2709899902344" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
              <line id="SvgjsLine1399" x1="-17.11979522705078" y1="0" x2="528.2709899902344" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
              <g id="SvgjsG1400" class="apexcharts-yaxis-annotations"></g>
              <g id="SvgjsG1401" class="apexcharts-xaxis-annotations"></g>
              <g id="SvgjsG1402" class="apexcharts-point-annotations"></g>
            </g>
            <rect id="SvgjsRect1292" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
            <g id="SvgjsG1376" class="apexcharts-yaxis" rel="0" transform="translate(25.041667938232422, 0)">
              <g id="SvgjsG1377" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1378" font-family="Public Sans" x="20" y="31.4" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family:  Public Sans ;">
                  <tspan id="SvgjsTspan1379">50%</tspan>
                  <title>50%</title>
                </text><text id="SvgjsText1380" font-family="Public Sans" x="20" y="71.71733320474625" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family:  Public Sans ;">
                  <tspan id="SvgjsTspan1381">40%</tspan>
                  <title>40%</title>
                </text><text id="SvgjsText1382" font-family="Public Sans" x="20" y="112.0346664094925" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family:  Public Sans ;">
                  <tspan id="SvgjsTspan1383">30%</tspan>
                  <title>30%</title>
                </text><text id="SvgjsText1384" font-family="Public Sans" x="20" y="152.35199961423874" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family:  Public Sans ;">
                  <tspan id="SvgjsTspan1385">20%</tspan>
                  <title>20%</title>
                </text><text id="SvgjsText1386" font-family="Public Sans" x="20" y="192.669332818985" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#a5a3ae" class="apexcharts-text apexcharts-yaxis-label " style="font-family:  Public Sans ;">
                  <tspan id="SvgjsTspan1387">10%</tspan>
                  <title>10%</title>
                </text></g>
            </g>
            <g id="SvgjsG1289" class="apexcharts-annotations"></g>
          </svg>
          <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 82.1615px; top: 110.13px;">
            <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">1 Jan</div>
            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 159, 67);"></span>
              <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Shipment: </span><span class="apexcharts-tooltip-text-y-value">38%</span></div>
                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
              </div>
            </div>
            <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 2; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(115, 103, 240);"></span>
              <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">Delivery: </span><span class="apexcharts-tooltip-text-y-value">23%</span></div>
                <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
              </div>
            </div>
          </div>
          <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 47.1458px; top: 193.269px;">
            <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 36.6979px;">1 Jan</div>
          </div>
          <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
            <div class="apexcharts-yaxistooltip-text"></div>
          </div>
        </div>
      </div>
      <div class="resize-triggers">
        <div class="expand-trigger">
          <div style="width: 680px; height: 295px;"></div>
        </div>
        <div class="contract-trigger"></div>
      </div>
    </div>
  </div>
</div><!--/ Shipment statistics -->

</div>

@endsection