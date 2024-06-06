<x-modal
  title="Add Payment Details"
  name="add-payment-method"
  submitText="Save Payment Details"
  isUsingButtonClose="{{ false }}"
  modalClass="modal-payment-method"
  buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
  buttonSubmitClass=""
>
  <div class="d-flex flex-column gap-4">
    <div class="d-flex flex-column gap-4">
      <div class="d-flex align-items-center justify-content-between">
        <h6 class="text-dark title font-medium">Card Details</h6>
        <div class="d-flex align-items-center gap-2">
          <div class="wrapper-payment-icon border-gray">
            <img src="{{ asset('assets/svg/icons/visa.svg') }}" alt="icon-visa">
          </div>
          <div class="wrapper-payment-icon border-gray wrapper-card-discover">
            <img src="{{ asset('assets/svg/icons/discover.svg') }}" alt="icon-discover">
          </div>
          <div class="wrapper-payment-icon border-gray">
            <img src="{{ asset('assets/svg/icons/maestro.svg') }}" alt="icon-maestro">
          </div>
          <div class="wrapper-payment-icon border-gray">
            <img src="{{ asset('assets/svg/icons/master-card.svg') }}" alt="icon-master-card">
          </div>
        </div>
      </div>
      <div class="d-flex flex-column gap-4">
        <div class="d-flex gap-4">
          <x-input-floating
            label="Card Number"
            id="card number"
            name="card number"
            type="number"
          ></x-input-floating>
          <x-input-floating
            label="Expiration Date"
            id="date"
            name="date"
          ></x-input-floating>
        </div>
        <div class="row align-items-center">
          <div class="col-6 wrapper-card-security">
            <x-input-floating
            label="Card Security Code"
            id="card security code"
            name="card security code"
            type="password"
          ></x-input-floating>
          </div>
          <div class="col-6">
            <small class="text-info-security">What is this?</small>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column gap-2">
      <div class="d-flex align-items-center justify-content-between">
        <h6 class="text-dark fw-bold title">Billing Address</h6>
      </div>
      <div class="d-flex flex-column gap-4">
        <div class="d-flex gap-4">
          <x-input-floating
            label="First name"
            id="first name"
            name="first name"
          ></x-input-floating>
          <x-input-floating
            label="Last Name"
            id="last name"
            name="last name"
          ></x-input-floating>
        </div>
        <div class="w-100">
          <x-input-floating
            label="Email Address"
            id="email address"
            name="email address"
            type="email"
          ></x-input-floating>
        </div>
        <div class="w-100">
          <x-input-floating
            label="Street Address"
            id="street address"
            name="street address"
          ></x-input-floating>
        </div>
        <div class="d-flex gap-4">
          <x-input-floating
            label="State/Province"
            id="state-province"
            name="state-province"
            type="select"
            :options="$listDataState"
          ></x-input-floating>
          <x-input-floating
            label="City"
            id="city"
            name="city"
            type="select"
            :options="$listDataState"
          ></x-input-floating>
        </div>
        <div class="d-flex gap-4">
          <x-input-floating
            label="Zip/Postal Code"
            id="zip-Postal-code"
            name="zip-Postal-code"
            type="number"
          ></x-input-floating>
          <x-input-floating
            label="Phone"
            id="phone"
            name="phone"
            type="number"
          ></x-input-floating>
        </div>
      </div>
    </div>
  </div>
</x-modal>