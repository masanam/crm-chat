@php

$user = \App\Models\User::find(request()->user()->id);
$profile = \App\Models\Profile::find($user->profile_id);
$client = \App\Models\Client::find($profile->client_id);

@endphp

<section class="tab-pane fade tab-billing w-100" id="billing" role="tabpanel">
  <nav class="border-bottom">
    <ul class="nav nav-tabs tabs-crm" id="nav-tabs-billing" role="tablist">
      @foreach($tabsBilling as $key => $value)
          <li class="nav-item" role="presentation">
              <button
                class="nav-link fw-semibold {{ $key === 0 ? 'active' : '' }}"
                role="tab"
                data-bs-toggle="tab"
                data-bs-target="#{{ $value->key }}"
                aria-controls="{{ $value->key }}"
                aria-selected="true"
              >
                {{ $value->title }}
              </button>
          </li>
      @endforeach
    </ul>
  </nav>
  <div class="tab-content tab-billing-content">
    <section class="tab-pane fade tab-payment-method active show" id="payment-method" role="tabpanel">
      <x-table
        title="Payment Methods"
        badge="2 teams"
        buttonHeaderName="Add Payment Method"
        buttonHeaderTarget="add-payment-method"
        :headers="$headersBilling"
      >
        @foreach($listDataBilling as $key => $value)
        <tr class="wrapper-row">
          <td>
            <div class="d-flex gap-4 align-items-center">
              <label class="switch switch-primary">
                <input type="checkbox" class="switch-input" checked />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
              </label>
              <div class="d-flex align-items-center gap-3 wrapper-payment">
                <div class="wrapper-payment-icon">
                  <img src="{{ $value->img }}" alt="icon">
                </div>
                <div class="d-flex flex-column">
                  <span class="text-sm text-dark text-truncate">{{ $value->title }}</span>
                  <span class="text-sm text-subtitle text-truncate">{{ $value->subtitle }}</span>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div class="d-inline-block">
              <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="text-dark ti ti-trash"></i>
              </a>
            </div>
            <a
              href="javascript:;"
              class="btn btn-sm btn-icon item-edit"
              data-bs-toggle="modal"
              data-bs-target="#add-payment-method"
            >
              <img src="{{asset('assets/svg/icons/pencil2.svg')}}" alt="edit">
            </a>
          </td>
        </tr>
        @endforeach
      </x-table>
    </section>
    <section class="tab-pane fade tab-usage d-flex flex-column gap-4" id="usage" role="tabpanel">
      <div class="d-flex flex-column gap-3">
        <h5 class="text-dark">Overview</h4>
        <div class="d-flex align-items-center gap-3">
          <div class="card-overview d-flex flex-column">
            <span class="title">Current balance</span>
            <span class="subtitle active">+USD {{number_format($client->quota,2)}}</span>
          </div>
          <div class="card-overview d-flex flex-column">
            <span class="title">All-time usage</span>
            <span class="subtitle">USD 00.00</span>
          </div>
          <div class="card-overview d-flex flex-column">
            <span class="title">Amount top-up</span>
            <span class="subtitle">USD 00.00</span>
          </div>
        </div>
      </div>
      <div class="d-flex flex-column gap-3">
        <h5 class="text-dark">Conversation usage</h5>
        <div class="d-flex flex-column gap-4 wrapper-billing">
          <div class="d-flex align-items-center gap-4">
            <div class="d-flex align-items-center gap-1">
              <input type="text" class="form-control custom-datepicker" placeholder="MM/DD/YYYY" id="bs-datepicker" value="" />
              <i class="ti ti-arrow-right text-dark"></i>
              <input type="text" class="form-control custom-datepicker" placeholder="MM/DD/YYYY" id="bs-datepicker-to" disabled />
            </div>
            <select class="form form-select" name="name" id="name">
              <option value="{{$user->name}}">{{Str::title($user->name)}}</option>
            </select>
            <button class="btn btn-export">Export CSV</button>
          </div>
          <div class="row card-billing">
            <div class="col p-3 border-end">
              <h6 class="fw-medium">Conversation</h6>
              <div class="border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1">
                    <small class="fw-medium">All conversation</small>
                    <img src="{{asset('assets/svg/icons/info-gray.svg')}}" alt="info-icon" width="18">
                  </div>
                  <small>0</small>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <small>Business-initiated</small>
                  <small>0</small>
                </div>
                <ul>
                  <li class="d-flex justify-content-between align-items-center">
                    <small class="text-dark-gray">Authentication</small>
                    <small>0</small>
                  </li>
                  <li class="d-flex justify-content-between align-items-center">
                    <small class="text-dark-gray">Marketing</small>
                    <small>0</small>
                  </li>
                  <li class="d-flex justify-content-between align-items-center">
                    <small class="text-dark-gray">Utility</small>
                    <small>0</small>
                  </li>
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                  <small>User-initiated</small>
                  <small>0</small>
                </div>
                <ul>
                  <li class="d-flex justify-content-between align-items-center">
                    <small class="text-dark-gray">Service</small>
                    <small>0</small>
                  </li>
                </ul>
              </div>
              <div class="pt-3">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center gap-1">
                    <small class="fw-medium">Free conversation</small>
                    <img src="{{asset('assets/svg/icons/info-gray.svg')}}" alt="info-icon" width="18">
                  </div>
                  <small>0</small>
                </div>
                <ul>
                  <li class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-1">
                      <small class="text-dark-gray">Free tier</small>
                      <img src="{{asset('assets/svg/icons/info-gray.svg')}}" alt="info-icon" width="18">
                    </div>
                    <small>0</small>
                  </li>
                  <li class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-1">
                      <small class="text-dark-gray">Free entry point</small>
                      <img src="{{asset('assets/svg/icons/info-gray.svg')}}" alt="info-icon" width="18">
                    </div>
                    <small>0</small>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col p-3">
              <h6 class="fw-medium">Total rate</h6>
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-1">
                  <small class="fw-medium">Estimated charge</small>
                  <img src="{{asset('assets/svg/icons/info-gray.svg')}}" alt="info-icon" width="18">
                </div>
                <small>0</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</section>