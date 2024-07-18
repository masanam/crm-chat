<div class="sidebar-card d-flex flex-column">
    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
            <div class="flex-shrink-0 avatar">
                <span
                    class="avatar-initial border-12 bg-avatar-call text-dark fw-bolder">{{ Helper::getInitial($model->client->organization->name) }}</span>
            </div>
            <span class="text-dark fw-bold" style="font-size: 22px">{{ $model->client->organization->name }}</span>
            @php $is_lead = $model->lead_id ? 'Lead' : '' @endphp
            <x-badge-stage type="{{ $is_lead }}"></x-badge-stage>
        </div>
        <div class="d-flex justify-content-between align-items-center px-2">
            <div>
                <img src="{{ asset('assets/svg/icons/icon-calendar.svg') }}" alt="calendar"
                    width="15">
                    <!-- get closed date -->
                <span style="font-size: 12px">{{ date('M d, Y', strtotime($model->client->created_at)) }}</span>
            </div>
            <div>
                <img src="{{ asset('assets/svg/icons/icon-dolar.svg') }}" alt="dolar"
                    width="15">
                <span style="font-size: 12px">{{ $model->lead ? 'Rp ' . number_format($model->lead->amount, 0, ',', '.') : '' }}</span>
            </div>
        </div>
    </div>
</div>
<div class="sidebar-card d-flex flex-column">
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="text-dark">Status</h6>
        <select id="status" data-id="{{ $model->lead_id }}" data-type="status" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
            <option value="new" {{ strtolower($model->lead->status) == "new" ? 'selected' : '' }}>New</option>
            <option value="active" {{ strtolower($model->lead->status) == "active" ? 'selected' : '' }}>Active</option>
            <option value="closed" {{ strtolower($model->lead->status) == "closed" ? 'selected' : '' }}>Closed</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="text-dark">Quality</h6>
        <select id="quality" data-id="{{ $model->lead_id }}" data-type="quality" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
            <option value="cold" {{ strtolower($model->lead->quality) == "cold" ? 'selected' : '' }}>Cold</option>
            <option value="warm" {{ strtolower($model->lead->quality) == "warm" ? 'selected' : '' }}>Warm</option>
            <option value="hot" {{ strtolower($model->lead->quality) == "hot" ? 'selected' : '' }}>Hot</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="text-dark">Stage</h6>
        <select id="stage" data-id="{{ $model->lead_id }}" data-type="stage" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
            <option value="Test Drive" {{ $model->lead->stage == 'Test Drive' ? 'selected' : '' }}>Test Drive</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="text-dark">Customer Type</h6>
        <select id="customer_type" data-id="{{ $model->lead_id }}" data-type="customer_type" data-url="api/leads/{{ $model->lead_id }}/change" class="form-select select-lead-editable custom-select" data-allow-clear="true">
            <option value="B2B" {{ strtoupper($model->lead->customer_type) == 'b2b' ? 'selected' : '' }}>B2B</option>
            <option value="B2C" {{ strtoupper($model->lead->customer_type) == 'b2c' ? 'selected' : '' }}>B2C</option>
            <option value="C2B" {{ strtoupper($model->lead->customer_type) == 'c2b' ? 'selected' : '' }}>C2B</option>
            <option value="C2C" {{ strtoupper($model->lead->customer_type) == 'c2c' ? 'selected' : '' }}>C2C</option>
        </select>
    </div>
</div>

<div class="sidebar-card d-flex flex-column gap-3">
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark fw-bold" style="font-size: 18px">Contact Information</span>
        <i class="ti ti-chevron-down text-dark"></i>
    </div>
    @foreach($contacts as $contact)
    <div class="d-flex flex-column gap-2 border-bottom border-1 pb-3">
        <div class="d-flex flex-column gap-1">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-dark fw-bold">{{ $contact->first_name ?? '' }} {{ $contact->last_name ?? '' }}</span>
                <img src="{{ asset('assets/svg/icons/edit.svg') }}" alt="edit"
                    width="15" data-bs-toggle="modal" data-bs-target="#add-edit-contact"
                    class="cursor-pointer">
            </div>
            <span class="text-dark" style="font-size: 14px">{{ $contact->job_title ?? '' }}</span>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                    width="15">
                <span style="font-size: 12px">{{ $contact->whatsapp ?? '' }}</span>
            </div>
            <div>
                <img src="{{ asset('assets/svg/icons/icon-circle-outline.svg') }}"
                    alt="circle" width="15">
                <span style="font-size: 12px">WhatsApp</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ asset('assets/svg/icons/icon-contact-mail.svg') }}" alt="contact"
                    width="15">
                <span style="font-size: 12px">{{ $contact->email ?? '' }}</span>
            </div>
            <div>
                <img src="{{ asset('assets/svg/icons/icon-circle-outline.svg') }}"
                    alt="circle" width="15">
                <span style="font-size: 12px">Email</span>
            </div>
        </div>
    </div>
    @endforeach
    <button class="btn-link" data-bs-toggle="modal" data-bs-target="#add-contact">
        + Add more contacts
    </button>
</div>

<div class="sidebar-card d-flex flex-column gap-3">
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark fw-bold" style="font-size: 18px">Company Information</span>
        <i class="ti ti-chevron-down text-dark"></i>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Company Name</span>
        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="name" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->name ?? ' - ' }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Industry</span>
        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="industry" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->industry ?? ' - ' }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Location</span>
        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="address" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->address ?? ' - ' }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Website</span>
        <span class="company-editable" data-id="{{ $model->client_id }}" data-type="website" data-url="api/companies/{{ $model->client_id }}/change">{{ $model->client->organization->website ?? ' - ' }}</span>
    </div>
</div>

<div class="sidebar-card d-flex flex-column gap-3">
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark fw-bold" style="font-size: 18px">Deals Information</span>
        <i class="ti ti-chevron-down text-dark"></i>
    </div>
    <div class="d-flex flex-column">
        <span class="text-dark" style="font-weight: 600;">Description</span>
        <span style="font-size: 13px; color: #616A75;" contenteditable="true" class="lead-editable" data-id="{{ $model->lead_id }}" data-type="notes" data-url="api/leads/{{ $model->lead_id }}/change">{{ $model->lead->notes ?? ' - ' }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark" style="font-weight: 600;">Revenue</span>
        <span>Rp {{ number_format($model->lead->amount, 0, ',', '.') }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark" style="font-weight: 600;">Close Date</span>
        <span>{{ date('m D Y', strtotime($model->lead->closed_date)) }}</span>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark" style="font-weight: 600;">Source</span>
        <select id="status" class="form-select custom-select" data-allow-clear="true">
            <option value="test-drive">{{ $model->lead->source }}</option>
        </select>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-dark" style="font-weight: 600;">Field</span>
        <span>Options</span>
    </div>
    <div class="d-flex flex-column">
        <span class="text-dark" style="font-weight: 600;">Next Step</span>
        <span style="font-size: 13px; color: #616A75;" contenteditable="true" class="lead-editable" data-id="{{ $model->lead_id }}" data-type="next_step" data-url="api/leads/{{ $model->lead_id }}/change">{{ $model->lead->next_step ?? '' }}</span>
    </div>
</div>