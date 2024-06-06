<x-modal
  isUsingHeaderTitle="{{ false }}"
  name="checkout"
  submitText="Create Payment"
  isUsingButtonClose="{{ false }}"
  modalClass="modal-checkout"
  buttonWrapperSubmitClass="d-flex justify-content-center align-items-center w-100"
  buttonSubmitClass=""
  isModalStack="{{ true }}"
>
  <div class="d-flex flex-column gap-3">
    <div class="d-flex flex-column">
      <h6 class="text-dark">Purchase summary</h6>
      <table class="table table-borderless">
        <thead>
          <tr>
            <th class="text-xs">Product</th>
            <th class="text-xs">Price</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="border-bottom">
            <td>
              <div class="d-flex gap-3 align-items-center">
                <img src="{{ asset('assets/svg/icons/file.svg') }}" alt="icon-file">
                <div class="d-flex flex-column">
                  <span class="text-dark fw-bold text-sm">10 Users Plan</span>
                  <span class="text-sm">10 users included</span>
                </div>
              </div>
            </td>
            <td class="text-sm">&#65284;120</td>
            <td>
              <a href="#">
                <i class="ti ti-dots-vertical text-muted"></i>
              </a>
            </td>
          </tr>
          <tr>
            <td>
              <div class="d-flex gap-3 align-items-center">
                <img src="{{ asset('assets/svg/icons/file.svg') }}" alt="icon-file">
                <div class="d-flex flex-column">
                  <span class="text-dark fw-bold text-sm">10 Users Plan</span>
                  <span class="text-sm">10 users included</span>
                </div>
              </div>
            </td>
            <td class="text-sm">&#65284;100</td>
            <td>
              <a href="#">
                <i class="ti ti-dots-vertical text-muted"></i>
              </a>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>
              <h5 class="text-dark fw-bold">Total</h5>
            </td>
            <td>
              <h5 class="text-dark fw-bold">&#65284;220</h5>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="d-flex flex-column gap-2">
      <h6 class="text-dark">Choose payment method</h6>
      <div class="d-flex flex-column gap-3">
        <div class="d-flex justify-content-between card-payment-method">
          <div class="d-flex gap-2">
            <div class="wrapper-payment-icon">
              <img src="{{ asset('assets/svg/icons/visa.svg') }}" alt="icon-visa">
            </div>
            <div class="d-flex flex-column gap-2">
              <div class="d-flex flex-column">
                <span class="text-sm">Visa ending in 1234</span>
                <span class="text-sm">Expiry</span>
              </div>
              <div class="d-flex gap-2">
                <span class="text-sm text-default">Set as default</span>
                <a
                  href="#"
                  class="btn-edit"
                  data-bs-toggle="modal"
                  data-bs-target="#add-payment-method"
                >
                  Edit
                </a>
              </div>
            </div>
          </div>
          <input name="payment-method" id="payment-method" class="form-check-input rounded-pill custom-radio" type="radio" value="" />
        </div>
        <div class="d-flex justify-content-between card-payment-method">
          <div class="d-flex gap-2">
            <div class="wrapper-payment-icon">
              <img src="{{ asset('assets/svg/icons/master-card.svg') }}" alt="icon-visa">
            </div>
            <div class="d-flex flex-column gap-2">
              <div class="d-flex flex-column">
                <span class="text-sm">Mastercard ending in 1234</span>
                <span class="text-sm">Expiry</span>
              </div>
              <div class="d-flex gap-2">
                <span class="text-sm text-default">Set as default</span>
                <a
                  href="#"
                  class="btn-edit"
                  data-bs-toggle="modal"
                  data-bs-target="#add-payment-method"
                >
                  Edit
                </a>
              </div>
            </div>
          </div>
          <input name="payment-method" id="payment-method" class="form-check-input rounded-pill custom-radio" type="radio" value="" />
        </div>
      </div>
    </div>
  </div>
</x-modal>