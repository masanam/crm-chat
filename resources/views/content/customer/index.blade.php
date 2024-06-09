@extends('layouts/layoutMaster')

@section('title', 'Task Management')
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/tasks.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
@endsection

@section('content')

@php
    $tab = (object) [
        'name' => 'Open',
        'lengthData' => count($dataOpen)
    ];
    $tab2 = (object) [
        'name' => 'Pending',
        'lengthData' => count($dataPending)
    ];
    $tab3 = (object) [
        'name' => 'Closed',
        'lengthData' => count($dataClosed)
    ];
    $listTabs = [$tab, $tab2, $tab3];
@endphp

<div class="row">
  <div class="">
    <div class="app-chat card overflow-hidden">
      <div class="row g-0">
        <!-- Chat & Contacts -->
        <x-sidebar-chat-contacts :tabs="$listTabs" placeholderSearchText="Search Customers"
          targetOpenModalFilter="#filter" title="Customers">
          <x-slot name="body">
            <div class="tab-content p-0">
              {{-- tab active --}}
              <div class="tab-pane active" id="open" role="tabpanel" aria-labelledby="open-tab">
                  <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                      @if (count($dataOpen) > 0)
                      @foreach ($dataOpen as $row)
                          <li class="chat-contact-list-item">
                              <a class="d-flex align-items-center">
                                  <div
                                      class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                      <div class="d-flex flex-column gap-1">
                                          <div class="d-flex justify-content-between align-items-center">
                                              <h6
                                                  class="chat-contact-name text-truncate m-0 text-dark fw-bolder">
                                                  {{ $row->title }}</h6>
                                              <small id="chat-contact-time">{{ $row->updated_at }}</small>
                                          </div>
                                          <small>{{ $row->code }}</small>
                                      </div>
                                      <div>
                                          <p class="chat-contact-status text-chat text-truncate mb-0">
                                            Thanks team, kindly let me know at the soonest so I can inform customer</p>
                                      </div>
                                      <div class="d-flex justify-content-between align-items-center">
                                          <div class="d-flex align-items-center gap-2">
                                              <div
                                                  class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                  <i class="ti ti-user user-icon text-dark"></i>
                                                  <div class="d-flex align-items-center gap-1">
                                                      <small>Sally,</small>
                                                      <small>Princess,</small>
                                                      <small>+1</small>
                                                  </div>
                                              </div>
                                              <x-badge-priority type="{{ $row->priority }}"></x-badge-priority>
                                          </div>
                                          <img src="{{ asset('assets/svg/icons/info.svg') }}"
                                              alt="info" width="20">
                                      </div>
                                  </div>
                              </a>
                          </li>
                      @endforeach
                      @else
                      <li class="chat-contact-list-item chat-list-item-0">
                        <h6 class="text-muted mb-0">No Chats Active Found</h6>
                      </li>
                      @endif
                  </ul>
              </div>
              {{-- tab pending --}}
              <div class="tab-pane" id="pending" role="tabpanel" aria-labelledby="closed-tab">
                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                  @if (count($dataPending) > 0)
                  @foreach ($dataPending as $row)
                      <li class="chat-contact-list-item">
                          <a class="d-flex align-items-center">
                              <div
                                  class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                  <div class="d-flex flex-column gap-1">
                                      <div class="d-flex justify-content-between align-items-center">
                                          <h6
                                              class="chat-contact-name text-truncate m-0 text-dark fw-bolder">
                                              {{ $row->title }}</h6>
                                          <small id="chat-contact-time">{{ $row->updated_at }}</small>
                                      </div>
                                      <small>{{ $row->code }}</small>
                                  </div>
                                  <div>
                                      <p class="chat-contact-status text-chat text-truncate mb-0">
                                        Thanks team, kindly let me know at the soonest so I can inform customer</p>
                                  </div>
                                  <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center gap-2">
                                          <div
                                              class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                              <i class="ti ti-user user-icon text-dark"></i>
                                              <div class="d-flex align-items-center gap-1">
                                                  <small>Sally,</small>
                                                  <small>Princess,</small>
                                                  <small>+1</small>
                                              </div>
                                          </div>
                                          <x-badge-priority type="{{ $row->priority }}"></x-badge-priority>
                                      </div>
                                      <img src="{{ asset('assets/svg/icons/info.svg') }}"
                                          alt="info" width="20">
                                  </div>
                              </div>
                          </a>
                      </li>
                  @endforeach
                  @else
                  <li class="chat-contact-list-item chat-list-item-0">
                    <h6 class="text-muted mb-0">No Chats Pending Found</h6>
                  </li>
                  @endif
              </ul>
            </div>
              {{-- tab closed --}}
              <div class="tab-pane" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                  @if (count($dataClosed) > 0)
                  @foreach ($dataClosed as $row)
                      <li class="chat-contact-list-item">
                          <a class="d-flex align-items-center">
                              <div
                                  class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                  <div class="d-flex flex-column gap-1">
                                      <div class="d-flex justify-content-between align-items-center">
                                          <h6
                                              class="chat-contact-name text-truncate m-0 text-dark fw-bolder">
                                              {{ $row->title }}</h6>
                                          <small id="chat-contact-time">{{ $row->updated_at }}</small>
                                      </div>
                                      <small>{{ $row->code }}</small>
                                  </div>
                                  <div>
                                      <p class="chat-contact-status text-chat text-truncate mb-0">
                                        Thanks team, kindly let me know at the soonest so I can inform customer</p>
                                  </div>
                                  <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center gap-2">
                                          <div
                                              class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                              <i class="ti ti-user user-icon text-dark"></i>
                                              <div class="d-flex align-items-center gap-1">
                                                  <small>Sally,</small>
                                                  <small>Princess,</small>
                                                  <small>+1</small>
                                              </div>
                                          </div>
                                          <x-badge-priority type="{{ $row->priority }}"></x-badge-priority>
                                      </div>
                                      <img src="{{ asset('assets/svg/icons/info.svg') }}"
                                          alt="info" width="20">
                                  </div>
                              </div>
                          </a>
                      </li>
                  @endforeach
                  @else
                  <li class="chat-contact-list-item chat-list-item-0">
                    <h6 class="text-muted mb-0">No Chats Pending Found</h6>
                  </li>
                  @endif
                </ul>
            </div>
            </div>
          </x-slot>
        </x-sidebar-chat-contacts>
        <!-- /Chat contacts -->
        <!-- Chat History -->
        <x-chat-history
          title="Aditya Rahardi"
          typeTask="TY-010209"
          :people="['Sally, Princess']"
          type="Medium Priority"
        >
        </x-chat-history>
        <!-- /Chat History -->
        
        <!-- Sidebar Right -->
        <x-sidebar-right-info-chat
          title="Issue SPK"
          time="Last modified 24 Feb 2024, 00:00 PM"
          name="Aditya Rahardi"
          subtitle="+62 811-818-256"
          email="asmith@hey.com"
          isUsingBtnHeader="{{ false }}"
        >
            <div class="sidebar-card d-flex flex-column">
              <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="text-dark">Status</h6>
                  <select id="status" class="select2 form-select custom-select text-dark" data-allow-clear="true">
                      <option value="active">Open</option>
                      <option value="offline">Close</option>
                  </select>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-dark">Priority</h6>
                    <select id="priority" class="select2 form-select custom-select text-dark" data-allow-clear="true">
                        <option value="high">High Priorty</option>
                        <option value="medium" selected>Medium Priority</option>
                        <option value="low">Low Priority</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-dark">Deadline</h6>
                    <h6 class="text-dark">12 March 2024</h6>
                </div>
                <div class="d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-dark">Assigned sales</h6>
                    <i class="ti ti-chevron-right text-dark"></i>
                  </div>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Sally</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                    </div>
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Princess</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-dark">Assigned team</h6>
                    <i class="ti ti-chevron-right text-dark"></i>
                  </div>
                  <div class="d-flex flex-wrap align-items-center gap-2">
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Sally</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                    </div>
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Princess</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- product --}}
            <div class="sidebar-card d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h6 class="text-dark">Product</h6>
                    <i class="ti ti-chevron-right text-dark"></i>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Mercedes EQE 350+</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                    </div>
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Toyota Corolla</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                            data-target="#tag"></i>
                    </div>
                    <div class="d-flex align-items-center tag gap-1">
                        <span class="text-dark">Honda Jazz</span>
                        <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay
                            data-target="#tag"></i>
                    </div>
                </div>
            </div>
            {{-- internal memo --}}
            <div class="sidebar-card d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h6>Internal memo</h6>
                    <i class="ti ti-chevron-right text-dark"></i>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <p class="text-muted">Firstly, let's talk about Steve's towering height.
                        While it's impressive, let's try not to make too big a deal out of it.
                        After all, he's still the same old Steve we know and love.</p>
                </div>
            </div>
            {{-- payment detail --}}
            <div class="sidebar-card d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h6>Payment details</h6>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <p class="text-muted">Cash</p>
                </div>
            </div>
        </x-sidebar-right-info-chat>
        <!-- /Sidebar Right -->

        <div class="app-overlay"></div>
      </div>
    </div>
  </div>
</div>

{{-- modal filter --}}
<x-modal title="Filter By" name="new-chat" submitText="Apply Filter" name="filter">
  <x-slot name="sideRightHeader">
    <button class="btn">Reset</button>    
  </x-slot>
  <div class="d-flex flex-column gap-3" style="height: 450px;">
    <div class="d-flex flex-column">
      <h6 class="text-dark fw-bold">Priority</h6>
      <div class="ps-3">
        <div class="form-check form-check-inline d-flex gap-3">
          <input class="form-check-input" type="checkbox" id="low" value="low" />
          <label class="form-check-label text-dark" for="low">Low</label>
        </div>
        <div class="form-check form-check-inline mt-3 d-flex gap-3">
          <input class="form-check-input" type="checkbox" id="medium" value="medium" />
          <label class="form-check-label text-dark" for="medium">Medium</label>
        </div>
        <div class="form-check form-check-inline mt-3 d-flex gap-3">
          <input class="form-check-input" type="checkbox" id="high" value="high" />
          <label class="form-check-label text-dark" for="high">High</label>
        </div>    
      </div>
  </div>
  </div>
</x-modal>

@endsection
