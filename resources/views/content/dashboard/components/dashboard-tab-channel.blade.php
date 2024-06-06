<section class="tab-pane fade tab-channels w-100" id="channels" role="tabpanel">
    <div class="row d-flex gap-4">
        <div class="col-3 d-flex flex-column gap-4">
            <button class="btn bg-white btn-wa text-primary">
                WhatsApp Official API
                <img src="{{asset('assets/svg/icons/wa-api-logo.svg')}}" alt="icon api">
            </button>
        </div>
        <section class="col content">
            <div class="card-wa row align-items-center">
                <div class="col-8 d-flex gap-2 align-items-start card-wa-content-left">
                    <img class="wa-logo" src="{{asset('assets/svg/icons/wa-logo.svg')}}" alt="wa icon">
                    <div class="d-flex flex-column gap-2">
                        <span class="title">WhatsApp Official API</span>
                        <div class="d-flex align-items-center">
                            <img src="{{asset('assets/svg/icons/meta-logo.svg')}}" alt="meta icon">
                            <span class="subtitle">Meta Tech Provider</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 d-flex flex-column gap-2 card-wa-content-right">
                    <div class="d-flex flex-column align-items-end">
                        <span class="title">Connection fee per number</span>
                        <div class="subtitle">
                            <b class="text-dark">$15.00</b>
                            <span>/ month</span>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">Connect</button>
                </div>
            </div>
            <nav class="mt-5">
                <ul class="nav nav-tabs tabs-crm" id="chats-tabs" role="tablist">
                    @foreach($tabsChannels as $key => $value)
                        <li class="nav-item" role="presentation">
                            <button
                              class="nav-link {{ $key === 0 ? 'active' : '' }}"
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
            <div class="tab-content tab-channels-content mt-5">
                <section class="tab-pane fade tab-account active show w-100" id="account" role="tabpanel">
                    <div class="d-flex flex-column gap-3">
                        <h5 class="title">SERVICE PROVIDER</h5>
                        <div class="custom-select" id="custom-select">
                            <span id="placeholder" class="placeholder">
                              <img  src="{{asset('assets/svg/icons/wa-logo.svg')}}" alt="icon wa" width="20" height="20">
                              <span class="text ms-2">WhatsApp Cloud API</span>
                            </span>
                            <ul class="dropdown" id="dropdown">
                              <li class="dd-item">
                                <span class="img-wrapper">
                                    <img src="{{asset('assets/svg/icons/wa-logo.svg')}}" alt="icon wa" width="20" height="20">
                                </span>
                                <span class="text">WhatsApp Cloud API</span>
                              </li>
                            </ul>
                          </div>
                        <table class="border-bottom">
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Messaging limit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span>Pasima</span>
                                            <span style="color: #D0D5DD;">0934872637157356143</span>
                                        </div>
                                    </td>
                                    <td>250 / 24 hours</td>
                                    <td>
                                        <span class="badge-not-connect">Not Connect</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                <section class="tab-pane fade tab-qr-code w-100" id="qr-code" role="tabpanel">
                    <h5 class="text-dark fw-bold">Get WhatsApp QR code setting</h5>
                    <p class="subtitle">Activate this setting to manage channels, default messages, and conversation assignments for all teams’ and users’ WhatsApp QR codes.</p>
                    <ul>
                        @foreach ($codeSettings as $setting)
                        <li class="d-flex align-items-center gap-3 mt-2">
                            <i class="ti ti-check text-primary"></i>
                            {{ $setting }}
                        </li>
                        @endforeach
                    </ul>
                    <button class="btn btn-primary btn-contact-sales">Contact sales</button>
                </section>
                <section class="tab-pane fade tab-template-manager w-100" id="template-manager" role="tabpanel">
                    <h5 class="text-dark fw-bold">WhatsApp message template manager</h5>
                    <p class="subtitle">You must use an approved template to send message to WhatsApp users outside a 24-hour session. Please note that you can register a maximum of 250 templates.</p>
                    <div class="d-flex align-items-center w-100 justify-content-between">
                        <span class="badge text-dark d-flex align-items-center gap-2">
                            <img src="{{asset('assets/svg/icons/wa-logo.svg')}}" alt="icon wa" width="18" height="18">
                            Pasima
                        </span>
                        <button class="btn btn-primary">Create template</button>
                    </div>
                    <table class="mt-4 table1">
                        <thead>
                            <tr>
                                <th>Template name</th>
                                <th>Button type</th>
                                <th>Languange</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                <div class="d-flex align-items-center flex-grow-1 me-3 me-lg-0">
                                    <div class="flex-grow-1 input-group input-group-merge">
                                        <span class="input-group-text form-search-custom" id="basic-addon-search31"><i
                                                class="ti ti-search"></i></span>
                                        <input type="text" class="form-control chat-search-input form-search-custom" placeholder="Search by template name"
                                            aria-label="Search by template name" aria-describedby="basic-addon-search31">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form form-select" id="button-type" name="button-type">
                                    <option value="button-type" selected>Button type</option>
                                </select>
                            </td>
                            <td>
                                <select class="form form-select" id="language" name="language">
                                    <option value="language" selected>Language</option>
                                </select>
                            </td>
                            <td>
                                <select class="form form-select" id="category" name="category">
                                    <option value="category" selected>Category</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn border btn-clear">Clear all</button>
                            </td>
                        </tbody>
                    </table>
                    <table class="table2 w-100">
                        <thead>
                            <tr>
                                <th>BOOKMARKS</th>
                                <th>TEMPLATE NAME</th>
                                <th>MESSAGE TEXT</th>
                                <th>CATEGORY</th>
                                <th>BUTTON TYPE</th>
                                <th>LANGUAGE</th>
                                <th>APPROVAL STATUS</th>
                            </tr>
                        </thead>
                    </table>
                </section>
            </div>
        </section>
    </div>
</section>