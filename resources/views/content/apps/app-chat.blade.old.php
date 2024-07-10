@extends('layouts/layoutMaster')

@section('title', 'Chat - Apps')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-chat.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/app-chat.js') }}"></script>
    <script src="{{ asset('assets/js/components/chat-history.js') }}"></script>
    <script src="{{ asset('assets/js/components/input-floating.js') }}"></script>
@endsection

@php
    $obj1 = (object) [
        'name' => 'Aditya Rahardi',
        'cars' => 'Toyota Avanza',
        'time' => '12:48 PM',
        'chat' => 'I will purchase it for sure. 👍',
        'tag' => 'cold'
    ];
 
$myArray = [];

$alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

$productDummy = (object) [
  'label' => 'BMW',
  'value' => 'BMW',
];

$productDummy2 = (object) [
  'label' => 'Porche',
  'value' => 'Porche',
];

$listProduct = [$productDummy, $productDummy2];

$leadSourceDummy = (object) [
  'label' => 'OLX',
  'value' => 'OLX',
];

$leadSourceDummy2 = (object) [
  'label' => 'Tokopedia',
  'value' => 'Tokopedia',
];

$listLeadSource = [$leadSourceDummy, $leadSourceDummy2];

$paymentMethodDummy = (object) [
  'label' => 'Cash',
  'value' => 'Cash',
];

$paymentMethodDummy2 = (object) [
  'label' => 'Transfer',
  'value' => 'Transfer',
];

$listPaymentMethod = [$paymentMethodDummy, $paymentMethodDummy];

$tab = (object) [
    'name' => 'New',
    'lengthData' => 5
];
$tab2 = (object) [
    'name' => 'Active',
    'lengthData' => 5
];
$tab3 = (object) [
    'name' => 'Success',
    'lengthData' => 5
];
$tab4 = (object) [
    'name' => 'Failed',
    'lengthData' => 5
];

$listTabs = [$tab, $tab2, $tab3, $tab4];
@endphp

@section('content')
    <input type="hidden" id="USERID" value="{{$userId}}">
    <div class="row">
        <div class="">
            <div class="app-chat card overflow-hidden">
                <div class="row g-0">

                    <!-- Chat & Contacts -->
                    <x-sidebar-chat-contacts
                        :tabs="$listTabs"
                        placeholderSearchText="Search leads"
                        targetOpenModal="#contacts"
                        targetOpenModalFilter="#filter"
                        title="Leads"
                    >
                        <x-slot name="body">
                            <div class="tab-content p-0">
                            <div class="tab-pane active" id="open" role="tabpanel" aria-labelledby="open-tab">
                                @if(count($myArray) > 0)
                                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                    @foreach($myArray as $key => $value)
                                    <li class="chat-contact-list-item">
                                        <a class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar">
                                                <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">AR</span>
                                            </div>

                                            <div class="d-flex flex-column chat-contact-info flex-grow-1 ms-2 gap-2">
                                                <div class="d-flex flex-column gap-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="chat-contact-name text-truncate m-0 text-dark fw-bolder">{{ $value->name }}</h6>
                                                        <small>{{ $value->time }}</small>
                                                    </div>
                                                    <small>{{ $value->cars }}</small>
                                                </div>
                                                <div>
                                                    <p class="chat-contact-status text-chat text-truncate mb-0">{{ $value->chat }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="d-flex align-items-center badge badge-sm rounded-pill badge-user text-dark gap-1">
                                                            <i class="ti ti-user user-icon text-dark"></i>
                                                            <div class="d-flex align-items-center gap-1">
                                                                <small>Sally,</small>
                                                                <small>Princess,</small>
                                                                <small>+1</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-sm rounded-pill text-dark" style="background: #B8E9EF;">
                                                            {{ $value->tag }}
                                                        </span>
                                                    </div>
                                                    <img src="{{asset('assets/svg/icons/info.svg')}}" alt="info" width="20">
                                                </div>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                
                                </ul>
                                @endif
                            </div>
                            <div class="tab-pane" id="closed" role="tabpanel" aria-labelledby="closed-tab">
                                <ul class="list-unstyled chat-contact-list p-0 mt-2" id="chat-list">
                                    <li class="chat-contact-list-item chat-list-item-0">
                                        <h6 class="text-muted mb-0">No Chats Found</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </x-slot>
                    </x-sidebar-chat-contacts>
                    <!-- /Chat contacts -->

                    <!-- Chat History -->
                    @if(count($myArray) > 0)
                    <x-chat-history
                        title="Aditya Rahardi"
                        typeTask="Toyota Avanza"
                        :people="['Me']"
                        type="cold"
                    ></x-chat-history>
                    @else
                    <x-chat-blank></x-chat-blank>
                    @endif
                    <!-- /Chat History -->

                    <!-- Sidebar Right -->
                    <x-sidebar-right-info-chat
                        title="Profile"
                        time="Last modified 24 Feb 2024, 00:00 PM"
                        name="Aditya Rahardi"
                        subtitle="+62 811-818-256"
                    >
                        <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Status</h6>
                                <select id="status" class="form-select custom-select" data-allow-clear="true">
                                    <option value="active">Active</option>
                                    <option value="offline">Offline</option>
                                    <option value="away">Away</option>
                                    <option value="busy">Busy</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Quality</h6>
                                <select id="status" class="form-select custom-select" data-allow-clear="true">
                                    <option value="warm">Warm</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Stage</h6>
                                <select id="status" class="form-select custom-select" data-allow-clear="true">
                                    <option value="test-drive">Test drive</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-dark">Assigned staff</h6>
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
                           
                           {{-- product --}}
                           <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-dark">Assigned staff</h6>
                                <i class="ti ti-chevron-right text-dark"></i>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="d-flex align-items-center tag gap-1">
                                    <span class="text-dark">Mercedes EQE 350+</span>
                                    <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                                </div>
                                <div class="d-flex align-items-center tag gap-1">
                                    <span class="text-dark">Toyota Corolla</span>
                                    <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                                </div>
                                <div class="d-flex align-items-center tag gap-1">
                                    <span class="text-dark">Honda Jazz</span>
                                    <i class="ti ti-x text-dark" data-bs-toggle="tag" data-overlay data-target="#tag"></i>
                                </div>
                            </div>
                           </div>
                    
                           {{-- internal memo --}}
                           <div class="sidebar-card d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-dark">Internal memo</h6>
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
                                <h6 class="text-dark">Payment details</h6>
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
        {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Internal Notes</h5>
                    <ul class="timeline mt-5 internal-notes-history">
                    </ul>
                    <form class="form-send-internal-message d-flex justify-content-between align-items-center" type="submit">
                        <input class="form-control internal-message-input border-0 me-3 shadow-none"
                            placeholder="Type your internal notes here">
                        <div class="message-actions d-flex align-items-center">
                            <button class="btn btn-primary d-flex send-msg-btn">
                                <i class="ti ti-send me-md-1 me-0"></i>
                                <span class="align-middle d-md-inline-block d-none">Send</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- modal edit profile --}}
    <x-modal title="Edit profile" name="modal">
      <div class="d-flex flex-column gap-4">
        <div class="d-flex flex-column gap-2">
            <h6 class="text-dark">Lead details</h6>
            <div class="d-flex flex-column gap-3">
                <x-input-floating
                    label="Name"
                    placeholder="Please input name"
                    id="name"
                    name="name"
                ></x-input-floating>
                <x-input-floating
                    label="Phone number"
                    placeholder="Please phone number"
                    id="phone number"
                    name="phone number"
                    type="number"
                ></x-input-floating>
                <x-input-floating
                    label="Email address"
                    placeholder="Please email address"
                    id="email address"
                    name="email address"
                    type="email"
                ></x-input-floating>
            </div>
          </div>
          <div class="d-flex flex-column gap-2">
            <h6 class="text-dark">Payment details</h6>
            <div class="d-flex flex-column gap-3">
                <x-input-floating
                    label="Payment method"
                    placeholder="Please payment method"
                    type="select"
                    id="payment method"
                    name="payment method"
                    :options="$listPaymentMethod"
                >
                </x-input-floating>
                <x-input-floating
                    id="downpayment"
                    name="downpayment"
                    label="Downpayment preference"
                    placeholder="Please downpayment preference"
                    type="textarea"
                    cols="33"
                    rows="5"
                ></x-input-floating>
            </div>
          </div>
      </div>
    </x-modal>

    {{-- modal create task --}}
    <x-modal title="Create Task" submitText="Submit" name="create-task">
        <div class="d-flex flex-column gap-3">
            <x-input-floating
                label="Task name"
                placeholder="Please input task name"
                id="task name"
                name="task name"
            ></x-input-floating>
            <div class="d-flex flex-column">
                <h6 class="text-dark fw-bold">Assign to</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="assign" id="assign" value="option1" />
                    <label class="form-check-label text-dark" for="assign">John</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="assign" id="assign" value="option1" />
                    <label class="form-check-label text-dark" for="assign">Ricky</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="assign" id="assign" value="option1" />
                    <label class="form-check-label text-dark" for="assign">Purchasing Department</label>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h6 class="text-dark fw-bold">Priority</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="priority" id="priority" value="option1" />
                    <label class="form-check-label text-dark" for="priority">Low</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="priority" id="priority" value="option1" />
                    <label class="form-check-label text-dark" for="priority">Medium</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="priority" id="priority" value="option1" />
                    <label class="form-check-label text-dark" for="priority">High</label>
                </div>
            </div> 
            <div class="">
                <label for="flatpickr-date" class="form-label">Due Date</label>
                <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date" />
            </div>
        </div>
    </x-modal>

    {{-- modal add/select contact --}}
    <x-modal title="Contacts" name="contacts" isUsingBtnFooter="{{ false }}">
        <div class="d-flex flex-column gap-3 modal-add-contact">
            <div class="d-flex flex-column gap-2 border-bottom">
                <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                    <span class="input-group-text form-search-custom" id="basic-addon-search31"><i
                            class="ti ti-search"></i></span>
                    <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search contacts"
                            aria-label="Search contacts" aria-describedby="basic-addon-search31">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <x-button-add-contact target="#add-lead" name="Add New Lead"></x-button-add-contact>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column modal-contact">
                    <div class="d-flex flex-column">
                        <h6 class="text-dark fw-bold">R</h6>
                        <div class="d-flex align-items-center gap-2 modal-contact-body">
                            <div class="flex-shrink-0 avatar">
                                <span class="avatar-initial rounded-8 bg-label-success text-dark fw-bolder">AR</span>
                            </div>
                            <div class="">
                                <h6 class="text-dark fw-bold modal-contact-title">Ricky Jonathan</h6>
                                <div class="d-flex align-items-center gap-1">
                                    <span class="badge badge-sm badge-status rounded-pill text-dark">
                                    Status
                                </span>
                                <span class="badge badge-sm rounded-pill badge-quality text-dark">
                                    Quality
                                </span>
                                <small class="text-muted">Product name</small>    
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="alphabet">
                    @foreach($alphabet as $alpha)
                    <small>{{ $alpha }}</small>
                    @endforeach
                </div>   
            </div>
        </div>
    </x-modal>

    {{-- modal add new lead --}}
    <x-modal
        title="Add New Lead"
        name="add-lead"
        submitText="Add Contact"
        isModalStack="{{ true }}"
        targetNameModalStack="contacts"
    >
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column gap-2">
                <h6 class="text-dark">Lead details</h6>
                <div class="d-flex flex-column gap-3">
                    <x-input-floating
                        label="Name"
                        placeholder="Please input name"
                        id="name"
                        name="name"
                    ></x-input-floating>
                    <x-input-floating
                        label="Phone number"
                        placeholder="Please input phone number"
                        id="phone number"
                        name="phone number"
                        type="number"
                    ></x-input-floating>
                    <x-input-floating
                        label="Email address"
                        placeholder="Please input email address"
                        id="email address"
                        name="email address"
                        type="email"
                    ></x-input-floating>
                </div>
            </div>
            <div class="d-flex flex-column gap-2">
                <h6 class="text-dark">Product details</h6>
                <div class="d-flex flex-column gap-3">
                    <x-input-floating
                        label="Lead source"
                        placeholder="Please input lead source"
                        id="lead source"
                        name="lead source"
                        type="select"
                        :options="$listLeadSource"
                    >
                    </x-input-floating>
                    <x-input-floating
                        label="Product"
                        placeholder="Please input product"
                        id="product"
                        name="product"
                        type="select"
                        :options="$listProduct"
                    >
                    </x-input-floating>
                </div>
            </div>
        </div>
    </x-modal>

    {{-- modal filter --}}
    <x-modal title="Filter By" submitText="Apply Filter" name="filter" wrapperModalClass="modal-left">
        <x-slot name="sideRightHeader">
            <button class="btn">Reset</button>    
        </x-slot>
        <div class="d-flex flex-column gap-3">
            <div class="d-flex flex-column">
                <h6 class="text-dark fw-bold">Lead quality</h6>
                <div class="ps-3">
                  <div class="form-check form-check-inline d-flex gap-3">
                    <input class="form-check-input" type="checkbox" id="cold" value="cold" />
                    <label class="form-check-label text-dark" for="cold">Cold</label>
                  </div>
                  <div class="form-check form-check-inline mt-3 d-flex gap-3">
                    <input class="form-check-input" type="checkbox" id="warm" value="warm" />
                    <label class="form-check-label text-dark" for="warm">Warm</label>
                  </div>
                  <div class="form-check form-check-inline mt-3 d-flex gap-3">
                    <input class="form-check-input" type="checkbox" id="hot" value="hot" />
                    <label class="form-check-label text-dark" for="hot">Hot</label>
                  </div>    
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <h6 class="text-dark fw-bold">Assigned staff</h6>
                <i class="ti ti-chevron-right text-dark"></i>
            </div>
            <div class="d-flex flex-column">
                <h6 class="text-dark fw-bold">Products</h6>
                <div class="ps-3">
                  <div class="form-check form-check-inline d-flex gap-3">
                    <input class="form-check-input" type="checkbox" id="toyota" value="toyota" />
                    <label class="form-check-label text-dark" for="toyota">Toyota</label>
                  </div>
                  <div class="form-check form-check-inline mt-3 d-flex gap-3">
                    <input class="form-check-input" type="checkbox" id="bmw" value="bmw" />
                    <label class="form-check-label text-dark" for="bmw">BMW</label>
                  </div>  
                </div>
            </div>
            <div class="d-flex flex-column">
                <h6 class="text-dark fw-bold">Location / Branch</h6>
                <div class="ps-3 d-flex flex-column gap-4">
                  <div class="d-flex flex-column gap-3">
                    <div class="form-check form-check-inline d-flex gap-3">
                        <input class="form-check-input" type="checkbox" id="toyota" value="toyota" />
                        <label class="form-check-label text-dark" for="toyota">Toyota Woodlands</label>
                    </div>
                    <div class="form-check form-check-inline d-flex gap-3 ps-5">
                        <input class="form-check-input" type="checkbox" id="alpha" value="alpha" />
                        <label class="form-check-label text-dark" for="alpha">Alpha Team</label>
                    </div>
                    <div class="form-check form-check-inline d-flex gap-3 ps-5">
                        <input class="form-check-input" type="checkbox" id="beta" value="beta" />
                        <label class="form-check-label text-dark" for="beta">Beta Team</label>
                    </div>
                  </div>
                  <div class="d-flex flex-column gap-3">
                    <div class="form-check form-check-inline d-flex gap-3">
                        <input class="form-check-input" type="checkbox" id="toyota2" value="toyota2" />
                        <label class="form-check-label text-dark" for="toyota2">Toyota Sentosa Island</label>
                    </div>
                    <div class="form-check form-check-inline d-flex gap-3 ps-5">
                        <input class="form-check-input" type="checkbox" id="dream" value="dream" />
                        <label class="form-check-label text-dark" for="dream">Dream Team</label>
                    </div>
                    <div class="form-check form-check-inline d-flex gap-3 ps-5">
                        <input class="form-check-input" type="checkbox" id="huang" value="huang" />
                        <label class="form-check-label text-dark" for="huang">Huang Team</label>
                    </div>
                  </div> 
                </div>
            </div>
        </div>
    </x-modal>
@endsection
