<div class="modal fade {{ $wrapperModalClass }}" id="{{ $name }}" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog {{ $modalClass }}" role="document">
        <div class="modal-content">  
          <div class="modal-body px-4 py-3 d-flex flex-column align-items-center">
            <div id="modal-body-icon">
                <img class="text-dark" src="{{asset('assets/svg/icons/info-dark.svg')}}" alt="info" width="100">
            </div>
            <span id="modal-body-title" class="text-dark fw-bold" style="font-size: 28px;">{{ $title }}</span>
            <span id="modal-body-subtitle" class="text-dark" style="font-size: 18px;">{{ $subtitle }}</span>
          </div>
  
          @if($isUsingBtnFooter)
          <div class="modal-footer justify-content-center {{ $buttonWrapperSubmitClass }}">
            <button
                id="modal-confirm-submit"
                type="submit"
                class="btn btn-primary"
            >
                {{ $submitText }}
            </button>
            <button
                id="modal-confirm-cancel"
                type="button"
                data-bs-dismiss="modal"
                class="btn"
                style="background: #667085; color: #FFF;"
            >
                Cancel
            </button>
          </div>
          @endif
        </div>
    </div>
  </div>